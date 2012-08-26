<?php
class addFKCategoris_Company extends Doctrine_Migration_Base
{
  public function up()
  {
    $this->createForeignKey('mm_s_categories', 'mm_s_categories_parent_id_mm_s_categories_id', array(
             'name' => 'mm_s_categories_parent_id_mm_s_categories_id',
             'local' => 'parent_id',
             'foreign' => 'id',
             'foreignTable' => 'mm_s_categories',
             'onUpdate' => NULL,
             'onDelete' => 'CASCADE',
    ));
    $this->createForeignKey('mm_s_categories', 'mm_s_categories_company_id_mm_companies_id', array(
             'name' => 'mm_s_categories_company_id_mm_companies_id',
             'local' => 'company_id',
             'foreign' => 'id',
             'foreignTable' => 'mm_companies',
             'onUpdate' => NULL,
             'onDelete' => 'CASCADE',
    ));
  }

  public function down()
  {
    $this->dropForeignKey('mm_s_categories', 'mm_s_categories_parent_id_mm_s_categories_id');
    $this->dropForeignKey('mm_s_categories', 'mm_s_categories_company_id_mm_companies_id');
  }
}