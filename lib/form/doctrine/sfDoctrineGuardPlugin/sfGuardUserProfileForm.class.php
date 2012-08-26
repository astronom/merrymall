<?php

/**
 * sfGuardUserProfile form.
 *
 * @package    merrymall
 * @subpackage form
 * @author     Wronglink
 * @version    SVN: $Id: sfDoctrinePluginFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class sfGuardUserProfileForm extends PluginsfGuardUserProfileForm
{
  public function configure()
  {

  	$this->useFields(array('lastname', 'firstname', 'patronymic', 'email', 'phone', 'address', 'id'));
  	$this->widgetSchema->setLabels(array(
  	'lastname'    => 'Фамилия',
  	'firstname'   => 'Имя',
  	'patronymic'  => 'Отчество',
  	'email' 	  => 'E-mail',
  	'phone' 	  => 'Контактный телефон',
  	'address' 	  => 'Адрес'
));


    //Настравиваем валидаторы
    $this->validatorSchema['email'] = new sfValidatorEmail(array(),array(
			'required'  => 'Введите адрес электронной почты',
			'invalid'   => 'Адрес электронной почты введен неверно, удостоверьтесь в правильности.'
			));
/*    $this->setValidator('firstname', new sfValidatorAnd(array(
        new sfValidatorString(array('max_length' => 80, 'required' => false)),
        new sfValidatorRegex(array(
          'pattern' => '/^[А-Яа-я]*$/',
          'must_match' => true
        ), array('invalid' => 'Имя пользователя может содержать только русские буквы')),
    )),array());
*/

	//Убираем случайные пробелы в начале и конце
	$this->getValidator('firstname')->setOption('trim', true);
    $this->getValidator('lastname')->setOption('trim', true);
    $this->getValidator('patronymic')->setOption('trim', true);
    $this->getValidator('phone')->setOption('trim', true);
    $this->getValidator('address')->setOption('trim', true);
  }
}
