<?php

/**
 * sImage form.
 *
 * @package    merrymall
 * @subpackage form
 * @author     Wronglink
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class BackendsImageForm extends BasesImageForm
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

    // Виджет и валидатор для логотипа
    $this->setWidget('image', new sfWidgetFormInputFileEditable(array(
      'label'     => 'Image',
      'file_src'  => $this->getObject()->getImageUrl(),
      'is_image'  => true,
      'edit_mode' => !$this->isNew(),
      'template'  => '<div>%file%<br />%input%<br />%delete% %delete_label%</div>',
    )));

    $this->setValidator('image', new sfValidatorFile(array(
    'required' => false,
    'path' => sfConfig::get('sf_upload_dir'),
    'mime_types' => 'web_images',
    'validated_file_class' => 'SwimsuitValidatedFile'
    )));

    $this->validatorSchema['image_delete'] = new sfValidatorPass();

    $itemQuery = Doctrine::getTable('sItem')->getCompanyItemsQuery($request->getParameter('company_id'));
    $this->widgetSchema['item_id']->setOption('query', $itemQuery);
  }

  public function doSave ($con = null)
  {
    // Эта часть нужна, чтобы в БД поставить галочки "есть лого" и "есть витрина"
    // Получаем загруженное лого и сохраняем его
    $image = $this->getValue('image');
//    $thumb_150 = $this->getValue('thumb_150');
//    $thumb_60 = $this->getValue('thumb_60');

    unset(
      $this['image']
    );
    // Сохраняем нашу компанию в БД. Важно это сделать до сохранения
    // картинок, т.к. нам нужен айдишник компании.
    $object = parent::doSave($con);

    // А теперь можно уже сохранить лого и витрину (при условии, что в форме не
    // стоит галочка "удалить лого"
    if (!$this->getValue('image_delete') && $image)
    {
      $image->save($this->getObject()->getImagePath());
      $thumbnail = new sfThumbnail(600, 600, true, false, 85);
      $thumbnail->loadFile($this->getObject()->getImagePath());
      $thumbnail->save($this->getObject()->getImagePath(), 'image/jpeg');

      $thumbnail = new sfThumbnail(150, 140, true, true, 60);
      $thumbnail->loadFile($this->getObject()->getImagePath());
      $thumbnail->save($this->getObject()->getThumbnailPath(150,140), 'image/jpeg');

      $thumbnail = new sfThumbnail(60, 60, true, true, 85);
      $thumbnail->loadFile($this->getObject()->getImagePath());
      $thumbnail->save($this->getObject()->getThumbnailPath(60,60), 'image/jpeg');
    }

    return $object;
  }
}
