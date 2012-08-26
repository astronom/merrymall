<?php
class ymlParser
{
  /**
   * Id компании в базе данных
   * @var int
   */
  private $company_id;

  /**
   *
   * Объект для работы с XML
   *
   * @var XMLReader
   * @access private;
   *
   */
  private $xml;

  /**
   * массив для сбора категорий
   * @var Array
   */
  private $categories = array();

  /**
   * Массив для сбора товаров
   * @var Array
   */
  private $offers = array();

  /**
   * Стоимость доставки в домашнем регионе
   *
   * @var decemical
   */
  private $localDeliveryCost;

  /**
   * Дата создания каталога
   * @var DateTime
   */
  private $catalogeDate;

  /**
   * Содержит текущее дерево категорий
   * @var array
   */
  private $tree = array();

  /**
   * Содержит ссылку на рутовую категорию
   * @var Doctrine_Tree
   */
  private $rootCategory;

  public function __construct($filename,$company_id) {
    $this->xml = new XMLReader();
    $this->xml->open($filename);
    $this->xmlParser();
    $this->company_id = $company_id;
    //$this->db = $database;
  }

  private function xmlParser()
  {
    while ($this->xml->read()) {
      switch ($this->xml->name)
      {
        case 'category':
          if ($this->xml->nodeType == XMLReader::ELEMENT)
          {
            array_push($this->categories, array('id' => $this->xml->getAttribute('id'),
        													'parentId' => $this->xml->getAttribute('parentId'),
        													'data' => $this->xml->readString()));
          }
          break;
        case 'offer':
          $offer = array();
          $offer['id'] = $this->xml->getAttribute('id');
          $offer['available'] = $this->xml->getAttribute('available');
          $offer['type'] = $this->xml->getAttribute('type');
          $this->xml->read();
          while ($this->xml->name != 'offer')
          {
            $this->xml->read();
            if ($this->xml->nodeType == XMLReader::ELEMENT)
            {
              $offer[$this->xml->name] = $this->xml->readString();
            }
          }
          array_push($this->offers, $offer);
          break;
        case 'yml_catalog':
          $this->catalogeDate = $this->xml->getAttribute('date');
          break;
        case 'local_delivery_cost':
          if ($this->xml->nodeType == XMLReader::ELEMENT)
          {
            $this->localDeliveryCost = $this->xml->readString();
          }
          break;


      }

    }
  }

  public function getCategories()
  {
    return $this->categories;
  }

  /**
   * Метод строит дерево категорий, начиная от parentId = ''
   * @param string $parentId
   * @param int $level
   * @return array
   */
  public function getTreeCategories($parentId = '', $level = 0)
  {
    if($level == 0) $this->tree = array();
    foreach ($this->categories as $category)
    {
      if($category['parentId'] == $parentId)
      {
        array_push($this->tree, array('id' => $category['id'],
        								'parentId' => $category['parentId'],
        								'data' => $category['data'],
										'level' => $level));

        $this->getTreeCategories($category['id'], $level + 1);
      }
    }
    unset($category);

    return $this->tree;
  }

  public function getOffers()
  {
    return $this->offers;
  }

  public function getNumOffers()
  {
    return count($this->offers);
  }

  public function getNumCategories()
  {
    return count($this->categories);
  }

  /**
   * Выборка товаров по внутренним категориям
   * @param int $categoryId
   * @return array
   */
  public function getOffersByCategory($categoryId)
  {
    $categoryOffers = array();
    foreach ($this->offers as $offer)
    {
      if($offer['categoryId'] == $categoryId)
      {
        array_push($categoryOffers, $offer);
      }
    }
    return $categoryOffers;
  }

  /**
   * Определяет есть ли у компании рутовая категория
   * @return boolean
   */
  private function hasRootCategory()
  {
    $this->rootId = Doctrine_Core::getTable('sCategory')
    ->getCompanyCategoryRootQuery($this->company_id)
    ->fetchOne(array(), Doctrine_Core::HYDRATE_SINGLE_SCALAR);

    return $this->rootId ? true: false;

  }

  private function createRootCategory()
  {
    $category = new sCategory();
    $category->name = 'Root';
    $category->company_id = $this->company_id;
    $category->save();

    $this->sCategory = Doctrine_Core::getTable('sCategory')->getTree();
    $this->sCategory->createRoot($category);

    $this->rootId = $category->getId();
    $this->rootCategory = $category;
    //$this->sCategory->save();

  }



  /**
   * Создает категории, относительного 1 пустого рута для компании
   */
  public function insertCategories()
  {
    $ymlCategories = $this->getTreeCategories();

    //$conn = Doctrine_Core::getTable('sCategory')->getConnection();

    //$conn->beginTransaction();

    if(!$this->hasRootCategory())
    {
      $this->createRootCategory();
    }
    else {
     $this->rootCategory = Doctrine_Core::getTable('sCategory')
                                          ->getCompanyCategoryRootQuery($this->company_id)
                                          ->fetchOne();
    }

    $level = 1;
    foreach ($ymlCategories as $ymlCategory)
    {

      if($ymlCategory['parentId'] == '')
      {
        $subCategory = new sCategory();
        $subCategory->name = $ymlCategory['data'];
        $subCategory->company_id = $this->company_id;
        $subCategory->getNode()->insertAsLastChildOf($this->rootCategory);
        $this->insertYmlCategories($ymlCategory['id'], $subCategory->id);

        $this->insertOffersByCategory($ymlCategory['id'], $subCategory->id);
        $level = 1;
        continue;
      }
      if($ymlCategory['level'] > $level) $parentCategory = $child;
      else $parentCategory = $subCategory;

      $child = new sCategory();
      $child->name = $ymlCategory['data'];
      $child->company_id = $this->company_id;
      $child->getNode()->insertAsLastChildOf($parentCategory);

      $this->insertYmlCategories($ymlCategory['id'], $child->id);

      $this->insertOffersByCategory($ymlCategory['id'], $child->id);

      $level = $ymlCategory['level'];
    }

    //$conn->commit();

  }

