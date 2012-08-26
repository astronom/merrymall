<?php

class sBrandTable extends Doctrine_Table
{
  public function getCompanyBrandsQuery($company_id)
  {
    $query = $this->createQuery('b')->where('b.company_id = ?', $company_id);
    return $query;
  }
}
