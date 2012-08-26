<?php

/**
 * Cart Table Class
 *
 *
 * @author Astronom
 * @package MerryMall
 * @subpackage model
 * @version
 *
 */
class sCartTable extends Doctrine_Table
{
  public function findAllByUserId($user_id) {
    $q = Doctrine_Query::create()
    ->from('sCart c')
    ->leftJoin('c.sItemVariant m')
    ->Where('c.user_id = ?', $user_id);
    return $q->execute();
  }

  /**
   * Поиск позиции в корзине по его Id с привязкой к пользователю
   * Используется в Routing
   *
   * @param int $id
   * @return object Doctrine_Record
   */
  public function findOneByIdWhithUser($requestParams)
  {
    $q = $this->createQuery('c')
    ->Where('c.id = ?', $requestParams['id'])
    ->andWhere('c.user_id = ?', sfContext::getInstance()->getUser()->getAttribute('user_id','none','sfGuardSecurityUser'))
    ->andWhere('c.order_id = 0')
    ->limit('1');

    return $q->execute();
  }

   /**
   * Поиск всех позиции в корзине с привязкой к пользователю
   * Используется в Routing
   *
   * @param int $id
   * @return object Doctrine_Record
   */
  public function findAllWhithUserNotOrdered()
  {
    $q = $this->createQuery('c')
    ->Where('c.user_id = ?', sfContext::getInstance()->getUser()->getAttribute('user_id','none','sfGuardSecurityUser'))
    ->andWhere('c.order_id = 0');

    return $q->execute();
  }

   /**
   * Поиск всех позиции в корзине с привязкой к пользователю
   *
   * @return object Doctrine_Query
   */
  public function getAllWhithUserNotOrderedQuery()
  {
    $q = $this->createQuery('c')
    ->Where('c.user_id = ?', sfContext::getInstance()->getUser()->getAttribute('user_id','none','sfGuardSecurityUser'))
    ->andWhere('c.order_id = 0');

    return $q;
  }

  public function findWhithUser($id, $user_id)
  {
    $q = Doctrine_Query::create()
    ->from('sCart c')
    ->Where('c.id = ?', $id)
    ->andWhere('c.user_id = ?', $user_id)
    ->limit('1');
    return $q->fetchOne();
  }

  public function findAllByUserIdOrderByCompanyId() {
    $q = Doctrine_Query::create()
    ->from('sCart c')
    ->leftJoin('c.sItemVariant m')
    ->Where('c.user_id = ?', sfContext::getInstance()->getUser()->getId())
    ->orderBy('c.company_id');
    return $q->execute();
  }
  //Проверить бред в методе
  public function getNotOrderedCartItems(Doctrine_Query $q = null) {

    if(is_null($q)) {
      $q = Doctrine_Query::create()->from('sCart s');
    }

    $q->andWhere('order_id = 0');

    return $q->execute();
  }

  //Метод возвращает Doctrine объект со всеми позициями, для добавления в заказ
  public function findCartItemsToOrder() {
    $q = Doctrine_Query::create()
    ->from('sCart s')
    ->Where('s.user_id = ?', sfContext::getInstance()->getUser()->getId())
    ->andWhere('s.order_id = 0');
    return $q->execute();
  }

  /**
   * Возвращает объект корзины, если найдена указанная позиция
   * @param int $item_variant_id
   * @return Object sCart
   */
  public function findCartItemByItemVariantIdWithUserNotOdered($item_variant_id) {

    $q = $this->getAllByUserIdNotOrderedQuery();

    $q->select()
    ->andWhere('c.item_variant_id = ?', $item_variant_id)
    ->limit('1');

    return $q->fetchOne();
  }

  /**
   * Возвращает количество товаров в корзине,
   * если найдена указанная позиция по $item_variant_id
   *
   * @param int $item_variant_id
   * @return string
   */
  public function findOneByItemVariantIdAndUserId($item_variant_id)
  {
    return $this->getAllByUserIdNotOrderedQuery()
                ->select('c.count')
                ->andWhere('c.item_variant_id = ?', $item_variant_id)
                ->limit('1')
                ->fetchOne(array(),Doctrine_Core::HYDRATE_SINGLE_SCALAR);

  }

  /**
   * Готовит запрос к БД по Пользователю и свободным от заказа товарам в корзине
   *
   * @param User ID int $user_id
   * @return object Doctrine_Query
   *
   */
  public function getAllByUserIdNotOrderedQuery()
  {
    $q = $this->createQuery('c')
    ->select('c.id, c.count, c.price, c.user_id, c.company_id, c.item_variant_id, c.order_id')
    ->andWhere('c.user_id = ?', sfContext::getInstance()->getUser()->getAttribute('user_id','none','sfGuardSecurityUser'))
    ->andWhere('c.order_id = "0"');
    return $q;
  }

  /**
   * Удаление из корзины всех не заказанных позиций
   * с привязкой к пользователю пользователя
   *
   * @return object Doctrine_Record
   */
  public function deleteAllWhithUserNotOrdered()
  {
    return $this->getAllByUserIdNotOrderedQuery()
                ->delete()
                ->execute();
  }

  /**
   * Обновление корзины, вернет последние записи
   *
   * @param $user_id Required User Id
   * @return Array
   */
  public function findLastAdded($user_id) {

    return $this->getAllByUserIdNotOrderedQuery()
                ->orderBy('created_at DESC')
                ->limit('1')
                ->fetchOne(array(),Doctrine_Core::HYDRATE_SCALAR);

  }

  /*
   *
   *
   * @param
   * */
  public function refreshCart($user_id) {
    $q = Doctrine::getTable('sCart')
    ->createQuery('a')
    ->orderBy('created_at DESC')
    ->Where('user_id = ?', $user_id)
    ->andWhere('order_id = 0')
    ->limit('1');

    return $q->fetchOne();

  }
  
  public function findAllOrderedUserItems($user_id)
  {
    $q = $this->createQuery('c')
              ->where('c.user_id = ?', $user_id)
              ->andWhere('c.order_id > 0');
              
    return $q;
  }


}
