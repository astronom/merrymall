<?php

/**
 * sProperty form.
 *
 * @package    merrymall
 * @subpackage form
 * @author     Wronglink
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class BackendsPropertyForm extends BasesPropertyForm
{
  public function configure()
  {
    parent::configure();

    unset(
      $this['created_at'],
      $this['updated_at'],
      $this['company_id']
    );

    $this->setWidget('s_categories_list', new mmWidgetFormHierarchialDoctrineChoice(array('multiple' => true, 'model' => 'sCategory')));

    $request = sfContext::getInstance()->getRequest();

    $this->getObject()->setCompanyId($request->getParameter('company_id'));
    
//    's_categories_list' => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'sCategory')),

    $categoryQuery = Doctrine::getTable('sCategory')->getCompanyCategoriesQuery($request->getParameter('company_id'));
    $this->setWidget('s_categories_list', new mmWidgetFormHierarchialDoctrineChoice(array('multiple' => true, 'model' => 'sCategory')));
    $this->widgetSchema['s_categories_list']->setOption('query', $categoryQuery);
  }
}
