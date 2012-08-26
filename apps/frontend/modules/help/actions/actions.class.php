<?php

/**
 * help actions.
 *
 * @package    merrymall
 * @subpackage help
 * @author     Alexander Manichev aka Astronom <a.manichev@gmail.com>
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class helpActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {

  }

 /**
  * Executes Service action
  *
  * @param sfRequest $request A request object
  */
  public function executeService(sfWebRequest $request)
  {

  }

 /**
  * Executes Service Show action
  *
  * @param sfRequest $request A request object
  */
  public function executeServiceShow(sfWebRequest $request)
  {
    $this->service = $this->getRequest()->getParameter('service');
    if(!(intval($this->service) > 0 && intval($this->service) <= 22)) throw new sfError404Exception();
  }

}
