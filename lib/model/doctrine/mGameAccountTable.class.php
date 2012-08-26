<?php

/**
 * mGameAccount Table Class
 * @author Astronom
 *
 */
class mGameAccountTable extends Doctrine_Table
{

    public static function getInstance()
    {
        return Doctrine_Core::getTable('mGameAccount');
    }

    /**
     * Вернет данные аккаунта пользователя совместо с его корзиной
     * @return string
     */
    public function getOneByIdWithmGameCartQuery($account_id)
    {
      $q = $this->createQuery('a')
      //->select('a.id, a.round, a.rating, a.money, a.money_spent, a.credit')
      //->leftJoin('a.')
      ->where('a.id = ?',$account_id)
      ->limit('1');

      return $q;
    }

    public function getLimitedOrderByRatingQuery($limit)
    {
      $q = $this->createQuery('a')
      ->orderBy('a.rating DESC')
      ->limit($limit);

      return $q;
    }

    /**
     * Вычисляет позицию игрока, основываясь на количестве игроков с большим рейтингом
     *
     * @param int $accountRating
     * @return Doctrine_Query
     */
    public function getAccountPositionByRatingQuery($accountRating)
    {
      $q = $this->createQuery('a')
      ->select('COUNT(*)')
      ->where('a.rating > ?', $accountRating);

      return $q;

    }
}