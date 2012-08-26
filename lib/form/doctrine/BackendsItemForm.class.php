<?php

/**
 * sItem form.
 *
 * @package    merrymall
 * @subpackage form
 * @author     Wronglink
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class BackendsItemForm extends BasesItemForm
{
  public function configure()
  {
    parent::configure();

    unset(
      $this['created_at'],
      $this['updated_at'],
      $this['company_id'],
      $this['position']
    );
    //Set WYSIWYG Widget for Description
    $this->widgetSchema['description'] = new mmWidgetFormWYSIWYG(array(), array('rows' => 5, 'style' => 'width: 100%;'));

    $request = sfContext::getInstance()->getRequest();

    $this->getObject()->setCompanyId($request->getParameter('company_id'));

    //$this->setWidget('s_tags_list', new mmWidgetFormHierarchialDoctrineChoice(array('multiple' => true, 'model' => 'sTag', 'order_by' => array('parent_id', 'asc'))));

    $categoryQuery = Doctrine::getTable('sCategory')->getCompanyCategoriesQuery($request->getParameter('company_id'));
    $this->setWidget('category_id', new mmWidgetFormHierarchialDoctrineChoice(array('model' => $this->getRelatedModelName('sCategory'), 'add_empty' => false)));
    $this->widgetSchema['category_id']->setOption('query', $categoryQuery);

    $brandQuery = Doctrine::getTable('sBrand')->getCompanyBrandsQuery($request->getParameter('company_id'));
    $this->widgetSchema['brand_id']->setOption('query', $brandQuery);
  }
}
