<?php

/**
 * sOrder form.
 *
 * @package    merrymall
 * @subpackage form
 * @author     Wronglink
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class sOrderForm extends BasesOrderForm
{
  public function configure()
  {
    $this->useFields(array('address','comment'));
    $this->widgetSchema->setLabels(array(
  	'address'     => 'Адрес доставки:',
  	'comment'     => 'Комментарий к заказу:'
    ));
    $this->widgetSchema->setHelp('comment','<span class="form_comment">например: "не работает домофон, просьба позвонить"</span>');
    
    $this->getWidget('address')
         ->setAttributes(array(
                         'required' => 'required'     
    ));
    //Настравиваем валидаторы
    $this->validatorSchema['address'] = new sfValidatorString(
            array('min_length' => 9),
            array('required'   => 'Введите адрес доставки',
				  'min_length' => 'Просим Вас не использовать сокращения'
			));

    $userProfileForm = new sfGuardUserProfileOrderForm(sfContext::getInstance()->getUser()->getProfile());
    $this->embedMergeForm('userProfile',$userProfileForm);

    //Формируем вывод полей: Имя, Фамилия, Эмайл, Телефон первые
    $this->widgetSchema->moveField('userProfile|firstname', sfWidgetFormSchema::FIRST);
    $this->widgetSchema->moveField('userProfile|phone', sfWidgetFormSchema::AFTER,'userProfile|firstname');

  }


  protected function doSave($con = null) {
    //Получаем объект формы
    $object = $this->getObject();
    //Ставим значение поля user_id для заказа
    //$object->setUserId(sfContext::getInstance()->getUser()->getId());
    /*
     * Требуется разобрать корзину по магазинам внеся изменения в 2 таблицы
     * 1. В Корзине указать номер заказа
     * 2. В Заказах добавить айдишник магазина
     */
    $object = parent::doSave($con);

    $this->setCartIds($object);
    return $object;
  }

  //Метод запросит у модели sCart набор объектов и пропишет в них order_id
  public function setCartIds($object = null) {
    if($object == null) {
       $object = $this->getObject();
    }
    $carts = Doctrine::getTable('sCart')->findCartItemsToOrder();
    foreach($carts as $cart) {
      $cart->setOrderId($object->getId());
      $cart->save();
    }

  }
}
