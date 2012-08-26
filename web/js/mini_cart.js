//добавление товара в корзину
var loader = '<img id="img_loader" src="/images/loader/loader_small4.gif" style="opacity: 0.6;"/>';
var item_variant_id;
//Форматирование Цены товара
Number.prototype.formatMoney = function(c, d, t){
	var n = this, c = isNaN(c = Math.abs(c)) ? 2 : c, d = d == undefined ? "," : d, t = t == undefined ? "." : t, s = n < 0 ? "-" : "", i = parseInt(n = Math.abs(+n || 0).toFixed(c)) + "", j = (j = i.length) > 3 ? j % 3 : 0;
	   return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
	 };

//Анимация выплывающей корзины
$(function()
		  {
		    $('#cart_button').toggle (
		      function()
		      {
		        $('#chat').css({'z-index':'4', 'right': '-400px'})
		                  .children('#chat_button').css('background-color', '');
		        $('#miniCart').animate({right: ['2px', 'swing']}, 500).children('#cart_button').css('background-color', '#97c0dc');
		      },
		      function()
		      {
		        $('#miniCart').animate({right: ['-400px', 'swing']}, 500).children('#cart_button').css('background-color', '');
		        $('#chat').css('z-index','5');
		      }
		    );

		    $(document).click(function(e){
		      var target = $(e.target);
		      if (
		        target.is('#miniCart') ||
		        target.parents('#miniCart').length
		      )
		        return;
		      $('#miniCart').animate({right: ['-400px', 'swing']}, 500).children('#cart_button').css('background-color', '');
		      $('#chat').css('z-index','5');
		    });

//		    $('#add_cart_item').hide();
//				if($('#cart_empty').is('div')) {
//					$('#cart_actions').hide();
//			}

		  });

var open_cart_item =  function(object,id) {
	$('#add_cart_item').css({'top' : $(object).offset().top, 
		 					 'left': $(object).offset().left - $('#add_cart_item').width()/3
	});
	$('#count_cart_item').val('1');
	
	var url = '/cart/check/'+id;
	$.ajax({
		url: url,
		type: 'GET',
		dataType: 'json',
		cache: false,
		success: function(json) {
					if (json['success'] === true)
					{
						if(json['message'])  {
							$('#add_cart_item').css('height', '85px');
							$('#check_cart_item').html(json['message']);		
						} else {
							$('#add_cart_item').css('height', '60px');
							$('#check_cart_item').html('');
						}
						$('#add_cart_item').show();	
					}
		},
		error:  function() {
					$('#add_cart_item').css('height', '60px');
					$('#check_cart_item').html('');
					$('#add_cart_item').show();
		}
	});
	item_variant_id = id;
	return false;
	};

var add_cart_item =  function() {
	var count_cart_item = $('#count_cart_item').val();
	var url = '/cart/add/'+item_variant_id+'/'+count_cart_item; 
	$.ajax({
		type: 'GET',
		url: url,
		daraType: 'json',
		cache: false,
		success: function(json) {
					$('#add_cart_item').hide();
					if(json['success']==true) refresh_cart(json['cart_item']);
					else error_message(json['error_message']);
		},
		error:   function() {
					alert('При добавлениеи товара в корзину возникли ошибки, попробуйте позже.');
					$('#add_cart_item').hide();
		}
	});
	
	return false;
};
//Добавляем товар в Вишлист
var add_wishlist_item =  function(id) {
	$.ajax({
		type: 'GET',
		url: '/wishlist/add',
		data: ({item_variant_id: id}),
		timeout: 1000,
		success: function(data) {
					$('#addwish'+id).html(data);
											
		},
		error:   function() {
					alert('При добавлениеи товара в Wishlist возникли ошибки, попробуйте позже.');
		}
	});
	
	return false;
};
var get_user_cart = function(url) {
	$.ajax({
		type: 'GET',
		url: url,
		data: null,
		timeout: 1000,
		success: function(json) {
						if(json['success']==true){
						   $('#cart_items_count').html(loader);
						   $('#mmCart').html($(json['cart']).children('#mmCart').html());
						   $('#cart_items_count').html($('#cart_content').children('div').length);
						}
						else error_message(json['error_message']);
						
		},
		error:   function() {
				error_message('Возникла ошибка, обновите страницу');
		}
	});
};
//Обновление корзины
var refresh_cart = function(cart_item) {
	
	$('#cart_items_count').html(loader);
	$('#cart_empty').remove();
	$('#cart_actions').show().removeClass('hide');
	if(cart_item['exist'])
		{
			$('#mini_cart_item'+cart_item['id']).children('div.mini_cart_item_count')
												.html(cart_item['count'] + 'шт.')
												.end()
												.children('div#mini_cart_item_sum')
												.html(function() {
													return parseInt(cart_item['count'])*parseInt(cart_item['price']);
												});
			$('#mini_cart_full_sum > span').html(countCartSum());
		}
	else {
			$('#cart_content').append(cart_item);
			$('#mini_cart_full_sum > span').html(countCartSum());
	}
	
	$('#cart_items_count').html($('#cart_content').children('div').length);
};
//Обработчик события удаления записи из корзины
var delete_cart_item = function(cart_id,json) {
	var mini_cart_item = '#mini_cart_item' + cart_id;
	if (json['success'] === true)
	{
		$(mini_cart_item).remove();
		var new_cart_items_count = $('#cart_content').children('div').length;
		if(new_cart_items_count==0) {
			$('#cart_items_count').html('');
			$('#cart_actions').hide();
			$('#cart_content').html('<div id="cart_empty">Ваша корзина пуста</div>');
			countCartSum();
	        $('#miniCart').animate({right: ['-400px', 'swing']}, 500).children('#cart_button').css('background-color', '');
	        $('#chat').css('z-index','5');

		}
		else {
			$('#cart_items_count').html(new_cart_items_count);
			$('#mini_cart_full_sum > span').html(countCartSum());
		}
	}
};

var error_message = function(message) {
	if(!message) alert('При удалении возникла ошибка, попробуйте позже.');
	else alert(message);
};
//Очистка корзины
var clean_cart = function(json) {
	if (json['success'] === true)
	{
		$('#cart_content').html('<div id="cart_empty">Ваша корзина пуста</div>');
		$('#cart_empty').show();
		$('#cart_actions').hide();
		$('#cart_items_count').html('');
		$('#mini_cart_full_sum').hide();
        $('#miniCart').animate({right: ['-400px', 'swing']}, 500).children('#cart_button').css('background-color', '');
        $('#chat').css('z-index','5');
	}
};
//Подсчет суммы заказа в корзине
var countCartSum = function() {
	countSumValue = 0;
	countValues = 0;
	$.each($('div#mini_cart_item_sum'), function() {
		countSumValue += parseInt($(this).html());
		countValues++;
	});
	if(countValues == 0) $('#mini_cart_full_sum').hide();
	else $('#mini_cart_full_sum').show();
	return countSumValue.formatMoney(0, '.', ' ') + ' руб.';

};
//Количество товара в корзину
$('img#plus').live('click',function(){
	var cart_count = $('input#count_cart_item');
	switch (this.id) {
		case "plus":
			cart_count.val(parseInt(cart_count.val())+1);
			break;
		case "minus":
			if (cart_count.val() > 1) cart_count.val(parseInt(cart_count.val()) - 1);
			break;
		default:
			return false;
	}
});