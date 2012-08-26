<?php

require_once dirname(__FILE__).'/../lib/s_office_textGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/s_office_textGeneratorHelper.class.php';

/**
 * s_office_text actions.
 *
 * @package    merrymall
 * @subpackage s_office_text
 * @author     Wronglink, Astronom <a.manichev@gmail.com>
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class s_office_textActions extends autoS_office_textActions
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
