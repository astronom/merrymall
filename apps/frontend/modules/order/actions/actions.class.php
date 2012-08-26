<?php

/**
 * order actions.
 *
 * @package    merrymall
 * @subpackage order
 * @author     Wronglink
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class orderActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeAddOrder(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));
    
    $this->form = new sOrderForm();

    $this->processForm($request, $this->form);    
  }
  
  protected function processForm(sfWebRequest $request, sfForm $form)
  {
  $form->bind($request->getParameter($form->getName()));
 
  if($form->isValid())
  {
    $form->save();
    $this->redirect('private_area');
  }
  else 
  {
   $this->forward('privateArea','index'); 
  }
  
  } 
}
