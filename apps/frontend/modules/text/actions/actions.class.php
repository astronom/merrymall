<?php

/**
 * text actions.
 *
 * @package    merrymall
 * @subpackage text
 * @author     Wronglink
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class textActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeAbout(sfWebRequest $request)
  {
   $this->floors = Doctrine::getTable('Floor')->findAll();
   $url = substr($request->getPathInfo(),1, strlen($request->getPathInfo()));
   $this->about = Doctrine::getTable('Texts')->findOneBy('url',$url);
  }
  public function executeAdds(sfWebRequest $request)
  {
   $this->floors = Doctrine::getTable('Floor')->findAll();
   $url = substr($request->getPathInfo(),1, strlen($request->getPathInfo()));
   $this->adds = Doctrine::getTable('Texts')->findOneBy('url',$url);
  }
  public function executeRent(sfWebRequest $request)
  {
   $this->floors = Doctrine::getTable('Floor')->findAll(); 
   $url = substr($request->getPathInfo(),1, strlen($request->getPathInfo()));
   $this->rent = Doctrine::getTable('Texts')->findOneBy('url',$url);
  }
}
