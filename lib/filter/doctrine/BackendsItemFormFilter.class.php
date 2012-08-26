<?php

/**
 * sItem filter form.
 *
 * @package    merrymall
 * @subpackage filter
 * @author     Wronglink
 * @version    SVN: $Id: sfDoctrineFormFilterTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class BackendsItemFormFilter extends BasesItemFormFilter
{
  public function configure()
  {
    parent::configure();

    $request = sfContext::getInstance()->getRequest();

    $categoryQuery = Doctrine::getTable('sCategory')->getCompanyCategoriesQuery($request->getParameter('company_id'));
    $this->widgetSchema['category_id']->setOption('query', $categoryQuery);

    $brandQuery = Doctrine::getTable('sBrand')->getCompanyBrandsQuery($request->getParameter('company_id'));
    $this->widgetSchema['brand_id']->setOption('query', $brandQuery);

    unset($this->widgetSchema['company_id']);
 }
}
