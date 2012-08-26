<?php
/**
 * Класс описывающий форму редактирования Предложений для офисов в админской части
 *
 * @author Astronom
 * @package MerryMall
 * @subpackage form
 *
 */
class BackendsOfficeTextForm extends BasesOfficeTextForm
{
  public function configure()
  {
    unset($this['created_at'],$this['updated_at'],$this['title_slug'],$this['company_id']);

    $this->setWidget('text', new mmWidgetFormWYSIWYG(array(), array('rows' => 15, 'cols' => 75)));

    $request = sfContext::getInstance()->getRequest();

    $this->getObject()->setCompanyId($request->getParameter('company_id'));

    $categoryQuery = Doctrine::getTable('sCategory')->getCompanyCategoriesQuery($request->getParameter('company_id'));
    $this->setWidget('category_id', new mmWidgetFormHierarchialDoctrineChoice(array('model' => $this->getRelatedModelName('sCategory'), 'add_empty' => false)));
    $this->widgetSchema['category_id']->setOption('query', $categoryQuery);


  }
}