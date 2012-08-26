<div>
<h2>Добавить новый товар</h2>
<form action="<?php echo url_for('@game_store_add_user_item') ?>" method="POST">
<fieldset>
<?php echo $userItemForm['url']->renderLabel() ?>
<?php echo $userItemForm['url']->render() ?>
<?php echo $userItemForm['url']->renderError() ?>
<br>
<?php echo $userItemForm['picture']->renderLabel() ?>
<?php echo $userItemForm['picture']->render() ?>
<?php echo $userItemForm['picture']->renderError() ?>
<br>
<?php echo $userItemForm['price']->renderLabel() ?>
<?php echo $userItemForm['price']->render() ?>
<?php echo $userItemForm['price']->renderError() ?>
<br>
<?php echo $userItemForm['description']->renderLabel() ?>
<?php echo $userItemForm['description']->render() ?>
<?php echo $userItemForm['description']->renderError() ?>
<br>
<?php echo $userItemForm->renderHiddenFields() ?>
</fieldset>
<input type="submit" value="Добавить пользовательский товар" />
</form>
</div>
