<?php

require_once dirname(__FILE__).'/../lib/s_propertyGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/s_propertyGeneratorHelper.class.php';

/**
 * s_property actions.
 *
 * @package    merrymall
 * @subpackage s_property
 * @author     Wronglink
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class s_propertyActions extends autoS_propertyActions
{
  public function preExecute()
  {
    parent::preExecute();
    $this->request->setParameter('company_id', $this->getUser()->getCompanyId());
  }

  protected function  buildQuery()
  {
    $query = parent::buildQuery();
    $query->andWhere('company_id = ?', $this->request->getParameter('company_id'));

    return $query;
  }
}
