<?php
class xlsParser {

  /**
   * Id компании в базе данных
   * @var int
   */
  private $company_id;

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
   *
   * Объект для работы с массивом
   *
   * @var ArrayIterator
   * @access private;
   *
   */
  private $iterator;

  /**
   * Свойство хранит соединение с базой
   * @var Doctrine_Collection
   */
  private $conn;

  private $sCategory;

  private $rootId;

  public function __construct($tableData,$company_id) {

    $this->iterator = new RecursiveArrayIterator($tableData);
    $this->company_id = $company_id;
    $this->conn = Doctrine_Core::getTable('sCategory')->getConnection();

// Если нет рутовой категории, то создаем ее
    if(!$this->hasRootCategory())
    {
      $this->createRootCategory();
    }

    $this->arrayParse();

    $this->insertOffers();

  }

  private function arrayParse() {
    $firephp = sfFirePHP::getInstance(true);
    $this->iterator->rewind();

    while ($this->iterator->valid()) {

      if($this->iterator->hasChildren())
      {
        $item = $this->iterator->getChildren();
        $offer = array();
        $offer['name'] = $item['nameEntity'];
        $offer['price'] = $item['priceEntity'];
        $offer['description'] = $item['descriptionEntity'];
        array_push($this->offers, $offer);
      }
      $this->iterator->next();
    }

  }

  /**
   * Возвращает объект товаров
   * @return Object
   */
  public function getOffers()
  {
    return $this->offers;
  }

  /**
   * Возвращает количество товаров
   * @return integer
   */
  public function getNumOffers()
  {
    return count($this->offers);
  }

  /**
   * Возвращает количество категорий товаров
   * @return integer
   */
  public function getNumCategories()
  {
    return count($this->categories);
  }

  /**
   * Выборка товаров по внутренним категориям
   * @param int $categoryId
   * @return null
   */
  public function getOffersByCategory($categoryId)
  {
    return NULL;
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
    //$this->sCategory->save();

  }

  private function getSCategory()
  {
    $this->sCategory = Doctrine_Core::getTable('sCategory')->getTree();
  }

  /**
   * Создает категории, относительного 1 пустого рута для компании
   */
  public function insertCategories()
  {

  }

  /**
   * Вставляет товары
   * @param int $categoryId
   */
  public function insertOffers()
  {
    $offers = $this->getOffers();
    foreach ($offers as $offer)
    {
      //ymlOffer = new OfferAnalizer($offer);

      $item = new sItem();
      $item->name = $offer['name'];
      $item->description = $offer['description'];
      $item->is_enabled = true;
      $item->category_id = $this->rootId;
      $item->company_id = $this->company_id;
      $item->save();

      $itemVariant = new sItemVariant();
      $itemVariant->item_id = $item->id;
      $itemVariant->name = $offer['name'];
      $itemVariant->price = $offer['price'];
      $itemVariant->is_main = true;
      $itemVariant->company_id = $this->company_id;
      $itemVariant->save();

//      $itemImage = new sImage();
//      $itemImage->url = $ymlOffer->picture;
      //$itemImage->is_main = true;
     // $itemImage->item_id = $item->id;
     // $itemImage->company_id = $this->company_id;
     // $itemImage->save();

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
//  public function __destruct()
//  {
//    //$this->xml->close();
//  }
}



