<?php

class sfGuardUserProfileTable extends PluginsfGuardUserProfileTable
{
  public function getWithUser($user_id)
  {
    $q = $this->createQuery('p')->          
          leftJoin('p.User u')->
          where('u.id = ?', $user_id);
          
    return $q->fetchOne();
  }
}
