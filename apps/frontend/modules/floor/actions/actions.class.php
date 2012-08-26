<?php

/**
 * floor actions.
 *
 * @package    merrymall
 * @subpackage floor
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12479 2008-10-31 10:54:40Z fabien $
 */
class floorActions extends sfActions
{
  public function preExecute()
  {
    $this->floor = Doctrine::getTable('Floor')->findOneBy('url', $this->getRequestParameter('floor_id'));
    $this->forward404Unless($this->floor, 'Floor does not exist');

    // Вытаскиваем из базы список этажей
    $this->floors = Doctrine::getTable('Floor')->findAllHumanFloors();
    $this->floors_count = count($this->floors);

    // для блока выбора этажа в лифте
    if ($this->floor->getUrl() == $this->floors_count)
      $this->floor_is_top = true;
    else
      $this->floor_is_top = false;

    if ($this->floor->getUrl() == 1)
      $this->floor_is_bottom  = true;
    else
      $this->floor_is_bottom = false;
  }

 /**
  * Executes Floor action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {

    if ($this->getRequestParameter('floor_id') == 1)
      $this->forward('floor', 'hall');

    // тащим из базы список компаний
    $this->companies = Doctrine::getTable('Company')->findAllAvailableByFloor($this->floor->getId());

    $response = $this->getResponse();
    $response->setTitle($this->floor->getName());

    $js_cp_array = array();
    foreach($this->companies as $c)
      $js_cp_array[] = $c->getId();

    $this->js_cp_array = '[ ' . implode(', ', $js_cp_array) . ']';
  }

  public function executeHall(sfWebRequest $request)
  {

  }

}
