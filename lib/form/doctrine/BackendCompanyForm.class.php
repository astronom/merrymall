<?php

/**
 * Company form.
 *
 * @package    merrymall
 * @subpackage form
 * @author     Wronglink
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class BackendCompanyForm extends BaseCompanyForm
{
  public function configure()
  {
    parent::configure();

    unset(
      $this['created_at'],
      $this['updated_at'],
      $this['has_logo'],
      $this['has_shopwindow'],
      $this['position']
    );

    // Выбираем только правильные этажи
    $floorQuery = Doctrine::getTable('Floor')->getHumanFloorsQuery();
    $this->widgetSchema['floor_id']->setOption('query', $floorQuery);

    // Виджет и валидатор для логотипа
    $this->setWidget('logo', new sfWidgetFormInputFileEditable(array(
      'label'     => 'Logo',
      'file_src'  => $this->getObject()->getLogo(),
      'is_image'  => true,
      'edit_mode' => !$this->isNew(),
      'template'  => '<div>%file%<br />%input%<br />%delete% %delete_label%</div>',
    )));

    $this->setValidator('logo', new sfValidatorFile(array(
    'required' => false,
    'path' => sfConfig::get('sf_upload_dir'),
    'mime_types' => 'web_images',
    'validated_file_class' => 'SwimsuitValidatedFile'
    )));

    $this->validatorSchema['logo_delete'] = new sfValidatorPass();

    // Виджет для витрины
    $this->setWidget('shopwindow', new sfWidgetFormInputFileEditable(array(
      'label'     => 'Shopwindow',
      'file_src'  => $this->getObject()->getShopwindow(),
      'is_image'  => true,
      'edit_mode' => !$this->isNew(),
      'template'  => '<div>%file%<br />%input%<br />%delete% %delete_label%</div>',
    )));

    $this->setValidator('shopwindow', new sfValidatorFile(array(
    'required' => false,
    'path' => sfConfig::get('sf_upload_dir'),
    'mime_types' => 'web_images',
    'validated_file_class' => 'SwimsuitValidatedFile'
    )));


    $this->validatorSchema['shopwindow_delete'] = new sfValidatorPass();

    $request = sfContext::getInstance()->getRequest();

    // Форма профиля
    $profileForm = new BackendCompanyProfileForm($this->object->Profile);
    unset(
      $profileForm['id'],
      $profileForm['company_id'],
      $profileForm['created_at'],
      $profileForm['updated_at']
    );
    $this->embedForm('Profile', $profileForm);
  }


  public function doSave ($con = null)
  {
    // Эта часть нужна, чтобы в БД поставить галочки "есть лого" и "есть витрина"
    // Получаем загруженное лого и сохраняем его
    $logo = $this->getValue('logo');

    // Если стоит галка "удалить" - ставим галку, что витрины нет
    if($this->getValue('logo_delete'))
      $this->values['has_logo'] = false;
    // а если не стоит, да еще и лого загружено - ставим галку, что лого есть
    elseif ($logo)
      $this->values['has_logo'] = true;

    // Аналогично, как с логотипом
    $shopwindow = $this->getValue('shopwindow');
    if($this->getValue('shopwindow_delete'))
      $this->values['has_shopwindow'] = false;
    elseif ($shopwindow)
      $this->values['has_shopwindow'] = true;

    unset(
      $this['logo'],
      $this['shopwindow']
    );
    // Сохраняем нашу компанию в БД. Важно это сделать до сохранения
    // картинок, т.к. нам нужен айдишник компании.
    $object = parent::doSave($con);

    // А теперь можно уже сохранить лого и витрину (при условии, что в форме не
    // стоит галочка "удалить лого"
    if (!$this->getValue('logo_delete') && $logo)
    {
      $logo->save($this->getObject()->getLogoPath());
    }

    if (!$this->getValue('shopwindow_delete') && $shopwindow)
    {
      $shopwindow->save($this->getObject()->getShopwindowPath());
    }

    return $object;
  }

  /**
   * Move to last when object is updated and its uniqueBy field have changed
   *
   * @param Doctrine_Event $event
   * @return void
   */
  public function preUpdate(Doctrine_Event $event)
  {
    $fieldName = $this->_options['name'];
    $object = $event->getInvoker();

//    $object->uniqueByChanged = false;

    foreach ($this->_options['uniqueBy'] as $field)
    {
      if (array_key_exists($field, $object->getModified()))
      {
        $object->set($fieldName, $object->getFinalPosition()+1, false);
//        $object->uniqueByChanged = true;
        break;
      }
    }
  }

  /**
   * When sortable is moved - promote all objects positioned lower than itself
   *
   * @param Doctrine_Event $event
   * @return void
   */
  public function postUpdate(Doctrine_Event $event)
  {
    $fieldName = $this->_options['name'];
    $object = $event->getInvoker();
    $old_object = array_merge($object->getData(), $object->getLastModified(true));
    $position = $old_object[$fieldName];

    $q = $object->getTable()->createQuery()
                            ->update(get_class($object))
                            ->set($fieldName, $fieldName.' - ?', '1')
                            ->where($fieldName.' > ' . $position)
                            ->orderBy($fieldName);

    foreach ($this->_options['uniqueBy'] as $field)
    {
      $q->addWhere($field . ' = ' . $old_object[$field]);
    }

    $q->execute();
  }

}
