<?php
class pagePartsActions extends sfActions
{
  public function executeInitChat(sfWebRequest $request)
  {
    $this->forward404Unless($operator_id = Doctrine::getTable('sfGuardUser')->findOperatorsUsername($request->getParameter('company_id', '')));

    $user_id = $this->getUser()->getId();
    if($chatId = Doctrine::getTable('sChat')->findChatByUserIdAndOperatorId($user_id,$operator_id))
    {
      return $this->renderText($chatId);
    }
    else
    {
      $chat = new sChat();
      $chat->setUserId($user_id);
      $chat->setOperatorId($operator_id);
      $chat->save();

      return $this->renderText($chat->id);
    }
    return $this->renderText('');
  }

}