<?php
/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class Addsfguarduserpermissionmap extends Doctrine_Migration_Base
{
    public function up()
    {
        $this->createTable('sf_guard_user_permission_map', array(
             'user_id' => 
             array(
              'type' => 'integer',
              'primary' => true,
              'length' => 11,
             ),
             'permission_id' => 
             array(
              'type' => 'integer',
              'primary' => true,
              'length' => 4,
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
              0 => 'user_id',
              1 => 'permission_id',
             ),
             'collate' => 'utf8_general_ci',
             'charset' => 'utf8',
             ));
    }

    public function down()
    {
        $this->dropTable('sf_guard_user_permission_map');
    }
}