<?php

class sItemTable extends Doctrine_Table
{
  public function retrieveBackendsItemsList(Doctrine_Query $q)
  {
    $rootAlias = $q->getRootAlias();
    $q->leftJoin($rootAlias . '.sCategory c');
    $q->leftJoin($rootAlias . '.sBrand b');
    return $q;
  }

  public function getCompanyItemsQuery($company_id)
  {
    $query = $this->createQuery('i')->where('i.company_id = ?', $company_id);
    return $query;
  }

  public function getItemsByCategoriesJoinImagesQuery($ids)
  {
    $query = $this->createQuery('i')
    ->whereIn('i.category_id', $ids)
    ->leftJoin('i.sImages img ON img.is_main = true');
    return $query;
  }

  public function findItemsByCategoriesJoinImages($company_id, $ids)
  {
    $items = $this->createQuery('i')
    ->leftJoin('i.sImages img')
    ->leftJoin('i.sItemVariants var')
    ->leftJoin('var.sWishlist wish')
    ->Where('var.is_main = true')
    ->andWhere('i.company_id = ?', $company_id)
    ->whereIn('i.category_id', $ids)
    ->execute();
    return $items;
  }

  public function findEnabledItemJoinImagesJoinItemVariantsJoinSWishlist($item_id, $user_id)
  {
    $item = $this->createQuery('i')
    ->leftJoin('i.sImages img')
    ->leftJoin('i.sItemVariants var')
    ->leftJoin('var.sWishlist wish WITH wish.user_id = ?',$user_id)
    ->Where('var.is_main = true')
    ->andWhere('var.id = ?', $item_id)
    ->execute();
    return $item;
  }
  public function findByItemIdJoinPropertiesJoinPropertyValues($item_id)
  {
    $q = $this->createQuery('i')
    ->leftJoin('i.sItemVariants iv')
    ->leftJoin('i.sProperties pv')
    ->leftJoin('pv.sProperty p')
    ->where('i.id = ?', $item_id);

    return $q->execute();

  }

  public function getEnabledItemsByCategoriesJoinImagesJoinItemVariantsJoinSWishlistQuery($category_ids, $company_id, $user_id)
  {
    $q = $this->createQuery('i')
              ->select('i.id, i.name, i.is_enabled, img.url, img.item_id, img.company_id, c.url, c.type, var.name, var.price, wish.id, wish.item_variant_id')
              ->leftJoin('i.sImages img')
              ->leftJoin('i.Company c')
              ->leftJoin('i.sItemVariants var')
              ->leftJoin('var.sWishlist wish WITH wish.user_id = ?',$user_id)
              ->Where('var.is_main = true')
              ->andWhere('i.company_id = ?', $company_id);

    if(!empty($category_ids))
    {
      $q->whereIn('i.category_id', $category_ids);
    }
    return $q;
  }
  public function getByIdJoinCompany($requestParams)
  {
    $item = $this->createQuery('i')
    ->leftJoin('i.sImages img')
    ->leftJoin('i.sItemVariants var')
    //->leftJoin('var.sWishlist wish WITH wish.user_id = ?',$user_id)
    ->Where('var.is_main = true')
    ->andWhere('i.id = ?', $requestParams['id']);

    return $item->execute();
  }

//  /**
//   * Ищет по item_variant_id и возвращает совместно с Company
//   *
//   * @param int $item_variant_id
//   * @return Doctrine_Query
//   */
//  public function findOneByItemVariantIdWithCompany($item_variant_id)
//  {
//    $q = $this->createQuery('i')
//    ->select('i.id, c.type, c.url')
//    ->leftJoin('i.Company c')
//    ->where('i.item_variant_id = ?', $item_variant_id)
//    ->limit('1');
//
//    return $q;
//  }
}
