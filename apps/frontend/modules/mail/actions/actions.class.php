<?php

/**
 * mail actions.
 *
 * @package    merrymall
 * @subpackage mail
 * @author     Alexander Manichev aka Astronom <a.manichev@gmail.com>
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class mailActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
    $this->forward404('Страницы не найдено');
  }

}
