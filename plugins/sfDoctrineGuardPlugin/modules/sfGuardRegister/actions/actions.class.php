<?php

/*
 * This file is part of the symfony package.
 * (c) 2004-2006 Fabien Potencier <fabien.potencier@symfony-project.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 *
 * @package    symfony
 * @subpackage plugin
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 * @version    SVN: $Id: actions.class.php 23319 2009-10-25 12:22:23Z Kris.Wallsmith $
 */
class sfGuardRegisterActions extends sfActions
{
  public function executeRegister(sfWebRequest $request)
  {
    // если пользователь авторизован -
    // шлем нафиг (на хоумпэйдж)
    $user = $this->getUser();
    if ($user->isAuthenticated()
    &&
    !$user->hasCredential(array('anonymous')))
    {
      if($request->isXmlHttpRequest())
      {
        return $this->returnJSON(array('success' => false, 'error_message' => 'Вы уже авторазованы на сайте'));
      }
      return $this->redirect('@homepage');
    }

    $class = sfConfig::get('app_sf_guard_plugin_register_form', 'sfGuardFormRegister');
    $this->form = new $class();

    if ($request->isMethod('post'))
    {
      $this->form->bind($request->getParameter('register'));
      if ($this->form->isValid())
      {

        // Если все нормально - сохраняем форму
        $guid = "n" . self::createGuid();
        $this->form->setValidate($guid);
        $this->form->save();

        //Отправляем емэйл
        $message = $this->getMailer()->compose(
        array('support@merrymall.ru' => 'Администрация MerryMall'),
        $this->form->getValue('email'),
          'Регистрация на MerryMall.ru',
        $this->getComponent('mail', 'body', array('partial' => 'register', 'vars' => array(
            'login' => $this->form->getValue('username'),
            'password' => $this->form->getValue('password'),
            'guid' => $guid
        )))
        );
        $message->setContentType("text/html");
        $this->getMailer()->send($message);

        $this->email = $this->form->getValue('email');
        $this->username = $this->form->getValue('username');

        //      Если запрос был Ajax, то возращаем JSON true
        if($request->isXmlHttpRequest())
        {
          return $this->returnJSON(array('success' => true));
        }
        //      Иначе выставляем темплэйт
        return sfView::SUCCESS;
      }
      //    Данные формы не прошли валидацию
      else {
        //      Если запрос был Ajax, то возращаем JSON ошибки
        if($request->isXmlHttpRequest())
        {
          $output = array('success' => false);
          $form_namespace = $this->form->getWidgetSchema()->getNameFormat();

          foreach ($this->form->getFormFieldSchema() as $name => $formField)
          {
            if(($error_name = $formField->getError()) !=NULL)
            {
              $output[sprintf($form_namespace,$name)] = addcslashes(preg_replace(array("/[a-zA-Z]/",'/\[/','/\]/'), '', $error_name),'"');
            }
          }
          return $this->returnJSON($output);
        }
      }
    }
    if($request->isXmlHttpRequest())
    {
      return $this->renderPartial('registrationForm',array('form' => $this->form));
    }

    return 'New';
  }

  static private function createGuid()
  {
    $guid = "";
    for ($i = 0; ($i < 8); $i++) {
      $guid .= sprintf("%02x", mt_rand(0, 255));
    }
    return $guid;
  }

  public function executeRestorePassword($request)
  {

    // если пользователь авторизован -
    // шлем нафиг (на хоумпэйдж)
    $user = $this->getUser();
    if ($user->isAuthenticated()
    &&
    !$user->hasCredential(array('anonymous')))
    {
      return $this->redirect('@homepage');
    }

    //Форма по восстановлению пароля. Не было в поставляемом плагине, лежит в /lib/form/doctrine/sfDoctrineGuardPlugin
    $this->form = new sfGuardRestorePasswordCheckUserForm();

    if ($request->isMethod('post'))
    {
      $this->form->bind($request->getParameter('restorePassword'));
      if ($this->form->isValid())
      {
        $restoreUser = Doctrine::getTable('sfGuardUser')->retrieveByUsernameOrEmail($this->form->getValue('username_or_email'));
		if($restoreUser) {
	        // Берем Email пользователя
	        $this->email = $restoreUser->getProfile()->getEmail();

	        //Создаем ключ верификации
	        $guid = "n" . self::createGuid();
	        $restoreUser->getProfile()->setValidate($guid);
	        $restoreUser->save();

	        //Отправляем емэйл
	        $message = $this->getMailer()->compose(
	        array('admin@merrymall.ru' => 'Администрация MerryMall'),
	        $this->email,
	          'Восстановление пароля на MerryMall.ru',
	        $this->getPartial( 'restoreMail', array(
	            'login' => $restoreUser->getUsername(),
	            'guid' => $guid
	        ))
	        );
	        $message->setContentType("text/html");
	        $this->getMailer()->send($message);
			return sfView::SUCCESS;
		}
        else return sfView::ERROR;
      }
    }
    return 'New';
  }

  public function executeConfirm($request)
  {
    $user = Doctrine_Query::create()
    ->from("sfGuardUser u")
    ->innerJoin("u.Profile p with p.validate = ?", $request->getParameter('guid'))
    ->fetchOne();

    if (!$user)
    {
      return 'Invalid';
    }
    else
    {
      $user->setIsActive(true);
      $user->addGroupByName('Customer');
      $user->save();

//      $userGroup = new sfGuardUserGroup();
//      $userGroup->setUserId($user->getId());
//      $userGroup->setGroupId('3');
//      $userGroup->save();

      $this->getUser()->signin($user);
    }
  }

  public function executeResetPassword(sfWebRequest $request)
  {
    //Если пользователь не прошел проверку ключа валидации выкинуть 404 ошибку
    $this->forward404Unless($user = $this->checkValidation($request->getParameter('guid')));

    $this->user = $user->getProfile()->getLastName().' '.$user->getProfile()->getFirstName().' ('.$user->getUsername().')';
    $this->guid = $request->getParameter('guid');
    $this->form = new sfGuardResetPasswordForm($user->getProfile());

    $this->form->bind($request->getParameter('resetPassword'));
    if($this->form->isValid())
    {
      $user->setPassword($this->form->getValue('password'));
      $user->save();
      $this->getUser()->signin($user);
      return sfView::SUCCESS;
    }
    return 'New';
  }

  protected function checkValidation($guid = null)
  {
    $user = Doctrine_Query::create()
    ->from("sfGuardUser u")
    ->innerJoin("u.Profile p with p.validate = ?", $guid)
    ->fetchOne();

    return $user;
  }

  private function returnJSON($output)
  {
    $this->getResponse()->setHttpHeader('Content-type', 'application/json');
    return $this->renderText(json_encode($output));
  }
}
