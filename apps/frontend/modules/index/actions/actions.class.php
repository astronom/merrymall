<?php

/**
 * index actions.
 *
 * @package    merrymall
 * @subpackage index
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12479 2008-10-31 10:54:40Z fabien $
 */
class indexActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
    $this->redirect('@companies');
    // Вытаскиваем из базы этажи
//    $this->floors = Doctrine::getTable('Floor')->findAll();
//
//    $this->floors_count = 0;
//    foreach ($this->floors as $floor)
//      if ($floor->getType() == 'floor')
//        $this->floors_count++;
//    $this->getRequest()->setAttribute('floors_count', $this->floors_count);
//
//    $this->news = Doctrine::getTable('News')->findLast(10);
  }
}
