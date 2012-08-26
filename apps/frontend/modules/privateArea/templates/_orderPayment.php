<script type="text/javascript">
$(function() {
	var api = $("ul#order_form").data("tabs");
	$('a#orderSugest').click(function() {
		api.next();
		return false;
		});

});
</script>
<div class="notice">
	<p>Доступен способ оплаты только наличными</p>
</div>

<a href="<?php echo url_for('@order_sugest')?>" id="orderSugest"><img width="113" height="27" src="/images/privateArea/button_next.png" alt="Далее" style="cursor: pointer; float: right; margin-top: 20px;" /></a>