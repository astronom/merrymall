<?php


class ymlCompanyTable extends Doctrine_Table
{

    public static function getInstance()
    {
        return Doctrine_Core::getTable('ymlCompany');
    }

    public function findPriceById($requestParams)
    {
        $q = $this->createQuery('p')
             ->where('p.id = ?', $requestParams['id']);
        return $q->execute();
    }
}