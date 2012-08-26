<?php
/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class Addmmtexts extends Doctrine_Migration_Base
{
    public function up()
    {
        $this->createTable('mm_texts', array(
             'id' => 
             array(
              'type' => 'integer',
              'primary' => true,
              'autoincrement' => true,
              'length' => 11,
             ),
             'text' => 
             array(
              'type' => 'clob',
              'length' => NULL,
             ),
             'url' => 
             array(
              'type' => 'enum',
              'values' => 
              array(
              0 => 'about',
              1 => 'add',
              2 => 'rent',
              ),
              'length' => NULL,
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
        $this->dropTable('mm_texts');
    }
}