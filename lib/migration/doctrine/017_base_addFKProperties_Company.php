<?php
class addFKProperties_Company extends Doctrine_Migration_Base
{
  public function up()
  {
    $this->createForeignKey('mm_s_properties', 'mm_s_properties_company_id_mm_companies_id', array(
             'name' => 'mm_s_properties_company_id_mm_companies_id',
             'local' => 'company_id',
             'foreign' => 'id',
             'foreignTable' => 'mm_companies',
             'onUpdate' => NULL,
             'onDelete' => 'CASCADE',
    ));
    $this->createForeignKey('mm_s_property_category_map', 'mm_s_property_category_map_property_id_mm_s_properties_id', array(
             'name' => 'mm_s_property_category_map_property_id_mm_s_properties_id',
             'local' => 'property_id',
             'foreign' => 'id',
             'foreignTable' => 'mm_s_properties',
             'onUpdate' => NULL,
             'onDelete' => 'CASCADE',
    ));
    $this->createForeignKey('mm_s_property_category_map', 'mm_s_property_category_map_category_id_mm_s_categories_id', array(
             'name' => 'mm_s_property_category_map_category_id_mm_s_categories_id',
             'local' => 'category_id',
             'foreign' => 'id',
             'foreignTable' => 'mm_s_categories',
             'onUpdate' => NULL,
             'onDelete' => 'CASCADE',
    ));
    $this->createForeignKey('mm_s_properties_values', 'mm_s_properties_values_property_id_mm_s_properties_id', array(
             'name' => 'mm_s_properties_values_property_id_mm_s_properties_id',
             'local' => 'property_id',
             'foreign' => 'id',
             'foreignTable' => 'mm_s_properties',
             'onUpdate' => NULL,
             'onDelete' => 'CASCADE',
    ));
    $this->createForeignKey('mm_s_properties_values', 'mm_s_properties_values_company_id_mm_companies_id', array(
             'name' => 'mm_s_properties_values_company_id_mm_companies_id',
             'local' => 'company_id',
             'foreign' => 'id',
             'foreignTable' => 'mm_companies',
             'onUpdate' => NULL,
             'onDelete' => 'CASCADE',
    ));
  }

  public function down()
  {
    $this->dropForeignKey('mm_s_properties', 'mm_s_properties_company_id_mm_companies_id');
    $this->dropForeignKey('mm_s_property_category_map', 'mm_s_property_category_map_property_id_mm_s_properties_id');
    $this->dropForeignKey('mm_s_property_category_map', 'mm_s_property_category_map_category_id_mm_s_categories_id');
    $this->dropForeignKey('mm_s_properties_values', 'mm_s_properties_values_property_id_mm_s_properties_id');

    $this->dropForeignKey('mm_s_properties_values', 'mm_s_properties_values_company_id_mm_companies_id');

  }
}