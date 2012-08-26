<?php
class addFKItems extends Doctrine_Migration_Base
{
  public function up()
  {
    $this->createForeignKey('mm_s_items', 'mm_s_items_category_id_mm_s_categories_id', array(
             'name' => 'mm_s_items_category_id_mm_s_categories_id',
             'local' => 'category_id',
             'foreign' => 'id',
             'foreignTable' => 'mm_s_categories',
             'onUpdate' => NULL,
             'onDelete' => 'CASCADE',
    ));
    $this->createForeignKey('mm_s_items', 'mm_s_items_brand_id_mm_s_brands_id', array(
             'name' => 'mm_s_items_brand_id_mm_s_brands_id',
             'local' => 'brand_id',
             'foreign' => 'id',
             'foreignTable' => 'mm_s_brands',
             'onUpdate' => NULL,
             'onDelete' => 'SET NULL',
    ));
    $this->createForeignKey('mm_s_items', 'mm_s_items_company_id_mm_companies_id', array(
             'name' => 'mm_s_items_company_id_mm_companies_id',
             'local' => 'company_id',
             'foreign' => 'id',
             'foreignTable' => 'mm_companies',
             'onUpdate' => NULL,
             'onDelete' => 'CASCADE',
    ));
    $this->createForeignKey('mm_s_item_variants', 'mm_s_item_variants_item_id_mm_s_items_id', array(
             'name' => 'mm_s_item_variants_item_id_mm_s_items_id',
             'local' => 'item_id',
             'foreign' => 'id',
             'foreignTable' => 'mm_s_items',
             'onUpdate' => NULL,
             'onDelete' => 'CASCADE',
    ));
    $this->createForeignKey('mm_s_item_variants', 'mm_s_item_variants_company_id_mm_companies_id', array(
             'name' => 'mm_s_item_variants_company_id_mm_companies_id',
             'local' => 'company_id',
             'foreign' => 'id',
             'foreignTable' => 'mm_companies',
             'onUpdate' => NULL,
             'onDelete' => 'CASCADE',
    ));
    $this->createForeignKey('mm_s_properties_values', 'mm_s_properties_values_item_id_mm_s_items_id', array(
             'name' => 'mm_s_properties_values_item_id_mm_s_items_id',
             'local' => 'item_id',
             'foreign' => 'id',
             'foreignTable' => 'mm_s_items',
             'onUpdate' => NULL,
             'onDelete' => 'CASCADE',
    ));
  }

  public function down()
  {
    $this->dropForeignKey('mm_s_items', 'mm_s_items_category_id_mm_s_categories_id');
    $this->dropForeignKey('mm_s_items', 'mm_s_items_brand_id_mm_s_brands_id');
    $this->dropForeignKey('mm_s_items', 'mm_s_items_company_id_mm_companies_id');
    $this->dropForeignKey('mm_s_item_variants', 'mm_s_item_variants_item_id_mm_s_items_id');
    $this->dropForeignKey('mm_s_item_variants', 'mm_s_item_variants_company_id_mm_companies_id');
    $this->dropForeignKey('mm_s_properties_values', 'mm_s_properties_values_item_id_mm_s_items_id');

  }
}