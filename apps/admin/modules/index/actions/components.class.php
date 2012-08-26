<?php
class indexComponents extends sfComponents
{
  public function executeCompanyMenu()
  {
    $this->company = Doctrine::getTable('Company')->find($this->getVar('company_id'));
  }
}