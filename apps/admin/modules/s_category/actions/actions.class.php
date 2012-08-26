<?php

require_once dirname(__FILE__).'/../lib/s_categoryGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/s_categoryGeneratorHelper.class.php';

/**
 * s_category actions.
 *
 * @package    merrymall
 * @subpackage s_category
 * @author     Wronglink
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class s_categoryActions extends autoS_categoryActions
{
  public function preExecute()
  {
    parent::preExecute();
    $this->request->setParameter('company_id', $this->getUser()->getCompanyId());
  }

  public function executeIndex(sfWebRequest $request)
  {
    // sorting
    if ($request->getParameter('sort') && $this->isValidSortColumn($request->getParameter('sort')))
    {
      $this->setSort(array($request->getParameter('sort'), $request->getParameter('sort_type')));
    }

    // pager
    if ($request->getParameter('page'))
    {
      $this->setPage($request->getParameter('page'));
    }

    $this->pager = $this->getPager();
    $this->sort = $this->getSort();

    $this->sortedCategories = $this->getSortedCategories($this->pager->getResults());
  }

  private function getSortedCategories($unsorted, $parentId = 0, $level = 0)
  {
    $sorted = array();
    foreach ($unsorted as $category)
      if ($category->getParentId() == $parentId)
      {
        $category->setTabbedName(str_repeat('<span class="sf_admin_tabber">', $level) . $category->getName() . str_repeat('</span>', $level));
        //$category['name'] = $category->getName() . 'ololo';
        $sorted[] = $category;
        $sorted = array_merge($sorted, $this->getSortedCategories($unsorted, $category->getId(), $level+1));
      }
    return $sorted;
  }

  protected function  buildQuery()
  {
    $query = parent::buildQuery();
    $query->andWhere('company_id = ?', $this->request->getParameter('company_id'));

    return $query;
  }

  public function executePromote()
  {
    $object = Doctrine::getTable('sCategory')->findOneById($this->getRequestParameter('id'));

    $object->demote();
    $this->redirect("@s_category");
  }

  public function executeDemote()
  {
    $object = Doctrine::getTable('sCategory')->findOneById($this->getRequestParameter('id'));


    $object->promote();
    $this->redirect("@s_category");
  }
}
