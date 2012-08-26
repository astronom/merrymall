$(function() {

});
var wish_action_decorator = '<div class="on-action"><img src="/images/loader/loader_small4.gif" alt="Подождите..." /></div>';
//Перенос из вишлиста в корзину
var move_to_cart = function(id,name,value) {
	var wish_id = id;
	var wishItem = $('#wish' + wish_id);
	
	//decorator
	wishItem.append(wish_action_decorator)
			.children('.wish_actions').hide();
	$.ajax({
		type: 'POST',
		url: '/wishlist/moveToCart',
		data: ({'_csrf_ten': value, id: wish_id}),
		timeout: 1000,
	success: function() {
		wishItem.remove();
		refresh_cart();
	},
	error:   function() {
		alert('При перемещении в Корзину возникла ошибка, попробуйте позже.');
		
		wishItem.children('.on-action').remove();
		wishItem.children('.wish_actions').show();
	}
	});
	
	return false;

};

//Перенос из вишлиста в корзину
var wish_delete = function(id,name,value) {
	var wish_id = id;
	var wishItem = $('#wish' + wish_id);
	
	//decorator
	wishItem.append(wish_action_decorator)
			.children('.wish_actions').hide();

	$.ajax({
		type: 'POST',
		url: '/wishlist/delete',
		data: ({'_csrf_token': value, id: wish_id}),
		timeout: 1000,
	success: function() {
		wishItem.remove();
		if($('.wish').length == 0) 
		{
			$('#wishlist').append('<div id="notice"><center>Вишлист пуст</center></div>');
		}
	},
	error:   function() {
		alert('При удалении из вишлиста возникла ошибка, попробуйте позже.');
		wishItem.children('.on-action').remove();
		wishItem.children('.wish_actions').show();
	}
	});
	
	return false;

};