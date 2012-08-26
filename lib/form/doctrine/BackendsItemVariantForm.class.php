<?php

/**
 * sItemVariant form.
 *
 * @package    merrymall
 * @subpackage form
 * @author     Wronglink
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class BackendsItemVariantForm extends BasesItemVariantForm
{
  public function configure()
  {
    parent::configure();

    unset(
      $this['created_at'],
      $this['updated_at'],
      $this['company_id'],
      $this['item_id'],
      $this['position']
    );
    $request = sfContext::getInstance()->getRequest();

//    $this->setWidget('position', new sfWidgetFormInputHidden());
    $this->setWidget('is_main', new sfWidgetFormInputCheckbox(array(), array('class' => 'unique_is_main')));

    $this->getObject()->setCompanyId($request->getParameter('company_id'));

    $this->widgetSchema->setNameFormat('s_item_variant[][%s]');

   // $this->validatorSchema['name']->setOption('required', false);
  }
}
