//добавление товара в корзину
var loader = '<img id="img_loader" src="/images/loader/loader_small4.gif" style="opacity: 0.6;"/>';
var item_variant_id;
// Форматирование Цены товара
Number.prototype.formatMoney = function(c, d, t) {
	var n = this, c = isNaN(c = Math.abs(c)) ? 2 : c, d = d == undefined
			? ","
			: d, t = t == undefined ? "." : t, s = n < 0 ? "-" : "", i = parseInt(n = Math
			.abs(+n || 0).toFixed(c))
			+ "", j = (j = i.length) > 3 ? j % 3 : 0;
	return s + (j ? i.substr(0, j) + t : "")
			+ i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t)
			+ (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
};

// Анимация выплывающей корзины
$(function() {
	$('#game_cart_button').toggle(
			function() {
				$('#chat').css({
					'z-index' : '4',
					'right' : '-400px'
				}).children('#chat_button').css('background-color', '');
				$('#gameMiniCart').animate({
					right : ['2px', 'swing']
				}, 500).children('#game_cart_button').css('background-color',
						'#cc745c');
			},
			function() {
				$('#gameMiniCart').animate({
					right : ['-400px', 'swing']
				}, 500).children('#game_cart_button').css('background-color',
						'');
				$('#chat').css('z-index', '5');
			});

	$(document).click(
			function(e) {
				var target = $(e.target);
				if (target.is('#gameMiniCart')
						|| target.parents('#gameMiniCart').length)
					return;
				$('#gameMiniCart').animate({
					right : ['-400px', 'swing']
				}, 500).children('#game_cart_button').css('background-color',
						'');
				$('#chat').css('z-index', '5');
			});
});

var open_cart_item = function(object, id) {
	$('#add_cart_item').css({
		'top' : $(object).offset().top,
		'left' : $(object).offset().left - $('#add_cart_item').width() / 3
	});
	$('#count_cart_item').val('1');

	var url = '/frontend_dev.php/cart/check/' + id;
	$.ajax({
		url : url,
		type : 'GET',
		dataType : 'json',
		cache : false,
		success : function(json) {
			if (json['success'] === true) {
				if (json['message']) {
					$('#add_cart_item').css('height', '85px');
					$('#check_cart_item').html(json['message']);
				} else {
					$('#add_cart_item').css('height', '60px');
					$('#check_cart_item').html('');
				}
				$('#add_cart_item').show();
			}
		},
		error : function() {
			$('#add_cart_item').css('height', '60px');
			$('#check_cart_item').html('');
			$('#add_cart_item').show();
		}
	});
	item_variant_id = id;
	return false;
};

// var game_add_cart_item = function() {
// var count_cart_item = $('#count_cart_item').val();
// var url = '/frontend_dev.php/cart/add/'+item_variant_id+'/'+count_cart_item;
// $.ajax({
// type: 'GET',
// url: url,
// daraType: 'json',
// cache: false,
// success: function(json) {
// $('#add_cart_item').hide();
// if(json['success']==true) refresh_cart(json['cart_item']);
// else error_message(json['error_message']);
// },
// error: function() {
// alert('При добавлениеи товара в корзину возникли ошибки, попробуйте позже.');
// $('#add_cart_item').hide();
// }
// });
//	
// return false;
// };
// Обновление корзины
var game_refresh_cart = function(data) {
	if (data['success'] === true) {
		cart_item = data['cart_item'];
		if (cart_item['exist']) {
			$('#game_mini_cart_item' + cart_item['id']).children(
					'div.game-mini-cart-item-count').html(
					cart_item['count'] + 'шт.').end().children(
					'div#mini_cart_item_sum').html(
					function() {
						return parseInt(cart_item['count'])
								* parseInt(cart_item['price']);
					});
			$('#game_mini_cart_full_sum > span').html(countCartSum());
		} else {
			$('#game_mini_cart_empty').remove();
			$('#game_mini_cart_content').append(cart_item);
			$('#game_mini_cart_full_sum > span').html(countGameCartSum());
		}

		$('#game_mini_cart_items_count').html(
				$('#game_mini_cart_content').children('div').length);
	} else {
		$('#game_mini_cart_items_count').html(
				$('#game_mini_cart_content').children('div').length);
		game_error_message(data);
	}
};
// Обработчик события удаления записи из корзины
var game_remove_cart_item = function(game_cart_id, json) {
	var game_mini_cart_item = '#game_mini_cart_item' + game_cart_id;
	if (json['success'] === true) {
		$(game_mini_cart_item).remove();
		var game_cart_items_count = $('#game_mini_cart_content')
				.children('div').length;
		if (game_cart_items_count == 0) {
			$('#game_mini_cart_items_count').html('');
			$('#game_mini_cart_actions').addClass('hide').hide();
			$('#game_mini_cart_content').html(
					'<div id="game_mini_cart_empty">Ваша корзина пуста</div>');
			$('#gameMiniCart').animate({
				right : ['-400px', 'swing']
			}, 500).children('#game_mini_cart_button').css('background-color',
					'');
			$('#chat').css('z-index', '5');

		} else {
			$('#game_mini_cart_items_count').html(game_cart_items_count);
			$('#game_mini_cart_full_sum > span').html(countGameCartSum());
		}
	} else
		game_error_message(json['error_message']);
};

var game_error_message = function(json) {
	$.fancybox.showActivity();
	if (json['notice_massage']) {
		$.fancybox(json['notice_massage']);
	} else {
		if (!json['error_massage']) {
			$
					.fancybox('Во время выполнения операции возникла ошибка, попробуйте позже.');
		} else {
			$.fancybox(json['error_massage']);
		}
	}
};
// Очистка корзины
var game_clean_cart = function(json) {
	if (json['success'] === true) {
		$('#game_mini_cart_items_count').html('');
		$('#game_mini_cart_content').html(
				'<div id="game_mini_cart_empty">Ваша корзина пуста</div>');
		// $('#gameMiniCart').animate({right: ['-400px', 'swing']},
		// 500).children('#game_mini_cart_button').css('background-color', '');
		$('#chat').css('z-index', '5');
	}
};
// Подсчет суммы заказа в корзине
var countGameCartSum = function() {
	countSumValue = 0;
	$.each($('div#game_mini_cart_item_sum'), function() {
		countSumValue += parseInt($(this).html());
	});
	return countSumValue.formatMoney(0, '.', ' ') + ' руб.';

};

var game_checkout_cart = function(json) {
	if (json['success'] === true) {
		$.fancybox.showActivity();
		$.fancybox(json['checkout_message']);
		$.fancybox.close(game_clean_cart(json));

	}
};
// Количество товара в корзину
$('img#plus').live('click', function() {
	var cart_count = $('input#count_cart_item');
	switch (this.id) {
		case "plus" :
			cart_count.val(parseInt(cart_count.val()) + 1);
			break;
		case "minus" :
			if (cart_count.val() > 1)
				cart_count.val(parseInt(cart_count.val()) - 1);
			break;
		default :
			return false;
	}
});