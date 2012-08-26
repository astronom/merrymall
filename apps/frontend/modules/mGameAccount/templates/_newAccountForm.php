<div class="info">
<p>Тут всякая инфа о игре.</p>
<?php
//echo jq_form_remote_tag(array(
//                             'url' => '@game_account_create',
//                             'dataType' => 'json',
//                             'success' => ''
//                             ),
//                             array(
//                             'name' => 'new_account')
//                             ) ?>
<?php echo form_tag('@game_account_create',array('name' => 'new_account'))?>
<?php echo $suggestRulesForm['suggest_rules']->renderError()?>
<?php echo $suggestRulesForm['suggest_rules']->render()?>
<?php echo $suggestRulesForm['suggest_rules']->renderLabel()?>
<?php echo $suggestRulesForm->renderHiddenFields(true)?>
<br>
<input type="submit" value="Начать игру за Нереальные Деньги!" />
</form>
</div>