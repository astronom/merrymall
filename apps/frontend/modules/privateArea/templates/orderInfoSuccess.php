<?php use_helper('Date') ?>
<div id="page">
  <?php include_component('pageParts', 'header') ?>
             <div id="page_layout">
                <div class="layout_background privateArea">
                </div>
                <div id="page_content" class="">
                  <div class="page_content-top">
                    <a class="logo" href="<?php echo url_for('@homepage', true) ?>">
                      <?php echo image_tag('logo2.gif',array('alt_title'=>'На Главную')); ?>
                    </a>
                    <div class="page_name"></div>
                </div>
                <div class="rounded-box-10">
                    <b class="r10 white"></b>
                    <b class="r9 blr"></b>
                    <b class="r7 blr"></b>
                    <b class="r5 blr"></b>
                    <b class="r4 blr"></b>
                    <b class="r3 blr"></b>
                    <b class="r2 blr"></b>
                    <b class="r2 blr"></b>
                    <b class="r1 blr"></b>
                    <b class="r1 blr"></b>
                    <b class="r1 blr"></b>
                    <div class="content">
                    <!-- Orders info Start -->
                        <div id="order">
                            <h2 class="title" style="padding-left: 20px;"><img src="/images/icons/cart_32x32.png" alt="" width="22" style="position: relative; top: 1px; margin-right: 2px;"/>Информация о заказе № <?php echo $order->getId() ?></h2>
                            <div class="order-content">
	<div id="orderCart">
		<h3>Состав заказа:</h3>
		<div class="order-list">

		  <?php $countSum = 0; $storeName = ''; $curentCountSum = 0; ?>
            <?php foreach($order->getSCarts() as $i => $cartItem): ?>
            <?php if($storeName != $curentStoreName = $cartItem->getCompany()->getName()):?>
            	<?php if($i > 0): ?>
            		<div class="bold">Сумма подзаказа: <?php echo $curentCountSum ?>  руб.</div><br />
            	<?php endif;?>
            	<div class="bold">Магазин: <?php echo $curentStoreName ?> </div>
            	<div class="bold">Статус заказа: <?php echo $order->getSCompanyOrder($cartItem->getCompany()->getId())->getHumanStatus() ?></div>
            	<?php $storeName = $curentStoreName; $curentCountSum = 0; ?>
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
           <?php $countSum += $cartItem->getSum(); $curentCountSum += $cartItem->getSum(); ?>
	        <?php endforeach; ?>
	        <div class="bold">Сумма заказа: <?php echo $countSum; ?> руб.</div>
		</div>
	</div>
                            	<span class="bold">Заказ оформлен:</span> <?php echo format_datetime($order->getCreatedAt(),'f') ?><br />
                            	<span class="bold">Адрес доставки:</span> <?php echo $order->getAddress() ?><br />
                            </div>

                        </div>
                    <!-- Orders info End -->
                    </div>
                    <b class="r1 blr"></b>
                    <b class="r1 blr"></b>
                    <b class="r1 blr"></b>
                    <b class="r2 blr"></b>
                    <b class="r2 blr"></b>
                    <b class="r3 blr"></b>
                    <b class="r4 blr"></b>
                    <b class="r5 blr"></b>
                    <b class="r7 blr"></b>
                    <b class="r10 white"></b>
                </div>
            </div>
			<!-- Footer -->
            <div id="page_footer">

            </div>
			<!-- End Footer -->
        </div>
</div>