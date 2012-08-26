<?php

class sTagTable extends Doctrine_Table
{
  public function findAllRootJoinChildren()
  {
    $tags =  $this->createQuery('t')
                  ->where('t.parent_id IS NULL')
                  ->leftJoin('t.Children c')
                  ->execute();
    return $tags;
  }

  public function findOneByIdJoinChildren($tag_id)
  {
    $tag = $this->createQuery('t')
                ->where('t.id = ?', $tag_id)
                ->leftJoin('t.Children c')
//                ->leftJoin('t.sItems s')
                ->fetchOne();
    return $tag;
  }
}
