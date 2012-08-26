<?php

/**
 * index actions.
 *
 * @package    merrymall
 * @subpackage index
 * @author     Wronglink
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class indexActions extends sfActions
{
  /**
   * Executes index action
   *
   * @param sfRequest $request A request object
   */
  public function preExecute()
  {
    parent::preExecute();

    $this->request->setParameter('company_id', $this->getUser()->getCompanyId());
  }

  public function executeIndex(sfWebRequest $request)
  {

  }

  public function executeUpload(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->processForm($request, $this->uploadDataForm);

    $this->setTemplate('index');

  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {

    $form->bind($request->getParameter($form->getName()),$request->getFiles($form->getName()));

    if($form->isValid())
    {
      $form->save();
      $this->redirect('@homepage');
    }
    else
    {
      $this->setTemplate('index');
    }

  }
}


