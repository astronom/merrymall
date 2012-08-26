<?php
class mmsfGuardUserProfileForm extends sfGuardUserForm
{
  private $validate = null;

  public function configure()
  {
    $this->useFields(array('username'));

    $this->embedMergeForm('profile', new sfGuardUserProfileForm($this->getObject()->getProfile()));

    $this->getWidget('username')->setAttributes(array('disabled' => true, 'value' => $this->getObject()->getUsername()));
    $this->setWidget('password', new sfWidgetFormInputPassword(array(), array('maxlength' => 128)));
    $this->widgetSchema->moveField('password', sfWidgetFormSchema::AFTER, 'username');
    $this->setWidget('password2', new sfWidgetFormInputPassword(
    array(), array('maxlength' => 128)
    ));
    $this->widgetSchema->moveField('password2', sfWidgetFormSchema::AFTER, 'password');

    $this->widgetSchema->setLabels(array(
    'username'  => 'Имя пользователя',
    'password'  => 'Пароль',
    'password2' => 'Повторите пароль'
    ));

    $this->getValidator('username')->setOption('required', false);
//    $this->setValidator('username',
//    new sfValidatorAnd(array(
//    new sfValidatorString(array(
//          'required' => true,
//          'trim' => true,
//          'min_length' => 4,
//          'max_length' => 16
//    ), array('required' => 'Обязательное поле')
//    ),
//    // Usernames should be safe to output without escaping and generally username-like.
//    new sfValidatorRegex(array(
//          'pattern' => '/^\w+$/'
//          ), array('invalid' => 'Имя пользователя может содержать только латинские буквы, цифры и знак подчеркивания ("_")')),
//          new sfValidatorRegex(array(
//          'pattern' => '/^anonymous*/',
//          'must_match' => false
//          ), array('invalid' => 'Такой пользовательуже зарегистрирован.')),
//          new sfValidatorDoctrineUnique(array(
//          'model' => 'sfGuardUser',
//          'column' => 'username'
//          ), array('invalid' => 'Такой пользователь уже зарегистрирован.'))
//          ))
//          );
//
          // Passwords are never printed - ever - except in the context of Symfony form validation which has built-in escaping.
          // So we don't need a regex here to limit what is allowed

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
      'required' => 'Обязательное поле',
      'trim' => true,
      'min_length' => 6,
      'max_length' => 128
          ), array(
      'min_length' => 'Введеный пароль слишком короткий. Он должен состоять как минимум из %min_length% символов.',
      'required' => 'Повторите пароль')));

          // Be aware that sfValidatorEmail doesn't guarantee a string that is preescaped for HTML purposes.
          // If you choose to echo the user's email address somewhere, make sure you escape entities.
          // <, > and & are rare but not forbidden due to the "quoted string in the local part" form of email address
          // (read the RFC if you don't believe me...).
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
          //      new sfValidatorSchemaCompare(
          //        'email',
          //        sfValidatorSchemaCompare::EQUAL,
          //        'email2',
          //        array(),
          //        array('invalid' => 'The email addresses did not match.')
          //      ),
          );

          if ($postValidator)
          {
            $postValidators[] = $postValidator;
          }

          $this->validatorSchema->setPostValidator(new sfValidatorAnd($postValidators));
  }
  public function setValidate($validate)
  {
    $this->validate = $validate;
  }

}