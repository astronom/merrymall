<?php

class sImageTable extends Doctrine_Table
{
  public function getCompanyItemImagesQuery($company_id, $item_id)
  {
    $query = $this->createQuery('i')
                  ->where('i.company_id = ?', $company_id)
                  ->addWhere('i.item_id = ?', $item_id);
    return $query;
  }

  /**
   * Возвращает все изображения по $company_id
   * @param int $company_id
   * @return Doctrine_Query
   */
  public function getAllCompanyImagesQuery($company_id)
  {
    $query = $this->createQuery('i')
                  ->where('i.company_id = ?', $company_id);
    return $query;
  }

  /**
   * Возвращает все удаленные изображения по $company_id
   * @param int $company_id
   * @return Doctrine_Query
   */
  public function getRemoteCompanyImagesQuery($company_id)
  {
    $query = $this->createQuery('i')
                  ->where('i.company_id = ?', $company_id)
                  ->addWhere('i.url != "NULL"');
    return $query;
  }


}
