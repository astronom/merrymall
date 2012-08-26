<?php
class sOfficeTextTable extends Doctrine_Table
{

    public static function getInstance()
    {
        return Doctrine_Core::getTable('sOfficeText');
    }

    public function findAllByCompanyIdJoinCompany($company_id)
    {
      $q = $this->createQuery('of')
                ->select('of.title , of.title_slug, c.url')
                ->leftJoin('of.Company c')
                ->where('company_id = ?', $company_id);

      return $q->execute();
    }
}