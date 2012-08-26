<?php
class mGameCartComponents extends sfComponents
{
   public function executeCartItems(sfWebRequest $request)
   {
     $gameAccountId = $this->getUser()->getAttribute('game_account_id', null, 'sfGuardSecurityUser');
     $this->cartItems = mGameCartTable::getInstance()->find10RecentItemsWithItemVariant($gameAccountId);
   }

  /**
   * Мини - корзина
   */
  public function executeMiniCart()
  {
    $gameAccountId = $this->getUser()->getAttribute('game_account_id', null, 'sfGuardSecurityUser');
    if($gameAccountId)
    {
    $this->cartItems = mGameCartTable::getInstance()->findAllByAccountIdNotCheckouted($gameAccountId);
    }
    //$this->cartItemsCount = count();
//    $this->companies_count = count($this->companies->toArray());
    //$this->cart_items_count = Doctrine::getTable('sCart')->getAllByUserIdNotOrderedQuery($this->getUser()->getAttribute('user_id','','sfGuardSecurityUser'))->count();
//    if($this->cart_items_count==0) $this->cart_items_count = '';
    //Важно! чтобы все работало CSRFToken получаем из базового класса формы
//    $form = new baseForm();
//    $this->secret_value = $form->getCSRFToken();
  }

}