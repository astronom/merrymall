<?php

require_once dirname(__FILE__).'/../lib/s_property_valueGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/s_property_valueGeneratorHelper.class.php';

/**
 * s_property_value actions.
 *
 * @package    merrymall
 * @subpackage s_property_value
 * @author     Wronglink
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class s_property_valueActions extends autoS_property_valueActions
{
  public function preExecute()
  {
    parent::preExecute();
    $routing = $this->getContext()->getRouting();
    $routing->setDefaultParameter('company_id', $this->request->getParameter('company_id'));
  }

  protected function  buildQuery()
  {
    $query = parent::buildQuery();
    $query->andWhere('company_id = ?', $this->request->getParameter('company_id'));

    return $query;
  }
}
