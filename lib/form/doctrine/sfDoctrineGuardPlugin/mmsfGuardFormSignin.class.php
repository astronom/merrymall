<?php

/**
 * sfGuardFormSignin for sfGuardAuth signin action
 *
 * @package    sfDoctrineGuardPlugin
 * @subpackage form
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 * @version    SVN: $Id: sfGuardFormSignin.class.php 23536 2009-11-02 21:41:21Z Kris.Wallsmith $
 */
class mmsfGuardFormSignin extends BasesfGuardFormSignin
{
  /**
   * @see sfForm
   */
  public function configure()
  {
    parent::configure();

    $this->setWidget('username',
                     new sfWidgetFormInput(
                     array('type' => 'text',
                     ),
                     array(
                     'pattern'  => '[a-zA-Z0-9]{3,128}',
                     'required' => 'required',
                     'value'  => 'Логин'
                     )));
    $this->getWidget('password')->setAttributes(array('required' => 'required','value'  => 'Пароль'));

    $this->widgetSchema->setLabels(array(
      'username' => 'Логин',
      'password' => 'Пароль',
      'remember' => 'Запомнить меня'
      ));

  }
}