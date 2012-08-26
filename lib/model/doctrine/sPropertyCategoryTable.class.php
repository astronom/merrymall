<?php

class sPropertyCategoryTable extends Doctrine_Table
{
  public function getCompanyPropertiesCategoriesQuery($company_id)
  {
    $query = $this->createQuery('pc')->where('pc.company_id = ?', $company_id);
    return $query;
  }
}
