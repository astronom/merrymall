<div>
<h2><?php echo link_to('Архив покупок','@game_cart_archive')?> (последние 10) </h2>
<?php foreach ($cartItems as $cartItem):?>
	<?php echo $cartItem['sItemVariant']['name'] ?>
	<?php echo $cartItem['price'] ?>
	<br />
<?php endforeach;?>
</div>