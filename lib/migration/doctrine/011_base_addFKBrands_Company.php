<?php
class addFKBrands_Company extends Doctrine_Migration_Base
{
  public function up()
  {
    $this->createForeignKey('mm_s_brands', 'mm_s_brands_company_id_mm_companies_id', array(
             'name' => 'mm_s_brands_company_id_mm_companies_id',
             'local' => 'company_id',
             'foreign' => 'id',
             'foreignTable' => 'mm_companies',
             'onUpdate' => NULL,
             'onDelete' => 'CASCADE',
    ));
  }
  public function down()
  {
    $this->dropForeignKey('mm_s_brands', 'mm_s_brands_company_id_mm_companies_id');
  }
}