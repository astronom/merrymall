<?php
/**
 * sfGuardRestorePaswd form.
 *
 * @package    merrymall
 * @subpackage form
 * @author     Astronom a.manichev@gmail.com
 * @version    SVN: $Id: sfDoctrinePluginFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class sfGuardRestorePasswordCheckUserForm extends sfForm
{
  public function configure()
  {
    parent::configure();

    $this->setWidget('username_or_email',
      new sfWidgetFormInput(
        array(), array('maxlength' => 100)));
        
    $this->widgetSchema->setLabels(array(
      'username_or_email' => 'Логин или E-mail'
    ));
//  @todo Добавить защиту от посторонних символов. Добавить проверку на валидацию email (а надо ли?)    
    $this->setValidator('username_or_email',
      new sfValidatorAnd(
        array(
          new sfValidatorString(
            array('required' => true,
                  'trim' => true),
            array('required' => 'Обязательно к заполнению')
            ),
          new sfValidatorOr(
            array(
              new sfValidatorDoctrineChoice(array('model' => 'sfGuardUser',
                								  'column' => 'username'))
              , 
              new sfValidatorDoctrineChoice(array('model' => 'sfGuardUserProfile',
                								  'column' => 'email'))
            ),
          array(),
          array('invalid' => 'Такой пользователь или E-mail не зарегистрирован')
          )
        ),
        array(),
        array('required' => 'Требуется ввести имя пользователя или E-mail')
      ));

    $this->widgetSchema->setNameFormat('restorePassword[%s]');
    //Включаем CSRF защиту (по умолчанию отключено)
    $this->addCSRFProtection();
  }
}
