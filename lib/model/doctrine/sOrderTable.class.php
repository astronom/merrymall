<?php

/**
 * sOrder Table Class
 *
 * @author Astronom
 * @package MerryMall
 * @subpackage model
 * @version    SVN: $Id: Builder.php 7021 2010-01-12 20:39:49Z lsmith $
 *
 */
class sOrderTable extends Doctrine_Table
{
  //Метод возвращает все отправленные(окончательно обработанные) заказы
  //доработать!
  public function cleanup($company_id)
  {
    if($company_id) {
    $q = $this->createQuery('i')
              ->delete()
              ->where("status = 'delivered'")
              ->andWhere('s.company_id = ?',$company_id);
    return $q->execute();
    }
    else return null;
  }

  public function retrieveBackendsOrdersList(Doctrine_Query $q)
  {
    $rootAlias = $q->getRootAlias();
    $q->leftJoin($rootAlias . '.sCarts c')
    ->leftJoin('c.sItemVariant v')
    ->leftJoin('c.sfGuardUser g')
    ->leftJoin('g.Profile p');
    //->leftJoin($rootAlias. '.sCompanyOrders co');

    return $q;
  }

  /**
   * Метод реализующий выборку неактивированных заказов согласно Id пользователя
   * @param sfGuardUser.Id $userId
   * @return Doctrine_Collection Object
   */
  public function findAllPreoderedJoinSCartJoinSItemVariantsJoinSItem($userId)
  {
    $q = $this->createQuery('o')
              ->leftJoin('o.sCarts c')
              ->leftJoin('c.sItemVariant iv')
              ->leftJoin('iv.sItem')
              ->where('c.user_id = ?', $userId)
              ->andWhere('c.order_id = 0');

              //->andWhere("o.status = 'preordered'");

    return $q->execute();

  }

  public function findOneByIdAndUserId($order_id, $user_id)
  {
    $q = $this->createQuery('o')
              ->leftJoin('o.sCarts c')
              ->where('o.id = ?', $order_id)
              ->andWhere('c.user_id = ?', $user_id);

    return $q;
  }
}