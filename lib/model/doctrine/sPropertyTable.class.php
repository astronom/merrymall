<?php

class sPropertyTable extends Doctrine_Table
{
  public function getCompanyPropertiesQuery($company_id)
  {
    $query = $this->createQuery('p')->where('p.company_id = ?', $company_id);
    return $query;
  }
}
