<?php
class addFKCompany_CompanyProfiles extends Doctrine_Migration_Base
{
  public function up()
  {
    $this->createForeignKey('mm_companies_profiles', 'mm_companies_profiles_company_id_mm_companies_id', array(
             'name' => 'mm_companies_profiles_company_id_mm_companies_id',
             'local' => 'company_id',
             'foreign' => 'id',
             'foreignTable' => 'mm_companies',
             'onUpdate' => NULL,
             'onDelete' => 'CASCADE',
    ));
  }

  public function down()
  {
    $this->dropForeignKey('mm_companies_profiles', 'mm_companies_profiles_company_id_mm_companies_id');
  }
}