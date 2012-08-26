<?php

/**
 * sImage form.
 *
 * @package    merrymall
 * @subpackage form
 * @author     Astronom <a.manichev@gmail.com>
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class BackendsUploadDataForm extends BasesFileForm
{
  public function configure()
  {
    parent::configure();

    unset(
    $this['created_at'],
    $this['updated_at'],
    $this['company_id']
    );
    $request = sfContext::getInstance()->getRequest();

    $this->getObject()->setCompanyId($request->getParameter('company_id'));

    // Виджет и валидатор для файла
    $this->setWidget('filename', new sfWidgetFormInputFile(array(
      'label'     => 'Каталог товаров',            
    )));
    $this->widgetSchema->setLabel('comment','Комментарий к каталогу');
    $this->widgetSchema['comment']->setAttribute('cols','50');
    
    $this->setValidator('filename', new sfValidatorFile(array(
    'required' => true,
    'path' => sfConfig::get('sf_data_dir').'/tenantryFiles',
    'validated_file_class' => 'SwimsuitValidatedFile'
    )));
  }

}
