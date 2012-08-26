<?php

require_once dirname(__FILE__).'/../lib/s_brandGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/s_brandGeneratorHelper.class.php';

/**
 * s_brand actions.
 *
 * @package    merrymall
 * @subpackage s_brand
 * @author     Wronglink
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class s_brandActions extends autoS_brandActions
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
