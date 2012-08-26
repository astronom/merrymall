<?php

class sWishlistTable extends Doctrine_Table
{

/**
 * Метод реализует выборку из таблицы sWishlist по id пользователя
 *
 * $user_id - id пользователя
 * $limit   - колличество выводимых позиций
 */
  public function findLimitedByUserIdJoinItemVariantsJoinItemsJoinImages($user_id, $limit = 4) {
    $q = Doctrine_Query::create()
      ->from('sWishlist sW')
      ->leftJoin('sW.sItemVariant iV')
      ->leftJoin('iV.sItem i')
      ->leftJoin('i.sImages')
      ->Where('sW.user_id = ?', $user_id)
      ->limit($limit);
    return $q->execute();
  }

  public function findWhithUser($id, $user_id) {
      $q = Doctrine_Query::create()
      ->from('sWishlist s')
      ->Where('s.user_id = ?', $user_id)
      ->andWhere('s.id = ?', $id)
      ->limit('1');
    return $q->fetchOne();
  }

  /**
   * Метод возвращает последнюю добавленную запись пользователем в вишлист
   *
   * @param integer Required $user_id Id Пользователя
   */
  public function findRecentlyAdded($user_id) {

    $q = Doctrine_Query::create()
    ->from('sWishlist s')
    ->leftJoin('s.sItemVariant i')
    ->leftJoin('i.Company c')
    ->orderBy('s.created_at DESC')
    ->Where('s.user_id = ?', $user_id)
    ->limit('1');

    return $q->execute();
  }
/**
 * Метод Возвращает запись по:
 *
 * @param int $item_variant_id
 * @param int $user_id
 *
 * @return Doctrine_Record
 */
  public function findByItemVariantIdAndUserId($item_variant_id, $user_id)
  {
    $q = $this->createQuery('w')
              ->where('w.item_variant_id = ?', $item_variant_id)
              ->andWhere('w.user_id = ?', $user_id);

    return $q->fetchOne();
  }

  public function findAllByUserId($user_id) {
    $q = Doctrine_Query::create()
    ->from('sWishlist w')
    ->leftJoin('w.sItemVariant i')
    ->Where('w.user_id = ?', $user_id);
    return $q->execute();
  }
}