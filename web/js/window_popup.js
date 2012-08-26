$(function() {
	$('.popup_actions')
		.click(function() {
			   $('#window_popup').hide();
			   $('.background_popup').hide();
	});
	
	$('a#profile_edit')
		.click(function() {
			   $('.background_popup').show();
			   // позиционируем окно по центру, рядом с объектом
			   $('#window_popup').css({'top' : $(this).scrollTop() + $('#window_popup').height()/4, 
				   					   'left': $(document).width()/2 - $('#window_popup').width()/2
				   								
			   });
			   var title = this.title;
			   $('#popup_title').html(title);
			   
			   $('#window_popup_content').html('<img id="img_loader" src="/images/loader/loader_small4.gif" />');
			   
			   $('#window_popup_content').load('/private_area/edit_profile');
			   $('#window_popup').show();
			   
			   return false;
			   
		});
	$('a#show_item')
		.live('click', function() {
			$('.background_popup').show();
			   
			   $('#window_popup').css({'top' : $(this).scrollTop() + $('#window_popup').height()/4, 
				   					   'left': $(document).width()/2 - $('#window_popup').width()/2
				   								
			   });
			   var title = this.title;
			   var trId = $(this).parents('tr').attr('id');
			   var itemId = trId.substr(trId.search('/')+1);

			   $('#popup_title').html(title);
			   $('#window_popup_content').html('<img id="img_loader" src="/images/loader/loader_small4.gif" />');
			   
			   $('#window_popup_content').load('itemInfoAjax/'+itemId, 
					   function(response, status, xhr) {
				   		if (status == "error") {
				   			var msg = "Sorry but there was an error: ";
				   			$("#window_popup_content").html(msg + xhr.status + " " + xhr.statusText);
				   		}
			   });
	   		   $('#window_popup').attr({
					'width':  50,
					'height': 50
							}).css({
					'position': 'absolute',
					'top' : $(document).height()/2, 
			   		'left': $(document).width()/2 - 300
		   		}).show();
			   
			   return false;
		});

	$('div#show_item_image')
		.live('click', function() {
		//$('.background_popup').show();
//decorator
var loader = '<img id="img_loader" src="/images/loader/loader_small4.gif" style="position: relative; top: -10px; left: 40px; z-index: 99; display: block; padding: 0; margin: 0;" />';
$('#window_popup_content').html(loader);
	

		   var title = $(this).next().children().attr('title');
		   var image = $(this).next().children().attr('src');
//		   Нам надо получить оригинал загруженного изображения, поэтому полученный путь до картинки разбираем по "/"
		   var image_as_array = image.split('/');
//		   Заменяя последний элемент массива, отсекая {[размер]_}		   
		   image_as_array[6] = image_as_array[6].substr(image_as_array[6].search('_')+1);
//		   Превращаем массив обратно в строку
		   image = image_as_array.join('/');
		   
		   $('#popup_title').html(title);

//         Загружаем картинку
		   var img = new Image();
		   $(img).load(function(){
		   	$('#window_popup_content').html(this);		   	
		   }).attr('src',image);
		   
//         Корректируем размеры окна
 		   $('#window_popup').attr({
				'width':  $(img).attr('width'),
				'height': $(img).attr('height')
							}).css({
				'position': 'absolute',
				'top' : $(document).height()/3, 
			   	'left': $(document).width()/3 
		   }).show();
//			Позиционируем окно
//			$(function(){
//				$('#window_popup').center().show();
//			});
//		   $('#window_popup').center().show();

		   return false;
		   
	});
});
//так как jquery это будет основной функцией 
var show_item_info = function(item, item_id) {
	
	//$('.background_popup').show();
	   
	   $('#window_popup').css({'top' : $(document).height()/4, 
		   					   'left': $(document).width()/4,
							   'width': '600px'		
	   });
	   var title = item.title;
	   $('#popup_title').html(title);
	   $('#window_popup_content').html('<img id="img_loader" src="/images/loader/loader_small4.gif" />');
	   
	   //не забыть: грузить 
	   $('#window_popup_content').load('/itemInfoAjax/'+item_id);
	   $('#window_popup').show();
	   
	   return false;
};