  /**
   * Вставляет товары по id категории
   * @param int $categoryId
   */
  public function insertOffersByCategory($ymlCategoryId, $categoryId)
  {
    $offers = $this->getOffersByCategory($ymlCategoryId);
    foreach ($offers as $offer)
    {
      $ymlOffer = new OfferAnalizer($offer);

      $item = new sItem();
      $item->name = $ymlOffer->name;
      $item->description = $ymlOffer->description;
      $item->is_enabled = $ymlOffer->available == 'true' ? true : false;
      $item->category_id = $categoryId;
      $item->company_id = $this->company_id;
      $item->save();

      $itemVariant = new sItemVariant();
      $itemVariant->item_id = $item->id;
      $itemVariant->name = $ymlOffer->name;
      $itemVariant->price = $ymlOffer->price;
      $itemVariant->is_main = true;
      $itemVariant->company_id = $this->company_id;
      $itemVariant->save();

      $itemImage = new sImage();
      $itemImage->url = $ymlOffer->picture;
      $itemImage->is_main = true;
      $itemImage->item_id = $item->id;
      $itemImage->company_id = $this->company_id;
      $itemImage->save();

    }
  }

  public function insertYmlCategories($xml_id, $category_id)
  {
    $ymlCategory = new ymlCategory();
    $ymlCategory->xml_id = $xml_id;
    $ymlCategory->category_id = $category_id;
    $ymlCategory->company_id = $this->company_id;
    $ymlCategory->save();
  }
  public function __destruct()
  {
    $this->xml->close();
  }
}

class OfferAnalizer
{
  private $offer;
  private $name;
  private $description;
  private $price;

  private $ymlRules = array(
	'vendor.model' => array(
	  'name'        => array('vendor','model'),
	  'price'       => array('price'),
	  'description' => array('description', 'vendorCode', 'country_of_origin','sales_notes','manufacturer_warranty')
  ),
	'book'         => array(
	  'name'        => array('author','name'),
	  'price'       => array('price'),
	  'description' => array('description', 'publisher', 'year','ISBN','series')
  ),
	'audiobook'    => array(
	  'name'        => array('author','name'),
	  'price'       => array('price'),
	  'description' => array('description', 'publisher', 'year','ISBN','author', 'performance_type', 'performed_by', 'storage', 'format', 'recording_length')
  ),
  	'artist.title' => array(
	  'name'        => array('artist','title'),
	  'price'       => array('price'),
	  'description' => array('description', 'year','director','originalName', 'starring', 'media', 'country')
  ),
  	'artist.title' => array(
	  'name'        => array('artist','title'),
	  'price'       => array('price'),
	  'description' => array('description', 'year','director','originalName', 'starring', 'media', 'country')
  ),
	'default'     => array(
	  'name'        => array('name'),
	  'price'       => array('price'),
	  'description' => array('description', 'vendorCode', 'country_of_origin','sales_notes')
  ),
  );

  private $decoratorRules = array(
  'name' => '%s ',
  'vendor' => '%s ',
  'model'  => '%s ',
  'price' => '%s',
  'description' => '%s',
  'vendorCode'  => '<br />Код производителя: %s',
  'country_of_origin' => '<br />Произведено: %s',
  'sales_notes' => '<br /> %s',
  'manufacturer_warranty' => '<br />Гарантия производителя',
  'publisher' => '<br />Издательство: %s',
  'year' => '<br />Год издания: %s',
  'ISBN' => '<br />ISBN: %s',
  'series' => '<br />Серия: %s',
  'author' => '<br />Автор: %s',
  'performance_type' => '<br />Формат: %s',
  'performed_by' => '<br />Исполнитель: %s',
  'storage' => '<br />Носитель: %s',
  'format' => '<br />Формат: %s',
  'recording_length' => '<br />Время звучания: %s',
  'director' => '<br />Режиссер: %s',
  'originalName' => '<br />Оригинальное название: %s',
  'starring' => '<br />Главные роли: %s',
  'media' => '<br />Носитель: %s',
  'country' => '<br />Страна: %s'
  );

  public function __construct($offer)
  {
    $this->offer = $offer;
    $this->analyse();
  }

  public function __get($varName)
  {
    if(isset($this->$varName))
    {
      return $this->$varName;
    }
    else
    {
      return isset($this->offer[$varName]) ? $this->offer[$varName] : '';
    }
  }

  private function analyse()
  {
    if(isset($this->offer['type'])) $offerType = $this->offer['type'];
    else $offerType = 'default';
    foreach ($this->ymlRules[$offerType] as $index => $rules)
    {
      foreach ($rules as $rule)
      {
        if(isset($this->offer[$rule]))
        {
          $this->$index .= sprintf($this->decoratorRules[$rule],$this->offer[$rule]);
        }
      }
    }
  }
}