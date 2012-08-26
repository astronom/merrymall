<?php

require_once dirname(__FILE__).'/../lib/companyGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/companyGeneratorHelper.class.php';

/**
 * company actions.
 *
 * @package    merrymall
 * @subpackage company
 * @author     Wronglink
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class companyActions extends autoCompanyActions
{
  public function executeStore(sfWebRequest $request)
  {
    $this->getRequest()->setParameter('company_page', true);
    $this->getRequest()->setParameter('company_id', $request->getParameter('id'));
  }

  public function executePromote()
  {
    $object=Doctrine::getTable('Company')->findOneById($this->getRequestParameter('id'));


    $object->promote();
    $this->redirect("@company");
  }

  public function executeDemote()
  {
    $object=Doctrine::getTable('Company')->findOneById($this->getRequestParameter('id'));

    $object->demote();
    $this->redirect("@company");
  }
}
