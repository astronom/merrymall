<?php

class sCategoryTable extends Doctrine_Table
{
  public function getCompanyCategoriesQuery($company_id)
  {
    $query = $this->createQuery('c')->where('c.company_id = ?', $company_id);
    return $query;
  }

  /**
   * Установка для получения root записи
   * @return Doctrine_Query
   */
  public function getRootCategoryQuery()
  {
    $query = $this->createQuery('c')
                  ->select('root_id')
                  ->limit('1');

    return $query;
  }

  public function getCompanyCategoryRootQuery($company_id)
  {
    $query = $this->createQuery('c')
                  ->select('root_id')
                  ->where('c.company_id = ?', $company_id)
                  ->limit('1');

    return $query;
  }

  public function findAllCategories($query)
  {

    $treeObject = Doctrine_Core::getTable('sCategory')->getTree();
    $treeObject->setBaseQuery($query);
    $treeObject->fetchTree();

    return $treeObject;
  }
}
