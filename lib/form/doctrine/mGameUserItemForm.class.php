<?php

/**
 * mGameUserItem form.
 *
 * @package    merrymall
 * @subpackage form
 * @author     Wronglink, Astronom <a.manichev@gmail.com>
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class mGameUserItemForm extends BasemGameUserItemForm
{
  public function configure()
  {
    unset(
    $this['created_at'],
    $this['updated_at'],
    $this['is_verified'],
    $this['account_id']
    );

    $accountId = sfContext::getInstance()->getUser()->getAttribute('game_account_id',null,'sfGuardSecurityUser');
    $this->getObject()->setAccountId($accountId);

    //$this->setWidget('url', new)
    $this->getWidget('url')->setLabel('Ссылка на товар');
    $this->getWidget('picture')->setLabel('Изображение товара');
    $this->getWidget('price')->setLabel('Цена товара');

    $this->setWidget('description', new sfWidgetFormTextarea(array('label'=>'Краткое описание'), array('rows' => 5, 'cols' => 30)));

    $this->getValidator('url')->setOption('required', true);
    $this->getValidator('picture')->setOption('required', true);
    $this->getValidator('price')->setOption('required', true);

    $this->widgetSchema->setNameFormat('user_item[%s]');
  }
}
