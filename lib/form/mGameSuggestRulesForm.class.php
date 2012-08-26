<?php
/**
 * Форма для принятия правил игры при создании аккаунта
 * @author Astronom
 *
 */
class mGameSuggestRulesForm extends BaseForm
{
  public function configure()
  {
    $this->setWidget('suggest_rules', new sfWidgetFormInputCheckbox(
                                          array('label' => 'Я принимаю условия правил'),
                                          array()));
    $this->setValidator('suggest_rules', new sfValidatorBoolean(
                                          array('required' => true),
                                          array('required' => 'Незабудьте принять условия игры')));

    $this->widgetSchema->setNameFormat('new_account[%s]');
  }

}