<?php

class NewsTable extends Doctrine_Table
{
  public function findLast($limit = 10)
  {
    $news = $this->createQuery('n')->orderBy('n.date DESC')->limit($limit)->execute();
    return $news;
  }

  public function getAllJoinCompaniesQuery()
  {
    return $this->createQuery('n')
                ->select('n.title, n.date, a.title_slug, c.url')
                ->leftJoin('n.Company c')
                ->orderBy('n.date DESC');
  }
}
