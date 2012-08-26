<?php

/**
 * news actions.
 *
 * @package    merrymall
 * @subpackage news
 * @author     Wronglink
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class newsActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
    $this->news = Doctrine::getTable('News')->getAllJoinCompaniesQuery()->execute();
  }
 /**
  * Содержание новости
  *
  * @param sfRequest $request A request object
  */
  public function executeShow(sfWebRequest $request)
  {
	$this->floors = Doctrine::getTable('Floor')->findAll();
    $this->news_item = $this->getRoute()->getObject();
	$this->forward404Unless($this->news_item);
  }
}
