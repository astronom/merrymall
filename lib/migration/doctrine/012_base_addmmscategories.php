<?php
/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class Addmmscategories extends Doctrine_Migration_Base
{
    public function up()
    {
        $this->createTable('mm_s_categories', array(
             'id' => 
             array(
              'type' => 'integer',
              'primary' => true,
              'autoincrement' => true,
              'length' => 11,
             ),
             'name' => 
             array(
              'type' => 'string',
              'notnull' => true,
              'length' => 255,
             ),
             'parent_id' => 
             array(
              'type' => 'integer',
              'length' => 11,
             ),
             'company_id' => 
             array(
              'type' => 'integer',
              'notnull' => true,
              'length' => 7,
             ),
             'created_at' => 
             array(
              'notnull' => true,
              'type' => 'timestamp',
              'length' => 25,
             ),
             'updated_at' => 
             array(
              'notnull' => true,
              'type' => 'timestamp',
              'length' => 25,
             ),
             'position' => 
             array(
              'type' => 'integer',
              'length' => 8,
             ),
             ), array(
             'indexes' => 
             array(
              'company_id_idx' => 
              array(
              'fields' => 
              array(
               0 => 'company_id',
              ),
              ),
              'sortable' => 
              array(
              'fields' => 
              array(
               0 => 'position',
               1 => 'parent_id',
              ),
              'type' => 'unique',
              ),
             ),
             'primary' => 
             array(
              0 => 'id',
             ),
             'collate' => 'utf8_general_ci',
             'charset' => 'utf8',
             ));
    }

    public function down()
    {
        $this->dropTable('mm_s_categories');
    }
}