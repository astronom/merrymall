<?php use_helper('Global','Text') ?>
<?php include_partial('pageParts/rigthSideBar', array('floors' => $floors, 'modules' => array('select_floor','personal_area')) ) ?>
<div id="oporka">


<div class="kn5"></div>
<script type="text/javascript">
$(function() {
if ($.browser.opera && $.browser.version.substr(0,1) == '9') {$('#background').css('margin-top','0px');}
// Dialog			
$('#profile_edit').fancybox({
	'width'				: 500,
	'height'			: 300,
	'modal'				: true,
	'scrolling'			: 'no',
	'transitionIn'		: 'none',
	'transitionOut'		: 'none',
	'type'				: 'iframe',
	
	
});
//Подсчет общей суммы заказа.
var countSum = function(mag_id) {
	var objectCollection = $('input[type=text][name="cartForm"][id^="'+mag_id+'"]');
	if(mag_id == null) {
	 	objectCollection = $('input[type=text][name="cartForm"]'); 
	}	 
	countSumValue = 0;
	$.each(objectCollection, function() {
		countSumValue += this.value*$(this).next().val();
		});
	return countSumValue + '&nbsp;р.';
}
//Обработчик события удаления записи из фишлиста
$('.udalit').click(function() {
	var divBox = '#wish0'+this.id; 
	$('#wish' + this.id).load('/wishlist/delete?id=' + this.id,'');
	$('#wish0' + this.id).hide();
});
//Обработчик события удаления записи из корзины	
$('.udalitc').click(function() {
	var cart_id = this.id.substr(this.id.search('_')+1);
	$('#cartItem' + this.id).load('/cart/delete?id=' + cart_id,'');
	$('#cartItem' + this.id).remove();
	var mag_id = this.id.substr(0,this.id.search('_'));
	$('#countSum' + mag_id).html(countSum(mag_id));
	$('#fullSum').html(countSum(null));	
	// нужен для сохранения работоспособности сайта при отключенном JavaScript
	return false;
	
});
//Конец обработчика


// Обработчик изменения кооличества товара
var defualtCount = 1;
//Скрываем кнопочку о просьбе сохранить изменения (добавить disable)
$('#saveButton').hide();
$('input[type=text][name="cartForm"]').focus(function() {
//	Запоминаем прошлое значение
	defualtCount = this.value;
}).change(function() {
// 	Проверка количества (только целое положительное число), иначе возвращает прежнее значение.
	if(isNaN(this.value) || this.value <= 0) this.value = defualtCount;
	else {
	//Определяем для какого магазина произошло изменение	
	var mag_id = this.id.substr(0,this.id.search('_'));		
	//this.value = Math.round(this.value);
//	Изменяем значения в поле "Сумма"
	var newSum = this.value*$(this).next().val() + '&nbsp;р.';	
	box = '#cartItem' + this.id + ' > td:eq(2) > span';
	$(box).html(newSum);
	//"Сумма заказа" для магазина
	$('#countSum'+mag_id).html(countSum(mag_id));
	//Итоговая сумма заказа. Отправляем в качестве параметра null, чтобы обходчик прошелся по всем полям 
	$('#fullSum').html(countSum(null));	
//  Показываем кнопочку о просьбе сохранить изменения	
	$('#saveButton').show();
	}
});
$('a[id^="aaddwish"]').click(function() {
	//Отрежем необходимые айдишники
	var pre = this.id.substr(this.id.search('h')+1);
	//Разберем по отдельным айдишникам
	var item_id = pre.substr(pre.search('/')+1);
	var cart_item_id = pre.substr(0,pre.search('/'));
	var cart_id = cart_item_id.substr(cart_item_id.search('_')+1);
	var mag_id = cart_item_id.substr(0,cart_item_id.search('_'));
	//Check vars :-)
	//alert('pre =' +pre + ' item_id = ' + item_id + ' cart_item_id =' + cart_item_id + ' mag_id =' + mag_id + ' cart_id = ' + cart_id);
	$('a[id^="aaddwish' + pre + '"]').load('/wishlist/add?id=' + item_id,'');
	$('#cartItem' + cart_item_id).load('/cart/delete?id=' + cart_id,'');
	$('#cartItem' + cart_item_id).remove();
	$('#countSum' + mag_id).html(countSum(mag_id));
	$('#fullSum').html(countSum(null));	
	});
//Обработчик формы
$('#profile_form').hide();
$('#openOrderForm').toggle(function() {$('#profile_form').show(); }, 
		                   function() {$('#profile_form').hide(); }
);
});

