<?php

/**
 * sProperty filter form.
 *
 * @package    merrymall
 * @subpackage filter
 * @author     Wronglink
 * @version    SVN: $Id: sfDoctrineFormFilterTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class BackendsPropertyFormFilter extends BasesPropertyFormFilter
{
  public function configure()
  {
    parent::configure();

    $request = sfContext::getInstance()->getRequest();

    $categoryQuery = Doctrine::getTable('sCategory')->getCompanyCategoriesQuery($request->getParameter('company_id'));
    $this->setWidget('s_categories_list', new mmWidgetFormHierarchialDoctrineChoice(array('multiple' => true, 'model' => 'sCategory')));
    $this->widgetSchema['s_categories_list']->setOption('query', $categoryQuery);

    unset($this->widgetSchema['company_id']);
  }
}
