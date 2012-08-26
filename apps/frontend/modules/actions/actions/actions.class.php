<?php

/**
 * actions actions.
 *
 * @package    merrymall
 * @subpackage actions
 * @author     Wronglink
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class actionsActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
    $this->actions = Doctrine::getTable('Actions')->getAllJoinCompaniesQuery()->execute(array(), Doctrine_Core::HYDRATE_ARRAY);
  }
 /**
  * Выводит текст акцию
  *
  * @param sfRequest $request A request object
  */
  public function executeShow(sfWebRequest $request)
  {
    $this->action = $this->getRoute()->getObject();
  }
}
