<?php
/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class Addmmspropertycategorymap extends Doctrine_Migration_Base
{
    public function up()
    {
        $this->createTable('mm_s_property_category_map', array(
             'id' => 
             array(
              'type' => 'integer',
              'primary' => true,
              'autoincrement' => true,
              'length' => 11,
             ),
             'property_id' => 
             array(
              'type' => 'integer',
              'notnull' => true,
              'length' => 11,
             ),
             'category_id' => 
             array(
              'type' => 'integer',
              'notnull' => true,
              'length' => 11,
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
             ), array(
             'indexes' => 
             array(
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
        $this->dropTable('mm_s_property_category_map');
    }
}