<?php

/**
 * sPropertyValue form.
 *
 * @package    merrymall
 * @subpackage form
 * @author     Wronglink
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class BackendsPropertyValueForm extends BasesPropertyValueForm
{
  public function configure()
  {
    parent::configure();

    unset(
      $this['created_at'],
      $this['updated_at'],
      $this['company_id']
    );
    
    $request = sfContext::getInstance()->getRequest();

    $this->getObject()->setCompanyId($request->getParameter('company_id'));

    $propertyQuery = Doctrine::getTable('sProperty')->getCompanyPropertiesQuery($this->getObject()->getCompanyId());
    $this->widgetSchema['property_id']->setOption('query', $propertyQuery);

    $itemQuery = Doctrine::getTable('sItem')->getCompanyItemsQuery($this->getObject()->getCompanyId());
    $this->widgetSchema['item_id']->setOption('query', $itemQuery);
  }
}
