<?php

require_once dirname(__FILE__).'/../lib/s_item_variantGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/s_item_variantGeneratorHelper.class.php';

/**
 * s_item_variant actions.
 *
 * @package    merrymall
 * @subpackage s_item_variant
 * @author     Wronglink
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class s_item_variantActions extends autoS_item_variantActions
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
