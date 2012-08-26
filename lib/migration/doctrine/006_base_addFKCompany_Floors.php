<?php
class addFKCompany_Floors extends Doctrine_Migration_Base
{
  public function up()
  {
    $this->createForeignKey('mm_companies', 'mm_companies_floor_id_mm_floors_id', array(
             'name' => 'mm_companies_floor_id_mm_floors_id',
             'local' => 'floor_id',
             'foreign' => 'id',
             'foreignTable' => 'mm_floors',
             'onUpdate' => NULL,
             'onDelete' => 'CASCADE',
    ));
  }

  public function down()
  {
    $this->dropForeignKey('mm_companies', 'mm_companies_floor_id_mm_floors_id');
  }
}