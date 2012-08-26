<?php

class FloorTable extends Doctrine_Table
{
  public function findAll($hydrationMode = null)
  {
    $floors = $this->createQuery('f')
                   ->orderBy('f.position DESC')
                   ->execute(array(), $hydrationMode);
    return $floors;
  }

  public function findAllHumanFloors()
  {
    $floors = $this->getHumanFloorsQuery()->execute();
    return $floors;
  }

  public function getHumanFloorsQuery()
  {
    $query = $this->createQuery('f')->where('f.type = ?', 'floor')->orderBy('f.position DESC');
    return $query;
  }
}