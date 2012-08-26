<?php

/**
 * sCart form.
 *
 * @package    merrymall
 * @subpackage form
 * @author     Wronglink
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class sCartForm extends BasesCartForm
{
  public function configure()
  {
    parent::configure();
    $this->useFields(array('count','item_variant_id'));
//    $this->setWidgets(array(
//    'item_variant_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('sItemVariant'),
//                                                              'table_method' => 'getCompanyItemVariants',
//                                                              'add_empty' => false))
//    )); 
 
    $this->widgetSchema->setLabels(array(
  	'count'     => 'Кол-во:'));

  }
}
