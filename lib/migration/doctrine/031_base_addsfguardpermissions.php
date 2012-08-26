<?php
/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class Addsfguardpermissions extends Doctrine_Migration_Base
{
    public function up()
    {
        $this->createTable('sf_guard_permissions', array(
             'id' => 
             array(
              'type' => 'integer',
              'primary' => true,
              'autoincrement' => true,
              'length' => 4,
             ),
             'name' => 
             array(
              'type' => 'string',
              'unique' => true,
              'length' => 255,
             ),
             'description' => 
             array(
              'type' => 'string',
              'length' => 1000,
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
        $this->dropTable('sf_guard_permissions');
    }
}