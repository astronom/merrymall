<?php

require_once dirname(__FILE__).'/../lib/floorGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/floorGeneratorHelper.class.php';

/**
 * floor actions.
 *
 * @package    merrymall
 * @subpackage floor
 * @author     Wronglink
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class floorActions extends autoFloorActions
{
  public function executePromote()
  {
    $object=Doctrine::getTable('Floor')->findOneById($this->getRequestParameter('id'));


    $object->promote();
    $this->redirect("@floor");
  }

  public function executeDemote()
  {
    $object=Doctrine::getTable('Floor')->findOneById($this->getRequestParameter('id'));

    $object->demote();
    $this->redirect("@floor");
  }
}
