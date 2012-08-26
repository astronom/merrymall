<?php

/**
 * sItemVariant filter form.
 *
 * @package    merrymall
 * @subpackage filter
 * @author     Wronglink
 * @version    SVN: $Id: sfDoctrineFormFilterTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class BackendsItemVariantFormFilter extends BasesItemVariantFormFilter
{
  public function configure()
  {
    parent::configure();

    $request = sfContext::getInstance()->getRequest();

    $itemQuery = Doctrine::getTable('sItem')->getCompanyItemsQuery($request->getParameter('company_id'));
    $this->widgetSchema['item_id']->setOption('query', $itemQuery);

    unset($this->widgetSchema['company_id']);
  }
}
