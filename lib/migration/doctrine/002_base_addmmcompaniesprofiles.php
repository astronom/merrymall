<?php
/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class Addmmcompaniesprofiles extends Doctrine_Migration_Base
{
    public function up()
    {
        $this->createTable('mm_companies_profiles', array(
             'id' => 
             array(
              'type' => 'integer',
              'primary' => true,
              'autoincrement' => true,
              'length' => 7,
             ),
             'company_id' => 
             array(
              'type' => 'integer',
              'notnull' => true,
              'length' => 7,
             ),
             'description' => 
             array(
              'type' => 'clob',
              'length' => NULL,
             ),
             'news' => 
             array(
              'type' => 'clob',
              'length' => NULL,
             ),
             'actions' => 
             array(
              'type' => 'clob',
              'length' => NULL,
             ),
             'contacts' => 
             array(
              'type' => 'clob',
              'length' => NULL,
             ),
             'phone' => 
             array(
              'type' => 'string',
              'length' => 255,
             ),
             'self_delivery_address' => 
             array(
              'type' => 'string',
              'length' => 255,
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
        $this->dropTable('mm_companies_profiles');
    }
}