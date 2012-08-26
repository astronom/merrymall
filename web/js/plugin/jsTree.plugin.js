/**
 * 
 */
(function($){
	$.fn.showTree = function(o){
		var o = $.extend({
			closeFolders: false, // по умолчанию список раскрыт целиком
			classTree: null, // дополнительный класс для списка
			saveTree: false //сохраняет пользовательское дерево в куках и восстанавливает его 
		}, o);
		var treeIndex = '1';
		var i = 1;
		return $(this).each(function(){ // проходим по всем спискам
			var tree = $(this); // присваиваем переменной tree содержание текущего списка 
			tree.addClass('jquery-tree').children('li:first').prepend('<div class="first"></div>'); // добавляем класс по умолчанию и скрываем верхнюю линию в первом элементе списка
	       	        tree.children('li:last').addClass('last'); // для последнего элемента в списке добавляем класс last 
			tree.find('ul').each(function(){ // проходим по всем вложенным спискам
				$(this).children('li:last').addClass('last'); // для последнего элемента в каждом из них добавляем класс last
			}).prev('a').addClass('folder').attr('name', treeIndex); // добавляем класс folder каждой ссылке, за которой идёт вложенный список

			if (o.classTree) tree.addClass(o.classTree); // если есть пользовательский класс, добавляем его 
			tree.find('a.folder').before('<span class="show"></span>'); // добавляем кнопку показа/скрытия содержимого папки
			tree.find('span').click(openTree); // каждой кнопке по клику на неё ставим функцию openTree
			if (o.closeFolders) { // если содержимое списков должно быть скрыто
				tree.find('ul').hide(); // скрываем его
			} else {
				tree.find('.folder').addClass('open').prev('span').addClass('minus'); // иначе показываем что папки открыты
			}
        	});
		function openTree(){ // функция, показывающая/скрывающая содержимое папки
			var button = $(this); // присваиваем переменной button значение нажатой кнопки
		   	var link = button.next(); // находим ссылку
			var files = link.next('ul'); // находим вложенные файлы
			if (link.hasClass('open')) { // если папка открыта
				files.hide(); // скрываем файлы
			} else {
				files.show(); // иначе показываем
				setCookie('mmTree', 1, 3);	
			}
			link.toggleClass('open'); // переключаем классы у кнопки и папки 
			button.toggleClass('minus'); // если класса нет, добавляем, иначе - убираем
			return false; 
		}
	};
})(jQuery)
function setCookie(name,value,days) {
	if (days) {
		var date = new Date();
		date.setTime(date.getTime()+(days*24*60*60*1000));
		var expires = "; expires="+date.toGMTString();
	}
	else var expires = "";
	document.cookie = name+"="+value+expires+"; path=/";
}

function getCookie(name) {
	var nameEQ = name + "=";
	var ca = document.cookie.split(';');
	for(var i=0;i < ca.length;i++) {
		var c = ca[i];
		while (c.charAt(0)==' ') c = c.substring(1,c.length);
		if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
	}
	return null;
}

function deleteCookie(name) {
	createCookie(name,"",-1);
}