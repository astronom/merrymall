<?php

/**
 * Game Account table
 *
 * @package mGamePlugin
 * @subpackage model
 * @author Manichev Alexander aka Astronom <a.manichev@gmail.com>
 * @version
 *
 */
abstract class PlugimmGameAccountTable extends Doctrine_Table
{

  /**
   * Возвращает первую 10ку игроков по рейтингу
   */
  public function findFirst10ByRating()
  {

  }

  /**
   * Возвращает массив ближайших игроков
   */
  public function findNearUser()
  {

  }


}