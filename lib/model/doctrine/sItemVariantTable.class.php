<?php

class sItemVariantTable extends Doctrine_Table
{
  public function getCompanyItemVariantsQuery($company_id)
  {
    $query = $this->createQuery('i')->where('i.company_id = ?', $company_id);
    return $query;
  }

  public function getCompanyItemVariants($company_id = 6, $item_id = 1)
  {
    $q = $this->createQuery('i')
    ->where('i.company_id = ?', $company_id)
    ->andWhere('i.item_id = ?', $item_id)
    ->orderBy('i.position ASC');
    return $q->execute();
  }

  /**
   * Поиск активного товара по его Id
   * Используется в добавлении товара
   *
   * @param int $item_variant_id
   * @return Array
   */
  public function findOneEnabledItemVariantWithCompanyTypeAndCompanyUrl($item_variant_id)
  {
    $q = $this->createQuery('iv')
    ->select('iv.id, iv.price, iv.company_id, iv.name, iv.item_id, c.type, c.url')
    ->leftJoin('iv.sItem i')
    ->leftJoin('iv.Company c')
    ->where('iv.id = ?', $item_variant_id)
    ->andWhere('i.is_enabled = ?', true);

    return $q->fetchOne(array(),Doctrine_Core::HYDRATE_SCALAR);

  }
}
