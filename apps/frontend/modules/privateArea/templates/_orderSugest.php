<script type="text/javascript">
$(function() {
	var api = $("ul#order_form").data("tabs");
	$('a#orderSugest').click(function() {
		$.ajax({
			url: "<?php echo url_for('@order_sugest') ?>",
			type: 'POST',
			data: {'sugest' : true },
			dataType: 'json',
			cache: false,
			success: function(json) {
				// everything is ok. (the server returned true)
					if (json['success'] === true)  {
					$('#order').html('<div class="notice">Спасибо за ваш заказ. На вашу почту было выслано письмо с информацией о заказе. Так же о соттоянии вы можете следить из своего <a href="<?php echo url_for('@private_area')?>">личного кабинета</a></div>');
					return false;

				// server-side validation failed. use invalidate() to show errors
					} else {

					}
			},
			error:  function() {
					form.append("Данный сервис временно не доступен");
			}

			});
		return false;
		});

});
</script>
<div id="order">
	<div id="orderUser">
		<h3>Покупатель: <?php echo $userFullName ?> (конт.телефон: <?php echo $userPhone ?> ) </h3>
	</div>
	<div id="orderCart">
		<h3>Состав заказа:</h3>
		<div class="order-list">
		<?php foreach ($orderList as $orderItem): ?>
		  <?php $countSum = 0; ?>
            <?php foreach($orderItem->getSCarts() as $i => $cartItem): ?>
            <?php if($i == 0):?>
            	<div class="bold">Магазин: <?php echo $cartItem->getCompany()->getName() ?> </div>
            <?php endif;?>
            <div class="order-item">
	      		<div class="order-item-description">
    	    		<a title="<?php echo $cartItem->getSItemVariant() ?>" href="<?php echo url_for('item_info',$cartItem->getSItemVariant()->getSItem()) ?>" target="_blank" ><?php echo $cartItem->getSItemVariant() ?></a>
      			</div>
      			<div class="order-item-count">
                  <?php echo $cartItem->getCount() ?> шт.
            	</div>
    			<div class="order-item-price">
      				<span class="price" title="Цена за единицы продукции - <?php echo $cartItem->getPrice()?> руб."><?php echo $cartItem->getSum()?> руб.</span>
      			</div>
           </div>
           <?php $countSum += $cartItem->getSum();?>
	        <?php endforeach; ?>
	        <div class="bold">Сумма заказа: <?php echo $countSum; ?> руб.</div>
		<?php endforeach;?>
		</div>
	</div>
	<div id="orderDelivery">
		<h3>Адрес доставки заказа: <?php echo $orderDelivery ?></h3>

	</div>
	<div id="orderPayment">
		<h3>Оплата заказа осущестляется наличными</h3>
	</div>
	<div id="orderComment">
		<h3>Комментарий к заказу: <?php echo $orderComment ?></h3>
	</div>
	<a id="orderSugest" href="#">Подтвердить заказ</a>
</div>