<?php use_javascript('http://cdn.jquerytools.org/1.2.5/all/jquery.tools.min.js')?>
<?php use_javascript('plugin/JQueryTools/validator.ru.js')?>
<script>
<?php echo 'var self_delivery_address = new Array(null'?>
<?php foreach($companies as $company):?>
  <?php echo ',"'.$company->getProfile()->getSelfDeliveryAddress().'"';?>
<?php endforeach;?>
<?php echo ');'?>
var self_delivery_info = 'Вы можете забрать товар по ';
if((count = self_delivery_address.length) > 2) {
	self_delivery_info += 'адресам:';
}
else self_delivery_info += 'адресy:';
for(i=1;i!=count;i++) {
	self_delivery_info += ' ' + self_delivery_address[i];
}
$(function() {
	$("ul#order_form").tabs("div.panes-main > div", {effect: 'ajax'});
	var api = $("ul#order_form").data("tabs");

	var submitForm = function(form, e) {
		if (!e.isDefaultPrevented()) {
			$.ajax({
				url: form.attr("action"),
				type: 'POST',
				data: form.serialize(),
				dataType: 'json',
				cache: false,
				success: function(json) {
					// everything is ok. (the server returned true)
						if (json['success'] === true)  {
							api.next();

					// server-side validation failed. use invalidate() to show errors
						} else {
							form.data("validator").invalidate(json);
						}
				},
				error:  function() {
						form.append("Данный сервис временно не доступен");
				}

				});
			// prevent default form submission logic
			e.preventDefault();

			}
		};
	$.tools.validator.localize("ru", {
		'*'			    : 'Недопустимые символы',
		'[min]'	 		: 'Минимальное количество символов: $1',
		'[max]'	 		: 'Максимальное количество символов: $1',
		'[required]'	: 'Поле обязательно к заполнению',
		':email'		: 'Введите корректный адрес электронной почты',
		'[data-equals]' : 'Повторите пароль в точности'
	});

	// use the finnish language in the validator



});
</script>
<div class="order-content">

<ul id="order_form" class="tabs">
	<?php if($sf_user->isAnonymous()): ?>
	<li><a id="t1" href="<?php echo url_for('@order_signin')?>">Авторизация</a></li>
	<?php endif; ?>
	<li><a id="t2" href="<?php echo url_for('@order_cart')?>">Заказ</a></li>
	<li><a id="t3" href="<?php echo url_for('@order_delivery')?>">Способ доставки</a></li>
	<li><a id="t4" href="<?php echo url_for('@order_payment')?>">Способ оплаты</a></li>
	<li><a id="t5" href="<?php echo url_for('@order_sugest')?>">Подтверждение заказа</a></li>
</ul>
<div class="panes-main">
	<div style="display:block"></div>
</div>
</div>

