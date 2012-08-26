<?php


class sChatTable extends Doctrine_Table
{
   /**
    * Ищет уже созданный чат
    * @param int $user_id
    * @param int $operator_id
    * @return int Exist $chat_id
    */
   public function findChatByUserIdAndOperatorId($user_id,$operator_id)
   {
     $q = Doctrine_Query::create()
         ->from('sChat ch')
         ->select('ch.id')
         ->where('ch.user_id = ?', $user_id)
         ->andWhere('ch.operator_id = ?', $operator_id);
         
     return $q->fetchOne(array(), Doctrine_Core::HYDRATE_SINGLE_SCALAR);    
   }
}