<?php
class addFKImages extends Doctrine_Migration_Base
{
  public function up()
  {
    $this->createForeignKey('mm_s_images', 'mm_s_images_item_id_mm_s_items_id', array(
             'name' => 'mm_s_images_item_id_mm_s_items_id',
             'local' => 'item_id',
             'foreign' => 'id',
             'foreignTable' => 'mm_s_items',
             'onUpdate' => NULL,
             'onDelete' => 'CASCADE',
    ));
    $this->createForeignKey('mm_s_images', 'mm_s_images_company_id_mm_companies_id', array(
             'name' => 'mm_s_images_company_id_mm_companies_id',
             'local' => 'company_id',
             'foreign' => 'id',
             'foreignTable' => 'mm_companies',
             'onUpdate' => NULL,
             'onDelete' => 'CASCADE',
    ));
  }

  public function down()
  {
    $this->dropForeignKey('mm_s_images', 'mm_s_images_item_id_mm_s_items_id');
    $this->dropForeignKey('mm_s_images', 'mm_s_images_company_id_mm_companies_id');

  }
}