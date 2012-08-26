//Форматирование Цены товара
Number.prototype.formatMoney = function(c, d, t){
	var n = this, c = isNaN(c = Math.abs(c)) ? 2 : c, d = d == undefined ? "," : d, t = t == undefined ? "." : t, s = n < 0 ? "-" : "", i = parseInt(n = Math.abs(+n || 0).toFixed(c)) + "", j = (j = i.length) > 3 ? j % 3 : 0;
	   return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
	 };
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
	return countSumValue.formatMoney(0, '.', ' ') + ' руб.';
};
//Обновление вишлиста
var refresh_wishlist = function() {	
	var loader = '<img id="img_loader" src="/images/loader/loader_small4.gif" />';
	$.get('/wishlist/refresh', 
		  function(data) {
		  		$('.wishlist > #notice').remove();
				$('.wishlist').append(data);
	});
};

//Обновление корзины
//@todo доработать 
var refresh_cart = function() {	
	var loader = '<img id="img_loader" src="/images/loader/loader_small4.gif" />';
	$.get('/cart/refresh_', 
		  function(data) {
		  		$('.cart_list').remove();
		  		$('.cart > .title').after(data);
//				$('#order_form').before(data);
//				$('.cart > h3').show();	
//				$('#orderForm').show();
	});
};
var cart_action_decorator = '<div class="on-action-cart"><img src="/images/loader/loader_small4.gif" alt="Подождите..." /></div>';
//Обработчик события удаления записи из корзины
//var delete_cart_item = function(id,name,value) {
//
//	var cartItem = $('#cartItem' + id + '> td');
//	var cart_id = id.substr(id.search('_')+1);
//	var mag_id = id.substr(0,id.search('_'));
//
//	
//	//decorator
//	cartItem.eq(3).children().hide();
//	cartItem.eq(4).html(cart_action_decorator);
//	
//	$.ajax({
//		type: 'GET',
//		url: '/cart/delete',
//		data: ({'_csrf_token': value, id: cart_id}),
//		timeout: 1000,
//	success: function() {
//		cartItem.remove();
//		if($('.cart_item').length == 0) 
//		{
//			$('.cart_list').remove();
////			$('#order_form').before('<div id="notice"><center>Ваша корзина пуста</center></div>').hide();
////			$('#orderForm').hide();
//		}
//		$('#countSum' + mag_id).html(countSum(mag_id));
//		$('#fullSum').html(countSum(null));	
//	},
//	error:   function() {
//		alert('При удалении возникла ошибка, попробуйте позже.');
//		cartItem.eq(4).html('');
//		cartItem.eq(3).children().show();
//	}
//	});
//
//	return false;
//};
//Обработчик события удаления записи из корзины
var delete_cart_item = function(cart_id,mag_id,json) {
	var cart_item = '#cart_item_'+ cart_id;
	if (json['success'] === true)
	{
		$(cart_item).remove();
		$('#countSum' + mag_id).html(countSum(mag_id));
		$('#fullSum').html(countSum(null));		
		}
		else {
			$('#countSum' + mag_id).html(countSum(mag_id));
			$('#fullSum').html(countSum(null));		
		}
};	

//Перенос из корзины в вишлист
var move_to_wishlist = function(company_id,cart_id,item_variant_id,name,value) {
	var cartItem = $('#cartItem' + company_id + '_' + cart_id);
	
	//decorator
	cartItem.eq(3).children().hide();
	cartItem.eq(4).html(cart_action_decorator);

	$.ajax({
		type: 'POST',
		url: '/cart/moveToWishlist',
		data: ({'_csrf_token': value, id: cart_id}),
		timeout: 1000,
	success: function(data) {
		cartItem.remove();
		if($('.cart_item').length == 0) 
		{
			$('.cart_list').remove();
			//$('.content').css('min-height','0px').children('.cart').css('min-height','0px');
//			$('#order_form').before('<div id="notice"><center>Ваша корзина пуста</center></div>').hide();
//			$('#orderForm').hide();
		}
		$('#countSum' + company_id).html(countSum(company_id));
		$('#fullSum').html(countSum(null));
		if(data == 'refresh_wishlist') refresh_wishlist();
	},
	error:   function() {
		alert('При перемещении в Wishlist возникла ошибка, попробуйте позже.');
		cartItem.eq(4).html('');
		cartItem.eq(3).children().show();
	}
	});
	
	return false;
};

