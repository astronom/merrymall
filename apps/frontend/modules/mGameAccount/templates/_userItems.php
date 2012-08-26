<div>
<h2>Товары добавленные игроком</h2>
<?php foreach ($userItems as $userItem):?>
	<a href="<?php echo $userItem->getUrl()  ?>">Товар такой-то</a>
	<?php echo image_tag($userItem->getPicture()) ?>
	<?php echo $userItem->getPrice() ?>
	<?php echo $userItem->getDescription() ?>
	<?php echo $userItem->getVerification() ?>
	<br />
<?php endforeach;?>
</div>