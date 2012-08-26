<?php

/**
 * cart actions.
 *
 * @package    merrymall
 * @subpackage cart
 * @author     Wronglink
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class mGameCartActions extends sfActions
{
  protected $gameAccountId;
  public function preExecute()
  {
    $this->gameAccountId = $this->getUser()->getAttribute('game_account_id', null, 'sfGuardSecurityUser');
  }

  public function executeIndex(sfWebRequest $request)
  {
    $this->redirect('@private_area');
  }

  /**
   * Добавляет товар в корзину игрока, проверяя перед этим правила
   *
   * @param sfWebRequest $request
   * @return Json if XmlHttpRequest or Redirect
   */
  public function executeAdd(sfWebRequest $request)
  {
    //  проверяем существует ли товар
    $this->forward404Unless($item_variant = Doctrine::getTable('sItemVariant')
    ->findOneEnabledItemVariantWithCompanyTypeAndCompanyUrl($request->getParameter('item_variant_id'))
    ,'Товар не найден');

    // Учитываем ограничения по колисчеству покупок в одном магазине
    if(mGameCartTable::getInstance()->countAccountItemVariantsInTour($item_variant,$this->gameAccountId) >= sfConfig::get('app_m_game_max_purchase_on_store_by_tour',2))
    {
      if($request->isXmlHttpRequest())
      {
        return $this->returnJSON(array('success' => false, 'error_massage' => 'В данном туре вы больше не можите покупать в этом магазине'));
      }
      else
      {
        return $this->redirect($request->getReferer());
      }
    }

    // Проверяем выполнились ли условия тура
    $account = mGameAccountTable::getInstance()->findOneById($this->gameAccountId);
    $roundRules = mGameRoundRulesTable::getInstance()->findOneByRound($account->round);
    $countCartItems = mGameCartTable::getInstance()->getAllInCurentTourByAccountIdQuery($this->gameAccountId)->count();

    if(!$roundRules->checkRoundRules($countCartItems))
    {
      if($request->isXmlHttpRequest())
      {
        return $this->returnJSON(array('success' => false, 'notice_massage' => $this->getPartial('mGameAccount/roundEnd',array('round' => $roundRules->getRound()))));
      }
      else
      {
        return $this->redirect($request->getReferer());
      }
    }

    $newCartItem = new mGameCart();
    $returnCartItem = $newCartItem->addCartItem($item_variant);

    if($request->isXmlHttpRequest())
    {
      if($returnCartItem['exist']==true)
      {
        return $this->returnJSON(array('success' => true,
                                     'cart_item' => array(
                                     					  'exist' => $returnCartItem['exist'],
                                                          'id'    => $returnCartItem['id'],
                                                          'price' => $item_variant['iv_price'],
                                                          'count' => $returnCartItem['count']
        )));
      }
      else {
        return $this->returnJSON(array('success' => true,
                                       'cart_item' => $this->getPartial('responseToRefresh',
        array('item_variant' => $item_variant,
                                                                        	  'cartItem'     => $returnCartItem))));
      }
    }
    else
    {
      if($request->getReferer()!='')
      {
        $this->redirect($request->getReferer());
      }
      else $this->redirect('@homepage');
    }
  }

  /**
   * Обновление корзины
   * @param sfWebRequest $request
   * @return
   */
  public function executeRefresh(sfWebRequest $request)
  {
    $cartItem = Doctrine::getTable('sCart')->refreshCart_($this->getUser()->getId());
    $form = new BaseForm();
    $secret_value = $form->getCSRFToken();
    //@todo здесь логичнее использовать Json и отдать графическое обновление корзины на сторону клиента, но это на будущее, а пока просто renderPartial
    return $this->renderPartial('newCartItem',array('cartItems' => $cartItems, 'secret_value' => $secret_value));

  }

  public function executeRefresh_(sfWebRequest $request)
  {
    $companies = Doctrine::getTable('Company')->getWithCart($this->getUser()->getId());

    $form = new BaseForm();
    $secret_value = $form->getCSRFToken();
    $secret_name = $form->getCSRFFieldName();

    //@todo здесь логичнее использовать Json и отдать графическое обновление корзины на сторону клиента, но это на будущее, а пока просто renderPartial

    return $this->renderPartial('privateArea/cart', array('companies' => $companies, 'secret_name' => $secret_name, 'secret_value' => $secret_value ));

  }

  /**
   * Проверит наличие товара в корзине
   *
   * @param sfWebRequest $request
   * @return Ambigous <sfView::NONE, string>|boolean
   */
  public function executeCheckCartItem(sfWebRequest $request)
  {
    $cartItemCount = Doctrine::getTable('sCart')->findOneByItemVariantIdAndUserId($request->getParameter('item_variant_id',0));

    if($request->isXmlHttpRequest())
    {
      if($cartItemCount)
      {
        return $this->returnJSON(array('success' => true,
                                       'message' => 'Такой товар уже есть в корзине ('.$cartItemCount.' шт)'));
      }
      else return $this->returnJSON(array('success' => true));
    }
    else $this->forward404('Страницы не существует');
  }


  /**
   * Удаляет позицию в игровой корзине
   *
   * @param sfWebRequest $request
   * @return boolean
   */
  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $cartItem = $this->getRoute()->getObject();
    $cartItem->delete();

    if($request->isXmlHttpRequest())
    {
      return $this->returnJSON(array('success' => true));
    }
    else
    {
      if($request->getReferer()!='')
      {
        $this->redirect($request->getReferer());
      }
      else $this->redirect('@homepage');
    }
  }

  /**
   * Полностью очищает корзину
   *
   * @param sfWebRequest $request
   * @return Json if XmlHttpRequest or Redirect
   */
  public function executeClean(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless(Doctrine::getTable('sCart')->deleteAllWhithUserNotOrdered(),'Корзина уже пуста');

    if($request->isXmlHttpRequest())
    {
      return $this->returnJSON(array('success' => true));
    }
    else
    {
      if($request->getReferer()!='')
      {
        $this->redirect($request->getReferer());
      }
      else $this->redirect('@homepage');
    }
  }

  public function executeMoveToWishlist(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $user_id = $this->getUser()->getId();

    //Проверяем есть ли такая позиция у пользователя в корзине, если нет выдаем 404
    $this->forward404Unless($s_cart = Doctrine::getTable('sCart')->findWhithUser($request->getParameter('id'),$user_id), sprintf('Object s_cart does not exist (%s).', $request->getParameter('id')));

    $conn = Doctrine::getTable('sCart')->getConnection();

    $mover = new sCart();

    $response = $mover->moveToWishlist($s_cart, $conn, $user_id, $s_cart->getItemVariantId());
    $this->setVar('response',$response);

    if($request->isXmlHttpRequest())
    {
      return $this->renderPartial('responseToRefresh',array('response' => $response));
    }
    else
    {
      $this->redirect('@private_area');
    }
  }

  public function executeArchive(sfWebRequest $request)
  {
    $this->cartItems = mGameCartTable::getInstance()->findAllByAccountIdOrderByRound($this->gameAccountId);
  }

  /**
   * Оформление покупок
   * @param sfWebRequest $request
   * @return Ambigous <JSON, sfView::NONE, string>
   */
  public function executeCheckout(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($cartItemsToCheckout = mGameCartTable::getInstance()->findAllByAccountIdNotCheckouted($this->gameAccountId));

    // Проверяем выполнились ли условия тура
    $account = mGameAccountTable::getInstance()->findOneById($this->gameAccountId);
    $roundRules = mGameRoundRulesTable::getInstance()->findOneByRound($account->round);
    $countCartItems = mGameCartTable::getInstance()->getAllInCurentTourByAccountIdQuery($this->gameAccountId)->count();

    if(!$roundRules->checkRoundRules($countCartItems))
    {
      $partial = 'mGameAccount/roundNext';
    }
    else
    {
      $partial = 'checkoutMessage';
    }

    foreach ($cartItemsToCheckout as $cartItem)
    {
      $cartItem->checkout();
      $cartItem->save();
    }

    if($request->isXmlHttpRequest())
    {
      return $this->returnJSON(array('success' => true,
      								 'checkout_message' => $this->getPartial($partial, array('round' => $account->round))));
    }
    else
    {
      if($request->getReferer()!='')
      {
        $this->redirect($request->getReferer());
      }
      else $this->redirect('@homepage');
    }
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