var change_cart_count = function() {
	alert($(this));
};

var error_message = function(message) {
	if(!message) alert('При удалении возникла ошибка, попробуйте позже.');
	else alert(message);
};

$(function() {
	// Обработчик изменения кооличества товара
	var defualtCount = 1;

	//Скрываем кнопочку о просьбе сохранить изменения (добавить disable)
	//$('#saveButton').hide();
	$('input[type=text][name="cartForm"]')
	.focus(function() {
		//Запоминаем прошлое значение
		defualtCount = this.value;})

		.change(function() {
			// 	Проверка количества (только целое положительное число), иначе возвращает прежнее значение.
			if(isNaN(this.value) || this.value <= 0) this.value = defualtCount;
			else {
				//Определяем для какого магазина произошло изменение	
				var mag_id = this.id.substr(0,this.id.search('_'));		
				//this.value = Math.round(this.value);
				//	Изменяем значения в поле "Сумма"
				var newSum = this.value*$(this).next().val() + '&nbsp;руб.';	
				box = '#cartItem' + this.id + ' > .price';
				$(box).filter('price').html(newSum);
				// "Сумма заказа" для магазина
				$('#countSum'+mag_id).html(countSum(mag_id));
				//Итоговая сумма заказа. Отправляем в качестве параметра null, чтобы обходчик прошелся по всем полям 
				$('#fullSum').html(countSum(null));	
				//  Показываем кнопочку о просьбе сохранить изменения	
				$('#saveButton').show();
			}
		});
	$('img#plus,img#minus').live('click', function(){
		switch (this.id) {
			case "plus":				
				var cart_count = $(this).prev().prev();
				cart_count.val(parseInt(cart_count.val())+1);
				break;
			case "minus":
				var cart_count = $(this).next('input');
				if (cart_count.val() > 1) cart_count.val(parseInt(cart_count.val()) - 1);
			break;
		}
		
		var newSum = parseInt(cart_count.val())*cart_count.next().val();

		var cartItemId = cart_count.attr('id');
		
		var mag_id = cartItemId.substr(0,cartItemId.search('_'));
		
		box = '#cart_item_' + cartItemId + ' > td:eq(2) > span.price';	
		
		$(box).html(newSum + ' руб.');
//		// "Сумма заказа" для магазина
		$('#countSum'+mag_id+'> h3').html(countSum(mag_id));
//		//Итоговая сумма заказа. Отправляем в качестве параметра null, чтобы обходчик прошелся по всем полям 
		$('#fullSum').html(countSum(null));	
	});
	    
		//Включаем лайтбокс
         $('.zoomin').lightBox({
    			overlayBgColor: '#83b4d5',
    			overlayOpacity: 0.6,
    			imageLoading: '/images/loader/loader_small4.gif',
    			imageBtnClose: '/images/icons/close.png',
    			imageBtnPrev: '/images/icons/left_arrow.png',
    			imageBtnNext: '/images/icons/right_arrow.png',
    			containerResizeSpeed: 350,
    			txtImage: 'Изображение',
    			txtOf: 'из'

        });
		
		$('.zoomin').addClass('hide');
    	$('.cart_image, .wish_image').live('mouseover mouseout',
           function(ev) {
  		    var zoomin = $(this).children('.zoomin');

  		    if (ev.type == 'mouseover') {
            	zoomin.removeClass('hide');
            }

            if (ev.type == 'mouseout') {
            	zoomin.addClass('hide');
            }
    	});
});