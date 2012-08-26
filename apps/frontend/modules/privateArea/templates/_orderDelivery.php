<script>
$(function() {
	$("ul#order_form_deliver").tabs("div.panes > div");
	var api = $("ul#order_form").data("tabs");
	$("#myform_delivery").validator({ lang: 'ru' }).submit(function(e) {
		submitForm($(this),e);
		});
	$('a#orderNext').click(function() {
		api.next();
		return false;
	});
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

});
</script>
<ul id="order_form_deliver" class="tabs">
	<li><a href="#">Курьерская доставка</a></li>
	<li><a href="#">Самовывоз</a></li>
</ul>
<div class="panes">
	<div>
		<form id="myform_delivery" class="order-form" action="<?php echo url_for('@order_delivery') ?>" method="post">
    		<fieldset>
    		    <?php echo $orderDeliveryForm ?>
      			<button type="submit">Отправить</button>
      			<button type="reset">Сбросить</button>
	    	</fieldset>
  		</form>
	</div>
	<div>
		<div class="notice">
			<p>Вы можите забрать товары по адресу:<p>
		<?php foreach($companies as $company):?>
          <p><?php echo $company->getProfile()->getSelfDeliveryAddress()?></p>
        <?php endforeach;?>
        </div>
        <a id="orderNext" href="<?php echo url_for('@order_payment')?>"><img width="113" height="27" src="/images/privateArea/button_next.png" alt="Далее" style="cursor: pointer; float: right; margin-top: 20px;" /></a>
	</div>
</div>


