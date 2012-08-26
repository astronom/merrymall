<?php

/**
 * BasesfGuardFormSignin
 *
 * @package    sfDoctrineGuardPlugin
 * @subpackage form
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 * @version    SVN: $Id: BasesfGuardFormSignin.class.php 23536 2009-11-02 21:41:21Z Kris.Wallsmith $
 */
class sfGuardResetPasswordForm extends sfGuardUserProfileForm
{
  public function configure()
  {
    parent::configure();

    // Убираем лишние поля
    unset(
    $this['user_id'],
    $this['validate'],
    $this['firstname'],
    $this['lastname'],
    $this['phone'],
    $this['address'],
    $this['patronymic'],
    $this['created_at'],
    $this['updated_at'],
    $this['email'],
    $this['username']
    );

    $this->setWidget('password', new sfWidgetFormInputPassword(
    array(), array('maxlength' => 128)
    ));

    $this->setWidget('password2', new sfWidgetFormInputPassword(
    array(), array('maxlength' => 128)
    ));
    $this->widgetSchema->moveField('password2', sfWidgetFormSchema::AFTER, 'password');

    $this->widgetSchema->setLabels(array(
      'password'  => 'Пароль',
      'password2' => 'Повторите пароль',
    ));

    // Don't print passwords when complaining about inadequate length
    $this->setValidator('password', new sfValidatorString(array(
      'required' => true,
      'trim' => true,
      'min_length' => 6,
      'max_length' => 128
    ), array(
      'min_length' => 'Введеный пароль слишком короткий. Он должен состоять как минимум из %min_length% символов.',
      'required' => 'Обязательное поле')));

    $this->setValidator('password2', new sfValidatorString(array(
      'required' => true,
      'trim' => true,
      'min_length' => 6,
      'max_length' => 128
    ), array(
      'min_length' => 'Введеный пароль слишком короткий. Он должен состоять как минимум из %min_length% символов.',
      'required' => 'Повторите пароль')));

    $schema = $this->validatorSchema;

    // Hey Fabien, adding more postvalidators is kinda verbose!
    $postValidator = $schema->getPostValidator();

    $postValidators = array(
    new sfValidatorSchemaCompare(
        'password',
    sfValidatorSchemaCompare::EQUAL,
        'password2',
    array(),
    array('invalid' => 'Возможно вы ошиблись при повторе пароля.')
    ),
    );

    if ($postValidator)
    {
      $postValidators[] = $postValidator;
    }

    $this->validatorSchema->setPostValidator(new sfValidatorAnd($postValidators));

    $this->widgetSchema->setNameFormat('resetPassword[%s]');
    $this->disableCSRFProtection();
  }
}
