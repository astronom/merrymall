<?php

/**
 * sPropertyValue
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    merrymall
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7021 2010-01-12 20:39:49Z lsmith $
 */
class sPropertyValue extends BasesPropertyValue
{
  public function getPropertyName()
  {
    return $this->getSProperty()->getName();
  }

  public function getItemName()
  {
    return $this->getSItem()->getName();
  }

  public function getCompanyName()
  {
    return $this->getCompany()->getName();
  }
}