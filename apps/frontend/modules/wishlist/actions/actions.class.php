<?php

/**
 * wishlist actions.
 *
 * @package    merrymall
 * @subpackage wishlist
 * @author     Wronglink, Astronom <a.manichev@gmail.com>
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class wishlistActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->redirect('@private_area');
  }

  /**
   * Execute Add Action
   * Добавление товара в вишлист
   *
   * @param $request sfWebRequest
   */
  public function executeAdd(sfWebRequest $request)
  {
    $newWishlist = new sWishlist();
    $newWishlist->addWishlist($request->getParameter('item_variant_id'),$this->getUser()->getId());

    return $this->renderText('<a class="store-item-wishlist" href="/private_area"><img src="/images/icons/check_mark_16x16.png" title="Посмотреть вишлист" /></a>');
  }

  //Обновление вишлиста, выдаст последнюю добавленную запись
  public function executeRefresh(sfWebRequest $request)
  {

    $this->forward404Unless($wish = Doctrine::getTable('sWishlist')->findRecentlyAdded($this->getUser()->getId()));

    $form = new baseForm();
    $secret_name = $form->getCSRFFieldName();
    $secret_value = $form->getCSRFToken();

    return $this->renderPartial('privateArea/wishlist',
                              array('wishlist' => $wish,
         						   'secret_name' => $secret_name,
         						   'secret_value' => $secret_value));
  }

  public function executeDelete(sfWebRequest $request)
  {
    $user_id = $this->getUser()->getId();

    $this->forward404Unless($s_wishlist = Doctrine::getTable('sWishlist')->findWhithUser($request->getParameter('id'),$user_id), sprintf('Object s_wishlist does not exist (%s).', $request->getParameter('id')));
    $s_wishlist->delete();

    if($request->isXmlHttpRequest())
    {
      return $this->renderText('Удалено');
    }
    else
    {
      $this->froward('privateArea','index');
    }

  }
  //  Перенос товара из вишлиста в корзину
  public function executeMoveToCart(sfWebRequest $request)
  {
    //$request->checkCSRFProtection();

    $user_id = $this->getUser()->getId();

    //Проверяем есть ли такая позиция у пользователя в вишлисте, если нет выдаем 404
    $this->forward404Unless($s_wish = Doctrine::getTable('sWishlist')->findWhithUser($request->getParameter('id'),$user_id), sprintf('Object s_wish does not exist (%s).', $request->getParameter('id')));

    $conn = Doctrine::getTable('sWishlist')->getConnection();

    $mover = new sWishlist();

    $mover->moveToCart($s_wish, $conn, $user_id, $s_wish->getItemVariantId());

    if($request->isXmlHttpRequest())
    {
      return true;
    }
    else
    {
      $this->redirect('@private_area');
    }
  }

}
