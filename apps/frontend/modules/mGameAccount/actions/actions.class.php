<?php

/**
 * mGameAccount actions.
 *
 * @package    merrymall
 * @subpackage mGameAccount
 * @author     Alexander Manichev aka Astronom <a.manichev@gmail.com>
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class mGameAccountActions extends sfActions
{
  /**
   * Главная страница аккаунта игрока
   *
   * @param sfRequest $request A request object
   */
  public function executeIndex(sfWebRequest $request)
  {
    if($this->getUser()->isGamer())
    {
      //    @todo количество туров брать из базы или настроек
      $this->gameRoundsCount = 9;

      $gameAccountId = $this->getUser()->getAttribute('game_account_id', null, 'sfGuardSecurityUser');
      $this->account = mGameAccountTable::getInstance()->getOneByIdWithmGameCartQuery($gameAccountId)->fetchOne();

      $userItemFormClass = sfConfig::get('app_m_game_store_user_item_form', 'mGameUserItemForm');
      $this->userItemForm = new $userItemFormClass();

      $this->userItems = mGameUserItemTable::getInstance()->findByAccountId($gameAccountId);

      $this->gameRoundPurchases = $roundRules = mGameRoundRulesTable::getInstance()->findOneByRound($this->account->getRound())->getPurchases();
      $this->gameAccountsRoundPurchases = $countCartItems = mGameCartTable::getInstance()->findByAccountId($gameAccountId)->count();;

      $this->ratings = mGameAccountTable::getInstance()->getLimitedOrderByRatingQuery(sfConfig::get('app_m_game_max_accounts_on_brif_rating',5))->execute();
      $this->accountPosition = mGameAccountTable::getInstance()->getAccountPositionByRatingQuery($this->account->rating)->execute(array(), Doctrine_Core::HYDRATE_SINGLE_SCALAR);
    }
    if(!$this->getUser()->isAnonymous() && $this->getUser()->isAuthenticated())
    {
      $this->suggestRulesForm = new mGameSuggestRulesForm();
    }
    else
    {
      $class = sfConfig::get('app_sf_guard_plugin_signin_form', 'sfGuardFormSignin');
      $this->signinForm = new $class();
    }
  }
  /**
   * Логинит пользователя
   * @param sfWebRequest $request
   */
  public function executeSigninGamer(sfWebRequest $request)
  {
    $this->getUser()->signInGamer();
    return $this->forward('mGameAccount', 'index');
  }
  /**
   * Создание аккаунта игрока
   * @param sfWebRequest $request
   * @return Ambigous <JSON, string>
   */
  public function executeCreate(sfWebRequest $request)
  {
    $class = sfConfig::get('app_m_game_suggest_rules_form', 'mGameSuggestRulesForm');
    $this->suggestRulesForm = new $class();

    $this->suggestRulesForm->bind($request->getParameter('new_account'));
    if($this->suggestRulesForm->isValid())
    {

      $newAccount = new mGameAccount();
      $roundRules = Doctrine::getTable('mGameRoundRules')->findOneByRound('1');

      $newAccount->user_id = $this->getUser()->getId();
      $newAccount->round = $roundRules->round;
      $newAccount->rating = 0;
      $newAccount->money = $roundRules->money;
      $newAccount->credit = 0;

      $newAccount->save();

      $this->getUser()->signInGamer();
      $this->redirect('@game_account');
      //      if($request->isXmlHttpRequest())
      //      {
      //        return $this->returnJSON(array('success' => true));
      //      }
      //      else
      //      {
      //        return $this->setTemplate('index');
      //      }

      }
      else {

        if($request->isXmlHttpRequest())
        {
          $output = array('success' => false);
          $form_namespace = $this->suggestRulesForm->getWidgetSchema()->getNameFormat();

          foreach ($this->suggestRulesForm->getFormFieldSchema() as $name => $formField)
          {
            if(($error_name = $formField->getError()) !=NULL)
            {
              $output[sprintf($form_namespace,$name)] = addcslashes($error_name,'"');
            }
          }
          return $this->returnJSON($output);
        }
      }
      return $this->setTemplate('index');
    }

    public function executeAddItem(sfWebRequest $request)
    {
      $userItemFormClass = sfConfig::get('app_m_game_store_user_item_form', 'mGameUserItemForm');
      $this->userItemForm = new $userItemFormClass();

      $this->userItemForm->bind($request->getParameter('user_item'));
      if($this->userItemForm->isValid())
      {
        $this->userItemForm->save();
      }
    }
    /**
     * Метод, отдающий данные в JSON формате
     * @param Array $output
     * @return JSON String <sfView::NONE, string>
     */
    private function returnJSON($output)
    {
      $this->getResponse()->setHttpHeader('Content-type', 'application/json');
      return $this->renderText(json_encode($output));
    }
  }
