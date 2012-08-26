<?php


class mGameCartTable extends Doctrine_Table
{

  public static function getInstance()
  {
    return Doctrine_Core::getTable('mGameCart');
  }

  public function find10RecentItemsWithItemVariant($gameAccountId)
  {
    $q = $this->createQuery('c')
    ->select('c.price, iv.name')
    ->leftJoin('c.sItemVariant iv')
    ->where('c.account_id = ?', $gameAccountId)
    ->orderBy('c.created_at DESC')
    ->limit('10');

    return $q->execute(array(), Doctrine_Core::HYDRATE_ARRAY);
  }

  /**
   * Поиск позиции в корзине по его Id с привязкой к пользователю
   * Используется в Routing
   *
   * @param int $id
   * @return object Doctrine_Record
   */
  public function findOneByIdWhithAccount($requestParams)
  {
    $q = $this->createQuery('c')
    ->Where('c.id = ?', $requestParams['id'])
    ->andWhere('c.account_id = ?', sfContext::getInstance()->getUser()->getAttribute('game_account_id',null,'sfGuardSecurityUser'))
    ->limit('1');

    return $q->fetchOne();
  }

  public function findAllByAccountIdOrderByRound($gameAccountId)
  {
    $q = $this->createQuery('c')
    ->select('c.price, iv.name, c.round')
    ->leftJoin('c.sItemVariant iv')
    ->where('c.account_id = ?', $gameAccountId)
    ->orderBy('c.round DESC');

    return $q->execute(array(), Doctrine_Core::HYDRATE_ARRAY);

  }
  public function countAccountItemVariantsInTour($item_variant,$gameAccountId)
  {
    $q = $this->createQuery('c')
    ->select('COUNT(c.id)')
    ->leftJoin('c.mGameAccount a')
    ->where('c.account_id = ?', $gameAccountId)
    ->andWhere('c.company_id =?', $item_variant['iv_company_id'])
    ->andWhere('c.round = a.round');

    return $q->execute(array(), Doctrine_Core::HYDRATE_SINGLE_SCALAR);
  }

  public function findAllByAccountIdNotCheckouted($gameAccountId)
  {
    $q = $this->createQuery('c')
    ->select('*')
    ->leftJoin('c.sItemVariant iv')
    //->leftJoin('c.mGameAccount a')
    ->where('c.account_id = ?', $gameAccountId)
    ->andWhere('c.checkout = "false"');
    //->andWhere('c.round = a.round');

    return $q->execute();

  }

  /**
   * Извлекает все товары, положенные в корзину за текущий тур
   *
   * @param Int $gameAccountId
   * @return Doctrine_Query
   */
  public function getAllInCurentTourByAccountIdQuery($gameAccountId)
  {
    $q = $this->createQuery('c')
    ->select('*')
    ->leftJoin('c.mGameAccount a')
    ->where('c.account_id = ?', $gameAccountId)
    ->andWhere('c.round = a.round');

    return $q;

  }
}