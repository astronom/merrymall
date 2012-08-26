<?php

/**
 * ymlCompany form.
 *
 * @package    merrymall
 * @subpackage form
 * @author     Wronglink, Astronom <a.manichev@gmail.com>
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ymlCompanyForm extends BaseymlCompanyForm
{
  public function configure()
  {
    unset($this['company_id'],$this['updated_at']);

    $request = sfContext::getInstance()->getRequest();
    $this->getObject()->setCompanyId($request->getParameter('company_id'));

    $this->setWidget('filename', new sfWidgetFormInputFile(array(
                    			 'label' => 'Файл каталога',
                    			 )
                    			 ));
    $this->getWidgetSchema()->setHelp('filename', 'Загружайте прайсы в форматах: Яндекс.Маркет (yml | xml) или Excel (xls | xlsx)');

    $this->setValidator('filename', new sfValidatorFile(array(
    'required' => true,
    'max_size' => 8192000,
    'path' => $this->getObject()->getFilepath(),
    'mime_types' => array('application/xml', 'text/xml','text/plain','application/octet-stream','application/vnd.ms-office','application/vnd.ms-excel','application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 'application/zip'),
    'validated_file_class' => 'PriceValidatedFile'
    )));

  }

  public function doSave($con = null)
  {
    $filename = $this->getObject()->getFilepath().date("Y-m-d", time()).'.xml';

    $object = parent::doSave($con);

//    $parser = new ymlParser($filename,$this->getObject()->getCompanyId());
//    $parser->insertCategories();
  }
}
