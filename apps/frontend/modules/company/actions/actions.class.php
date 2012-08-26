<?php

/**
 * company actions.
 *
 * @package    merrymall
 * @subpackage company
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class companyActions extends sfActions
{

  public function postExecute()
  {

    $this->shopsOnFloorList = Doctrine::getTable('Company')->findAllAvailableByFloor($this->company->Floor->id);
    $this->shopsRandomList = Doctrine::getTable('Company')->findRandomAvailableCompanies();

    $this->form = new sCartForm();

    if($this->company->isStore())
    {
      $this->companyType = 'Магазин';
    }
    elseif($this->company->isOffice())
    {
      $this->companyType = 'Офис';
    }
  }
  public function executeIndex(sfWebRequest $request)
  {
    $this->company = $this->getRoute()->getObject();
    $this->floorID = $this->company->Floor->id;

    //выбираем все категории
    $this->getCategoriesTree($this->company->id);

    if($this->company->isStore())
    {
      //если нам передали айдишник категории - выбираем соответствующие товары
      //если нет - тянем все подряд
      $ids = array();
      //$this->category_id = 'all';
      if(($this->category_id = $request->getParameter('category_id')) && $request->getParameter('category_id') != 'all')
      {
        $ids[] = $this->category_id;
        //Возьмем категории для которых переданная является родителем
        $category = Doctrine::getTable('sCategory')->findOneById($ids[0]);
        if(($subCategoryIds = $category->getChildrenIds()) != NULL)
        {
          $ids = array_merge($ids, $subCategoryIds);
        }
      }
      $this->pager = new sfDoctrinePager('sItem', sfConfig::get('app_max_items_on_store'));
      $this->pager->setQuery(Doctrine::getTable('sItem')->getEnabledItemsByCategoriesJoinImagesJoinItemVariantsJoinSWishlistQuery($ids,$this->company->id,$this->getUser()->getId()));
      $this->pager->setPage($request->getParameter('page',1));
      $this->pager->init();

      //Форма для добавления в корзину
      $this->form = new sCartForm();

    }
    elseif($this->company->isOffice())
    {
      $this->officeTexts = Doctrine::getTable('sOfficeText')->findAllByCompanyIdJoinCompany($this->company->id);
//      $this->officeTexts = Doctrine::getTable('sItem')->getEnabledItemsByCategoriesJoinImagesJoinItemVariantsJoinSWishlistQuery($ids,$this->company->id,$this->getUser()->getId());
      $this->form = new sCartForm();
      $this->setTemplate('office');
    }

  }

  public function executeAbout(sfWebRequest $request)
  {
    $this->company = $this->getRoute()->getObject();
  }

  public function executeNews(sfWebRequest $request)
  {
    $this->company = $this->getRoute()->getObject();
    $this->newsList = $this->company->getNews();
  }

  public function executeShowNews(sfWebRequest $request)
  {
    $this->forward404Unless(
    $this->newsItem = Doctrine::getTable('News')
    ->findOneByTitleSlug($this->getRequestParameter('title_slug')),
                            'Sorry, but company news unavailable now');
  }


  public function executeActions(sfWebRequest $request)
  {
    $this->company = $this->getRoute()->getObject();
    $this->actionsList = $this->company->getActions();
  }

  public function executeShowActions(sfWebRequest $request)
  {
    $this->forward404Unless(
    $this->actionsItem = Doctrine::getTable('Actions')
    ->findOneByTitleSlug($this->getRequestParameter('title_slug')),
                            'Sorry, but company actions unavailable now');
  }

  public function executeContact(sfWebRequest $request)
  {
     $this->company = $this->getRoute()->getObject();
  }

  public function executeShowText(sfWebRequest $request)
  {
    $this->company = $this->getRoute()->getObject();
    $this->getCategoriesTree($this->company->id);
    $this->officeText = Doctrine::getTable('sOfficeText')
    ->findOneByTitleSlug($this->getRequestParameter('slug'));
  }

  private function getCategoriesTree($company_id)
  {
    $q = Doctrine_Query::create()
    ->select('c.id, c.name, c.root_id, c.lft, c.rgt, c.level')
    ->from('sCategory c')
    ->andWhere('c.company_id = ?', $company_id);
    $treeObject = Doctrine_Core::getTable('sCategory')->getTree();
    $treeObject->setBaseQuery($q);
    $this->treeObject = $treeObject;

    $rootQuery = Doctrine_Query::create()
    ->select('root_id')
    ->from('sCategory c')
    ->where('company_id = ?', $company_id)
    ->limit('1');
    $this->rootId = $rootQuery->fetchOne(array(), Doctrine_Core::HYDRATE_SINGLE_SCALAR);

  }

  private function getSubCategoriesIds($categories, $parentId)
  {
    $ids = array();
    foreach ($categories as $category)
    if ($category->getParentId() == $parentId)
    {
      $ids[] = $category->getId();
      $ids += $this->getSubCategoriesIds($categories, $category->getId());
    }
    return $ids;
  }

  public function executeItemInfoAjax(sfWebRequest $request) {
    //Ищем инфу по товару
    $this->item = Doctrine::getTable('sItem')->find($request->getParameter('item_id'));
    $this->itemPropertyValues = Doctrine::getTable('sPropertyValue')->findByItemJoinProperties($request->getParameter('item_id'));
  }

  public function executeItemInfo(sfWebRequest $request) {
    //Ищем инфу по товару
    $this->item = $this->getRoute()->getObject();
    $this->company = $this->item->getCompany();
    $this->itemPropertyValues = Doctrine::getTable('sPropertyValue')->findByItemJoinProperties($request->getParameter('item_id'));
    //выбираем все категории
    $this->getCategoriesTree($this->company->id);

  }

}