<?php

class ActionsTable extends Doctrine_Table
{
  /**
   * Метод вернет все активные акции с ссылками на компании
   *
   * @return Doctrine_Query
   */
  public function getAllJoinCompaniesQuery()
  {
    return $this->createQuery('a')
                ->select('a.title, a.logo, a.title_slug, c.url')
                ->leftJoin('a.Company c')
                ->where('a.is_active = ?', true);

  }


}