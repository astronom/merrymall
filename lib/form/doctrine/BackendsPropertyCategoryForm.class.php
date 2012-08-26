<?php

/**
 * sPropertyCategory form.
 *
 * @package    merrymall
 * @subpackage form
 * @author     Wronglink
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class BackendsPropertyCategoryForm extends BasesPropertyCategoryForm
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

    $propertyQuery = Doctrine::getTable('sProperty')->getCompanyPropertiesQuery($request->getParameter('company_id'));
    $this->widgetSchema['property_id']->setOption('query', $propertyQuery);

    $categoryQuery = Doctrine::getTable('sCategory')->getCompanyCategoriesQuery($request->getParameter('company_id'));
    $this->widgetSchema['category_id']->setOption('query', $categoryQuery);
  }
}
