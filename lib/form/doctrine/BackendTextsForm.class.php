<?php

/**
 * Texts form.
 *
 * @package    merrymall
 * @subpackage form
 * @author     Wronglink
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class BackendTextsForm extends BaseTextsForm
{
  public function configure()
  {
    unset(
    $this['created_at'],
    $this['updated_at']
    );
    //Устанавливем Виджет
    $this->setWidget('text', new mmWidgetFormWYSIWYG(array(), array('rows' => 15, 'cols' => 165)));

  }
}
