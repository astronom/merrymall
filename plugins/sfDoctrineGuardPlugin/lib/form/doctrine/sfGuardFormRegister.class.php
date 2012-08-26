<?php

/**
 * BasesfGuardFormSignin
 *
 * @package    sfDoctrineGuardPlugin
 * @subpackage form
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 * @version    SVN: $Id: BasesfGuardFormSignin.class.php 23536 2009-11-02 21:41:21Z Kris.Wallsmith $
 */
class sfGuardFormRegister extends sfGuardUserProfileForm
{
  private $validate = null;

  public function configure()
  {
    //parent::configure();

    // Убираем лишние поля
    unset(
      $this['user_id'],
      $this['validate'],
      $this['lastname'],
      $this['firstname'],
      $this['phone'],
      $this['address'],
      $this['patronymic'],
      $this['created_at'],
      $this['updated_at']
    );

    // Устанавливаем порядок - Фамлия, Имя, Отчество.
//    $this->widgetSchema->moveField('lastname', sfWidgetFormSchema::BEFORE, 'firstname');
//    $this->widgetSchema->moveField('patronymic', sfWidgetFormSchema::AFTER, 'firstname');
      $this->widgetSchema->moveField('email', sfWidgetFormSchema::FIRST);
    // Добавляем необходимые виджеты

    $this->setWidget('username', new sfWidgetFormInputText(
           array(), array('maxlength' => 128)
           ));
    $this->widgetSchema->moveField('username', sfWidgetFormSchema::FIRST);

    $this->setWidget('password', new sfWidgetFormInputPassword(
           array(), array('maxlength' => 128)
           ));
    $this->widgetSchema->moveField('password', sfWidgetFormSchema::AFTER, 'username');

    $this->setWidget('password2', new sfWidgetFormInputPassword(
           array(), array('maxlength' => 128)
           ));
    $this->widgetSchema->moveField('password2', sfWidgetFormSchema::AFTER, 'password');

    $email = $this->getWidget('email');
    $class = get_class($email);
//    $this->setWidget('email2', new $class(
//           array(), array('maxlength' => $email->getAttribute('maxlength'))
//           ));
//    $this->widgetSchema->moveField('email2', sfWidgetFormSchema::AFTER, 'email');

//    $this->setWidget('promocode', new sfWidgetFormInputText(
//           array(), array('maxlength' => 128)
//           ));
    // Переводим надписи
    $this->widgetSchema->setLabels(array(
      'username'  => 'Логин',
      'password'  => 'Пароль',
      'password2' => 'Повторите пароль',
      'firstname' => 'Имя',
      'lastname'  => 'Фамилия',
      'patronymic'=> 'Отчество',
      'email'     => 'Email',
      'email2'    => 'Подтвердите email',
      'phone'     => 'Телефон',
      'address'   => 'Адрес',
      'promocode' => 'Промокод'
      ));

    //Теперь придумываем валидаторы
    // не забываем "тримать" все поля
//    $this->getValidator('firstname')->setOption('trim', true);
//    $this->getValidator('lastname')->setOption('trim', true);
//    $this->getValidator('patronymic')->setOption('trim', true);
//    $this->getValidator('phone')->setOption('trim', true);
//    $this->getValidator('address')->setOption('trim', true);

    // We have the right to an opinion on these fields because we
    // implement at least part of their behavior. Validators for the
    // rest of the user profile come from the schema and from the
    // developer's form subclass

    $this->setValidator('username',
      new sfValidatorAnd(array(
        new sfValidatorString(array(
          'required' => true,
          'trim' => true,
          'min_length' => 4,
          'max_length' => 16
        ), array('required' => 'Обязательное поле')
        ),
        // Usernames should be safe to output without escaping and generally username-like.
        new sfValidatorRegex(array(
          'pattern' => '/^\w+$/'
        ), array('invalid' => 'Имя пользователя может содержать только латинские буквы, цифры и знак подчеркивания ("_")')),
        new sfValidatorRegex(array(
          'pattern' => '/^anonymous*/',
          'must_match' => false
        ), array('invalid' => 'Такой пользовательуже зарегистрирован.')),
        new sfValidatorDoctrineUnique(array(
          'model' => 'sfGuardUser',
          'column' => 'username'
        ), array('invalid' => 'Такой пользователь уже зарегистрирован.'))
      ))
    );
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

    $this->setValidator('email', new sfValidatorAnd(array(
      new sfValidatorEmail(array('required' => true, 'trim' => true), array('required' => 'Введите E-mail')),
      new sfValidatorString(array('required' => true, 'max_length' => 80), array('required' => 'Введите E-mail')),
      new sfValidatorDoctrineUnique(array(
        'model' => 'sfGuardUserProfile',
        'column' => 'email'
      ), array('invalid' => 'Пользователь с таким E-mail уже есть в системе. Если вы забыли пароль, можете восстановить его в разделе "Забыли пароль?"',
               'required' => 'Введите E-mail'))
    )));

//    $this->setValidator('email2', new sfValidatorEmail(array(
//      'required' => true,
//      'trim' => true
//    )));

    // Disallow <, >, & and | in full names. We forbid | because
    // it is part of our preferred microformat for lists of disambiguated
    // full names in sfGuard apps: Full Name (username) | Full Name (username) | Full Name (username)
//    $this->setValidator('fullname', new sfValidatorAnd(array(
//      new sfValidatorString(array(
//        'required' => true,
//        'trim' => true,
//        'min_length' => 6,
//        'max_length' => 128)),
//        new sfValidatorRegex(array(
//          'pattern' => '/^[^<>&\|]+$/',
//        ), array('invalid' => 'Full names may not contain &lt;, &gt;, | or &amp;.'))
//    )));

//    $this->setValidator('promocode', new sfValidatorRegex(array('pattern' => '/123456/', 'trim' => true)));

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

    $this->widgetSchema->setNameFormat('register[%s]');
  }
  public function setValidate($validate)
  {
    $this->validate = $validate;
  }

  public function doSave($con = null)
  {
    //Create new User
    $this->user = new sfGuardUser();
    $this->user->setUsername($this->getValue('username'));
    $this->user->setPassword($this->getValue('password'));

    // They must confirm their account first
    $this->user->setIsActive(false);
    $this->user->save();
    $this->userId = $this->user->getId();

    //Set UserId and Validate in User Profile ($object)
    $object = $this->getObject();
    $object->setUserId($this->userId);
    $object->setValidate($this->validate);

    $object = parent::doSave($con);

    // Don't break subclasses!
    return $object;
  }

    //Всю реализацию перенес в метод выше. Этот оставлен до рефакторинга
//  public function updateObject($values = null)
//  {
//    $firephp = FirePHP::getInstance(true);
//    $object = parent::updateObject($values);
//    $firephp->fb($object,'User');
//    $object->setUserId($this->userId);
//    $object->setValidate($this->validate);
//
//    // Don't break subclasses!
//    return $object;
//  }
}
