<!-- Форма добавления заказа -->
<div id="add_cart_item" class="add_cart_item">
<div class="add_cart_item_layout">
<div class="add_cart_item_content">
    <form id="cart_item_form" action="<?php //echo url_for('cart_add') ?>" method="POST">
      <img id="minus" class="count_action" src="/images/icons/round_remove_16x16.png" alt="-" />
      <input id="count_cart_item" type="text" value="1" size="3" />
	  <img id="plus" class="count_action" src="/images/icons/round_add_16x16.png" alt="-" />
      <input class="add_cart_item_button" type="image" src="/images/icons/cart_32x32.png" title="Положить в корзину" style="border: none;" onClick="add_cart_item(); return false;" />
    </form>
	<div id="check_cart_item"></div>
</div>
  	<img id="close_add_cart_item"
      src="/images/icons/delete_16x16.png" alt="Х" title="Закрыть"
      onClick="$('#add_cart_item').hide();" />
</div>
</div>
<!-- End Форма добавления заказа -->