var deleteCartItem = function() {
}

</script>
<table id="background" cellspacing="0" cellpadding="0" style="margin-top: -15px;">
	<tr>
		<td class="kabinetbd1"><img src="/images/office/pus.gif" border="0" alt=""></td>
		<td class="kabbd2">
			<table class="main" cellspacing="0" cellpadding="0" align="center">
				<tr>
					<td class="mn1">
						<?php include_component('pageParts', 'header') ?>
					</td>
				</tr>
				<tr>
				
					<td class="mn2kabinet">
			    	<div class="kabinet1"><div class="kabinet2"><div class="kabinet3"><div class="kabinet7">
						<div class="kabinet4"><div class="kabinet5"><div class="kabinet6"><div class="kabinet8">
							<a class="logokabinet" href="<?php echo url_for('@homepage', true) ?>">
                      			<img title="Merry Mall" alt="Merry Mall" src="/images/logo2.gif" width="130" height="96"/>
                    		</a>
							<div class="lichnie2">
								<p class="liczag">Контактные данные:</p>
								<div class="lichtxt">
									<?php echo $sf_user->getUserFullName().'<br>' ?> 
								</div>
								<a id="profile_edit" href="<?php echo url_for('private_area_edit_profile');?>" class="liclink">редактировать</a>
							</div>

							

						</div></div></div></div></div></div></div></div>
					</td>
				</tr>
				<tr>

					<td class="mn4kabinet">
			    	<table class="centerkabinet" cellspacing="0" cellpadding="0">
			    		<tr>
			    			<td class="cr5">
			          	<table class="korzina" cellspacing="0" cellpadding="0">
			          		<tr>
			          			<td class="kor1">
			          				<div class="zag18px">WISHLIST</div>

			          				<a href="#" class="razmer11px">смотреть полностью</a>
			          			</td>
			          			
			          		</tr>
			          	</table>

			          	<table class="shtuchki" cellspacing="0" cellpadding="0">
			          		<tr>
			          			  <?php foreach($wishlist as $wish): ?>
			          			  <td id="<?php echo 'wish'.$wish->getId() ?>" class="si11">
			          				<table class="shtuka" cellspacing="0" cellpadding="0">
			          					<tr>
			          						<td class="sht1"><?php echo image_tag('office/kar.gif', 'alt=foo border=0') ?></td>
			          						<td class="sht2">
			          							<a href="#" class="razmer12px"><?php echo $wish->getSItemVariant() ?></a><br>
			          							<span class="green"><?php echo $wish->getSItemVariant()->getPrice()?> р.</span><br>
			          							<a href="#" id="<?php echo $wish->getId() ?>" class="udalit">удалить</a>
			          						</td>
			          					</tr>
			          				</table>
			          				</td>
			          				<?php endforeach; ?>
			          		</tr>
			          	</table>
			    			</td>

			    		</tr>
			    		<tr>
			    			<td class="cr6">
          				<table class="tablichka" cellspacing="0" cellpadding="0" border="0">
          					<tr>
          						<td class="tab11"><a href="#">Закладки на магазины</a></td>
          						<td class="tab12">
          							<a href="#">КОРЗИНА</a>
          							<img id="openOrderForm" align="right" src="/images/office/oformit_zakaz.gif" border="0" alt="Оформить заказ" style="cursor: pointer;">
          						</td>          						
          					</tr>
          					<tr>
          						<td class="tab3">
          							<ul class="mumagaz">
										<li><a href="#">Sela</a></li>
										<li><a href="#">Armani</a></li>
										<li><a href="#">ToYo</a></li>
										<li><a href="#">Reebok</a></li>
										<li><a href="#">Cropp</a></li>
										<li><a href="#">Adidas</a></li>
									</ul>
									<br><br>
									<a href="#" class="razmer11px">редактировать закладки</a>
          						</td>
          						<td class="tab32">
          						<?php include_partial('cart',array('companies' => $companies)) ?>
                                <?php include_partial('orderForm',array('form' => $orderForm)) ?>


          						</td>
          						
          					</tr>
          				</table>
			    			</td>
			    		</tr>
			    	</table>
					</td>
				</tr>
				<tr>
					<td class="mn5">&nbsp;</td>

				</tr>
			</table>
		</td>
		<td class="kabinetbd3"><img src="/images/office/pus.gif" border="0" alt=""></td>
	</tr>
</table>


</div>
