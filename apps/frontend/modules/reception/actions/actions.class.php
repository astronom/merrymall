<?php

/**
 * reception actions.
 *
 * @package    merrymall
 * @subpackage reception
 * @author     Wronglink
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class receptionActions extends sfActions
{
  public function preExecute()
  {
    $this->floors = Doctrine::getTable('Floor')->findAll();
  }

  public function executeIndex(sfWebRequest $request)
  {
    $this->news = Doctrine::getTable('News')->createQuery('a')->orderBy('date DESC')->execute();
    $this->actions = Doctrine::getTable('Actions')->createQuery('a')->execute();
  }

  public function executeCompanies(sfWebRequest $request)
  {
    $this->companies = Doctrine::getTable('Company')->findAllAvailableLeftJoinFloor();
    $this->floor = '';
  }

  public function executeRootTags(sfWebRequest $request)
  {
    $this->root_tags = Doctrine::getTable('sTag')->findAllRootJoinChildren();
  }

  public function executeTags(sfWebRequest $request)
  {
    $this->parent_tag = Doctrine::getTable('sTag')->findOneByIdJoinChildren($request->getParameter('tag_id'));
    $this->forward404Unless($this->parent_tag, 'Tag does not exist');
//    $this->items = ;
  }

  public function executeSiteMap(sfWebRequest $request)
  {
    $this->companies = Doctrine::getTable('Company')->findAllAvailableLeftJoinFloor();
    $this->floor = '';
  }

  public function executeEmail(sfWebRequest $request)
  {
    //    $message = $this->getMailer()->compose(
    //          array('admin@merrymall.ru' => 'Администрация MerryMall'),
    //          array('a.manichev@gmail.com' => 'Admin'),
    //          'Регистрация на MerryMall.ru',
    //          'test some mail'
    //        );
    //    $message->setContentType("text/html");
    //    $this->getMailer()->send($message);
  }
}
