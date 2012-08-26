<?php

/**
 * mGameAccount
 *
 * This class has been auto-generated by the Doctrine ORM Framework
 *
 * @package    merrymall
 * @subpackage model
 * @author     Wronglink, Astronom <a.manichev@gmail.com>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class mGameAccount extends BasemGameAccount
{
  /**
   * Переводит игрока на новый уровень
   */
  public function nextRound(mGameRoundRules $roundRules)
  {
    $roundRules = mGameRoundRulesTable::getInstance()->findOneByRound($this->round + 1);
    $this->setRound($this->round + 1);
    $this->giveMoney($roundRules->getMoney());

  }

  /**
   * Переводит на счет игрока деньги
   */
  public function giveMoney($money)
  {
    $this->setMoney($this->money + $money);

  }

  /**
   * Списывание $price со счета игрока
   * @param Decimal $price
   */
  public function writeOffTheMoney($price)
  {
    $this->setMoney($this->money - $price);
    $this->setMoneySpent($this->money_spent + $price);
  }

  /**
   * Переводит на счет игрока кридит, который суммируется
   */
  public function giveCredit($price)
  {
    $credit = $price - $this->getMoney();
    $this->setCredit($this->credit + $credit);
    $this->giveMoney($credit);
  }

  /**
   * Пересчет рейтинг игрока
   */
  public function countRating()
  {

    $spentTimeInHours = floor((time() - strtotime($this->created_at))/3600);
    if($spentTimeInHours == 0) $spentTimeInHours = 1;

    $rating = round(($this->getMoneySpent()/$spentTimeInHours),0);

    //return $rating;


    $this->setRating($rating);


  }

  /**
   * Процесс прогонки покупки через алгоритм игры
   * @param Decimal $price
   */
  public function proceedToCheckout($price)
  {
    if($this->getMoney() < $price)
    {
      $this->giveCredit($price);
    }
    $this->writeOffTheMoney($price);

    $this->countRating();

    $roundRules = mGameRoundRulesTable::getInstance()->findOneByRound($this->round);
    $countCartItems = mGameCartTable::getInstance()->findByAccountId($this->id)->count();

    if(!$roundRules->checkRoundRules($countCartItems))
    {
      $this->nextRound($roundRules);
    }

    $this->save();
  }



}