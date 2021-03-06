<?php
/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class Addmmscart extends Doctrine_Migration_Base
{
    public function up()
    {
        $this->createTable('mm_s_cart', array(
             'id' => 
             array(
              'type' => 'integer',
              'primary' => true,
              'autoincrement' => true,
              'length' => 11,
             ),
             'count' => 
             array(
              'type' => 'integer',
              'notnull' => true,
              'default' => 1,
              'length' => 12,
             ),
             'price' => 
             array(
              'type' => 'integer',
              'notnull' => true,
              'length' => 10,
             ),
             'user_id' => 
             array(
              'type' => 'integer',
              'notnull' => true,
              'length' => 11,
             ),
             'company_id' => 
             array(
              'type' => 'integer',
              'notnull' => true,
              'length' => 11,
             ),
             'item_variant_id' => 
             array(
              'type' => 'integer',
              'default' => 0,
              'length' => 11,
             ),
             'order_id' => 
             array(
              'type' => 'integer',
              'default' => 0,
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
              'company_id_idx' => 
              array(
              'fields' => 
              array(
               0 => 'company_id',
              ),
              ),
              'order_id_idx' => 
              array(
              'fields' => 
              array(
               0 => 'order_id',
              ),
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
        $this->dropTable('mm_s_cart');
    }
}