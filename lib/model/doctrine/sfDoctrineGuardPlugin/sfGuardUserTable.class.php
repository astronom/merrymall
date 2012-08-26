<?php

class sfGuardUserTable extends PluginsfGuardUserTable
{
//  Данный метод используется в востановлении пользователя вытаскивая его по email или username
//  $isActive - по умолчанию пользователь должен быть активирован в системе 
  public function retrieveByUsernameOrEmail($username_or_email, $isActive = true)
  {
    $q = Doctrine::getTable('sfGuardUser')->createQuery('u')
      ->leftJoin('u.Profile p')
      ->where('u.username = ?', $username_or_email)
      ->orWhere('p.email = ?', $username_or_email)
      ->addWhere('u.is_active = ?', $isActive)
    ;

    return $q->fetchOne();
  }
  
  /**
   * Получает Username оператора компании для чата
   * @return Ambigous <mixed, boolean, Doctrine_Record, Doctrine_Collection, PDOStatement, Doctrine_Adapter_Statement, Doctrine_Connection_Statement, unknown, number>
   */
  public function findOperatorsUsername($company_id)
  {
    $q = Doctrine_Query::create()
         ->from('sfGuardUser u')
         ->select('u.id')
         ->where('u.company_id = ?', $company_id)
         ->andWhere('u.is_active = ?', true);
         
     return $q->fetchOne(array(), Doctrine_Core::HYDRATE_SINGLE_SCALAR);
  }
}
