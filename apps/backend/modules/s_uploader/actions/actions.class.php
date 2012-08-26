<?php

require_once dirname(__FILE__).'/../lib/s_uploaderGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/s_uploaderGeneratorHelper.class.php';

/**
 * s_uploader actions.
 *
 * @package    merrymall
 * @subpackage s_uploader
 * @author     Wronglink, Astronom <a.manichev@gmail.com>
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class s_uploaderActions extends autoS_uploaderActions
{
  public function preExecute()
  {
    parent::preExecute();
    $routing = $this->getContext()->getRouting();
    $routing->setDefaultParameter('company_id', $this->request->getParameter('company_id'));
  }

  protected function  buildQuery()
  {
    $query = parent::buildQuery();
    $query->andWhere('company_id = ?', $this->request->getParameter('company_id'));

    return $query;
  }

  public function executeListUploadXML(sfWebRequest $request)
  {
    $xmlPrice = $this->getRoute()->getObject();
    $parser = new ymlParser($xmlPrice->getAbsoluteFilePath(),$xmlPrice->getCompanyId());
    $parser->insertCategories();
    unset($parser);

    $this->redirect('@yml_company');
  }

  /**
   * Читает файл прайса
   * @param sfWebRequest $request
   */
  public function executeListRead(sfWebRequest $request)
  {
    $object = $this->getRoute()->getObject();
    $this->priceName = $object->getFilename();
    $priceFilename = $object->getFilePath().$object->getFilename();

    $objReader = PHPExcel_IOFactory::createReaderForFile($priceFilename);
//    $objPHPExcel = $objReader->listWorksheetNames$priceFilename);

    $this->priceId = $object->getId();
    $this->worksheets = $objReader->listWorksheetNames($priceFilename);
  }

  public function executeReadPage(sfWebRequest $request)
  {
    $object = $this->getRoute()->getObject();

    $this->priceName = $object->getFilename();

    $priceFilename = $object->getFilePath().$object->getFilename();
    $objReader = PHPExcel_IOFactory::createReaderForFile($priceFilename);
    $objPHPExcel = $objReader->load($priceFilename);

    $objPHPExcel->setActiveSheetIndex($request['page_id']);

    $this->worksheet = $objPHPExcel->getActiveSheet();
    $this->countColumns = ord($this->worksheet->getHighestColumn())-64;

  }

  public function executeParsePage(sfWebRequest $request)
  {

    $tableData = $request->getPostParameter('tableData');
    $parser = new xlsParser($tableData, $this->request->getParameter('company_id'));

//    foreach ($iterator as $key => $value) {
//      $firephp->fb("$key : $value");
//    }

    return sfView::NONE;

  }
  /**
   * Удаляет запись о прайсе в базе совместо с удалением файлы
   * @param sfWebRequest $request
   */
  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $object =  $this->getRoute()->getObject();
    $this->dispatcher->notify(new sfEvent($this, 'admin.delete_object', array('object' => $object)));

    $priceFilename = $object->getFilePath().$object->getFilename();
    if ($object->delete())
    {
      $this->getUser()->setFlash('notice', 'The item was deleted successfully.');
      unlink($priceFilename);
    }
    $this->redirect('@yml_company');
  }

  /**
   * Удаляет запись о прайсах в базе совместо с удалением файлов
   * @param sfWebRequest $request
   */
  protected function executeBatchDelete(sfWebRequest $request)
  {
    $ids = $request->getParameter('ids');

    $records = Doctrine_Query::create()
      ->from('ymlCompany')
      ->whereIn('id', $ids)
      ->execute();

    foreach ($records as $record)
    {
      $priceFilename = $record->getFilePath().$record->getFilename();
      $record->delete();
      unlink($priceFilename);
    }

    $this->getUser()->setFlash('notice', 'The selected items have been deleted successfully.');
    $this->redirect('@yml_company');
  }
}
