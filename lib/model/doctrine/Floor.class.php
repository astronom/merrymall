<?php

/**
 * Floor
 *
 * This class has been auto-generated by the Doctrine ORM Framework
 *
 * @package    merrymall
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7021 2010-01-12 20:39:49Z lsmith $
 */
class Floor extends BaseFloor
{
//  public function  __toString()
//  {
//    return $this->getText();
//  }

  public function getFloorLink()
  {
    if ($this->getUrl() == 1)
      $floor_link = url_for('@hall');
    else
      $floor_link = url_for('@floor?floor_id=' . $this->getUrl());
    return $floor_link;
  }

  public function getName()
  {
    if ($this->getType() == 'floor')
    {
      if ($this->getUrl() == 1)
        $name = 'Холл';
      else
        $name = $this->getUrl() . ' этаж';

      return $name;
    }
    else
    {
      return false;
    }
  }

  public function hasCompanies()
  {
    return $this->getHasCompanies();
  }

  public function isHall()
  {
    if($this->getId()==1)
      return true;
    else return false;
  }
}
