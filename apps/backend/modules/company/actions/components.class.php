<?php
class companyComponents extends sfComponents
{
  public function executeCompanyMenu()
  {
    $this->company = Doctrine::getTable('Company')->find($this->company_id);
  }
}