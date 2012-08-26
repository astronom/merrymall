<?php

/**
 * privateArea actions.
 *
 * @package    merrymall
 * @subpackage privateArea
 * @author     Wronglink
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class privateAreaActions extends sfActions
{
  /**
   * Executes index action
   *
   * @param sfRequest $request A request object
   */
  public function executeIndex(sfWebRequest $request)
  {
    $user_id = $this->getUser()->getId();

    $this->floors = Doctrine::getTable('Floor')->findAll();

    //$this->wishlist = Doctrine::getTable('sWishlist')->findLimitedByUserIdJoinItemVariantsJoinItemsJoinImages($user_id,0);
    //$this->wishlist_count = count($this->wishlist->toArray());

    $this->companies = Doctrine::getTable('Company')->findAllJoinSCartJoinSItemVariantsJoinSItemJoinSImages($user_id);
    $this->companies_count = count($this->companies->toArray());

    $signInClassForm = sfConfig::get('app_sf_guard_plugin_signin_form', 'sfGuardFormSignin');
    $this->userForm = new $signInClassForm();

    $class = sfConfig::get('app_sf_guard_plugin_register_form', 'sfGuardFormRegister');
    $this->registerForm = new $class();

    $this->orderForm = new sOrderForm();

    $this->ordersList = Doctrine::getTable('sCart')->findAllOrderedUserItems($user_id)->execute();

    $form = new baseForm();
    $this->secret_name = $form->getCSRFFieldName();
    $this->secret_value = $form->getCSRFToken();

    //$this->profileForm = new mmsfGuardUserProfileForm($this->getUser()->getGuardUser());

  }

  public function executeOrderInfo(sfWebRequest $request)
  {
    $user_id = $this->getUser()->getId();
    $this->forward404Unless($this->order = Doctrine::getTable('sOrder')->findOneByIdAndUserId($request->getParameter('order_id'),$user_id)->fetchOne(), 'Такого заказа не существует');
  }

  public function executeSignin(sfWebRequest $request)
  {
    if ($request->isXmlHttpRequest())
    {
      $signInClassForm = sfConfig::get('app_sf_guard_plugin_signin_form', 'sfGuardFormSignin');
      $userForm = new $signInClassForm();

      $class = sfConfig::get('app_sf_guard_plugin_register_form', 'sfGuardFormRegister');
      $registerForm = new $class();

      return $this->renderPartial('orderSignin',array('userForm' => $userForm, 'registerForm' => $registerForm));
    }
    else
    {
      $this->redirect('private_area');
    }
  }

  public function executeCart(sfWebRequest $request)
  {
    $user_id = $this->getUser()->getId();

    $form = new baseForm();
    $secret_name = $form->getCSRFFieldName();
    $secret_value = $form->getCSRFToken();

    if ($request->isXmlHttpRequest())
    {
      $companies = Doctrine::getTable('Company')->findAllJoinSCartJoinSItemVariantsJoinSItemJoinSImages($user_id);
      $companies_count = count($companies->toArray());

      return $this->renderPartial('orderCart',array('companies' => $companies, 'companies_count' => $companies_count, 'secret_name' => $secret_name, 'secret_value' => $secret_value));
    }
    else
    {
      $this->redirect('private_area');
    }
  }

  public function executeDelivery(sfWebRequest $request)
  {
    if ($request->isXmlHttpRequest())
    {
      $orderDeliveryForm = new sOrderForm();
      $companies = Doctrine::getTable('Company')->getCompaniesByUserCartQuery($this->getUser()->getId())->execute();

//    Если запрос был Post
      if($request->isMethod('post'))
      {
//      Проверяем форму
        $orderDeliveryForm->bind($request->getParameter($orderDeliveryForm->getName()));
//      Данные формы прошли валидацию
        if($orderDeliveryForm->isValid())
        {
          //$orderDeliveryForm->save();
          $this->getUser()->setAttribute('userName', $orderDeliveryForm->getValue('userProfile|firstname'), 'mmOrder');
          $this->getUser()->setAttribute('userPhone', $orderDeliveryForm->getValue('userProfile|phone'), 'mmOrder');
          $this->getUser()->setAttribute('address', $orderDeliveryForm->getValue('address'), 'mmOrder');
          $this->getUser()->setAttribute('comment', $orderDeliveryForm->getValue('comment'), 'mmOrder');

          return $this->returnJSON(array('success' => true));
        }
//      Данные формы не прошли валидацию. Собираем ошибки и отправляем их в виде JSON объекта
        else
        {
          $output = array("success" => false);
          foreach ($orderDeliveryForm->getFormFieldSchema() as $name => $formField)
          {
            if(($error_name = $formField->getError()) !=NULL)
            {
              $output[sprintf($orderDeliveryForm->getWidgetSchema()->getNameFormat(),$name)] = addcslashes($error_name,'"');
            }
          }
          return $this->returnJSON($output);
        }
      }
      return $this->renderPartial('orderDelivery',array('orderDeliveryForm' => $orderDeliveryForm, 'companies' => $companies));
    }
    else
    {
      $this->redirect('private_area');
    }
  }

  public function executePayment(sfWebRequest $request)
  {
    if ($request->isXmlHttpRequest())
    {
      return $this->renderPartial('orderPayment');
    }
    else
    {
      $this->redirect('private_area');
    }
  }

  public function executeSugest(sfWebRequest $request)
  {
    $user_id = $this->getUser()->getId();
    $orderList = Doctrine::getTable('sOrder')->findAllPreoderedJoinSCartJoinSItemVariantsJoinSItem($user_id);


    if ($request->isXmlHttpRequest())
    {
      if($request->isMethod('post'))
      {
        //Создаем заказа
        $newOrder = new sOrder();
        $newOrder->setAddress($this->getUser()->getAttribute('address', '', 'mmOrder'));
        $newOrder->setComment($this->getUser()->getAttribute('comment', '', 'mmOrder'));
        $newOrder->save();

        //Отмечаем номер заказа в позициях корзины
        $carts = Doctrine::getTable('sCart')->findCartItemsToOrder();
        $company_id = 0;
        foreach($carts as $cart) {

          if($cart->getCompanyId() != $company_id)
          {
            $company_id = $cart->getCompanyId();

            $newCompanyOrder = new sCompanyOrder();
            $newCompanyOrder->setOrderId($newOrder->getId());
            $newCompanyOrder->setCompanyId($company_id);
            $newCompanyOrder->setDeliveryPrice('0');
            $newCompanyOrder->save();
          }

          $cart->setOrderId($newOrder->getId());
          $cart->save();
        }

        //Отправляем емэйл
        $message = $this->getMailer()->compose(
        array('support@merrymall.ru' => 'Администрация MerryMall'),
        $this->getUser()->getProfile()->getEmail(),
          'Заказ № '.$newOrder->getId().' с сайта MerryMall',
        $this->getComponent('mail', 'body', array('partial' => 'orderSet', 'vars' => array(
      											'orderList'       => $orderList,
                                                'orderId'         => $newOrder->getId(),
      											'userFullName'    => $this->getUser()->getAttribute('userName', '', 'mmOrder'),
                                                'userPhone'		  => $this->getUser()->getAttribute('userPhone', '', 'mmOrder'),
                                                'orderDelivery'   => $this->getUser()->getAttribute('address', '', 'mmOrder'),
                                                'orderComment'    => $this->getUser()->getAttribute('comment', '', 'mmOrder')
        )))
        );

        $message->setContentType("text/html");
        $this->getMailer()->send($message);

        //уничтожаем записи в пользовательской сессии
        $this->getUser()->getAttributeHolder()->removeNamespace('mmOrder');

        return $this->returnJSON(array('success' => true));
      }

      return $this->renderPartial('orderSugest',array(
      											'orderList'       => $orderList,
      											'userFullName'    => $this->getUser()->getAttribute('userName', '', 'mmOrder'),
                                                'userPhone'		  => $this->getUser()->getAttribute('userPhone', '', 'mmOrder'),
                                                'orderDelivery'   => $this->getUser()->getAttribute('address', '', 'mmOrder'),
                                                'orderComment'    => $this->getUser()->getAttribute('comment', '', 'mmOrder'),
      ));
    }
    else
    {
      $this->redirect('private_area');
    }
  }


  /**
   * Executes Edit Profile Action
   *
   * @param sfWebRequest $request
   */
  public function executeEditProfile(sfWebRequest $request)
  {
    $this->profileForm = new mmsfGuardUserProfileForm($this->getUser()->getGuardUser());

    if($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT)) {
      $this->profileForm->bind($request->getParameter($this->profileForm->getName()));
      if ($this->profileForm->isValid())
      {
        $this->profileForm->save();
      }
    }
  }

  public function executeUpdateProfile(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));

    $this->form = new sfGuardUserProfileForm($this->getUser()->getProfile());

    $this->form->bind($request->getParameter($this->form->getName()));
    if ($this->form->isValid())
    {
      $this->form->save();
      //return $this->renderText('Ваши данные сохранены');
    }
    else $this->setTemplate('index');

  }

  public function executeUpdate(sfWebRequest $request)
  {
    if($request->isMethod('put')) {
      $this->form = new sfGuardUserProfileForm($this->getUser()->getProfile());
      $this->processForm($request, $this->form);
      $this->setTemplate('editProfile');
    }
    else $this->forward404();
  }
  // FIXME Для рефакторинга. Наверно следует перенести это действие в s_order или отказать от него как от модуля
  public function executeAddOrder(sfWebRequest $request)
  {
    $user_id = $this->getUser()->getId();

    $this->forward404Unless($request->isMethod(sfRequest::POST));
    $this->orderForm = new sOrderForm();

    $this->orderForm->bind($request->getParameter($this->orderForm->getName()));
    if ($this->orderForm->isValid())
    {
      $this->orderForm->save();
      $this->setTemplate('index');
    }
    else $this->setTemplate('index');

    $this->floors = Doctrine::getTable('Floor')->findAll();

    $this->wishlist = Doctrine::getTable('sWishlist')->findLimitedByUserIdJoinItemVariantsJoinItemsJoinImages($user_id,0);
    $this->wishlist_count = count($this->wishlist->toArray());

    $this->companies = Doctrine::getTable('Company')->findAllJoinSCartJoinSItemVariantsJoinSItemJoinSImages($user_id);
    $this->companies_count = count($this->companies->toArray());


    $form = new baseForm();
    $this->secret_name = $form->getCSRFFieldName();
    $this->secret_value = $form->getCSRFToken();

    $this->referer = $request->getReferer();

    $this->setTemplate('index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()));

    if($form->isValid())
    {
      $form->save();
      $this->redirect('@private_area');
    }
    // Шаблон для редактирования профиля
    else $this->setTemplate('editProfile');
  }

  protected function sendMail($to, $from = array('admin@merrymall.ru' => 'Администрация MerryMall') )
  {
    $message = $this->getMailer()->compose(
    array('admin@merrymall.ru' => 'Администрация MerryMall'),
    $this->email,
          'Восстановление пароля на MerryMall.ru',
    $this->getPartial( 'restoreMail', array(
            'login' => $restoreUser->getUsername(),
            'password' => '123456',
          	'guid' => $guid
    ))
    );
    $message->setContentType("text/html");
    $this->getMailer()->send($message);
  }

  /**
   * Метод, отдающий данные в JSON формате
   * @param Array $output
   * @return JSON String <sfView::NONE, string>
   */
  private function returnJSON($output)
  {
    $this->getResponse()->setHttpHeader('Content-type', 'application/json');
    return $this->renderText(json_encode($output));
  }
}
