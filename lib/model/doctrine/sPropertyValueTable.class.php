<?php

class sPropertyValueTable extends Doctrine_Table
{
  public function getCompanyPropertiesValuesQuery($company_id)
  {
    $query = $this->createQuery('pv')->where('pv.company_id = ?', $company_id);
    return $query;
  }
  /**
   * Возвращает значения свойств товара и сами свойства
   *
   * @param integer Required $item_id Id Товара для выборки свойств
   */
  public function findByItemJoinProperties($item_id)
  {
  	$q = $this->createQuery('pv')
  	          ->leftJoin('pv.sProperty')
  	          ->where('pv.item_id = ?', $item_id);

  	 return $q->execute();
  }
}
