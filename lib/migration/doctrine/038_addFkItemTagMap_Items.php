<?php
class addFKItemTagMap_Items extends Doctrine_Migration_Base
{
  public function up() {
    $this->createForeignKey('mm_s_item_tag_map', 'mm_s_item_tag_map_tag_id_mm_s_items_id', array(
             'name' => 'mm_s_item_tag_map_tag_id_mm_s_items_id',
             'local' => 'tag_id',
             'foreign' => 'id',
             'foreignTable' => 'mm_s_items',
    ));
    $this->addIndex('mm_s_item_tag_map', 'mm_s_item_tag_map_tag_id', array(
             'fields' => 
    array(
    0 => 'tag_id',
    ),
    ));
  }
  public function down()
  {
    $this->dropForeignKey('mm_s_item_tag_map', 'mm_s_item_tag_map_tag_id_mm_s_items_id');
    $this->removeIndex('mm_s_item_tag_map', 'mm_s_item_tag_map_tag_id', array(
             'fields' => 
    array(
    0 => 'tag_id',
    ),
    ));
  }
}