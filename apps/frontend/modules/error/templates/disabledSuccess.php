<?php use_stylesheet('404.css') ?>
<?php use_stylesheet('bubble.css') ?>
<script type="text/javascript">
  $(function()
  {
    $('#bubble').css({position: 'absolute',
      top: function(){ var bubbleTop = $('#hall-person-boy').position().top + 'px';
        return bubbleTop;},
      left: function(){ var bubbleWidth = $('#bubble').width();
        var bubbleLeft = ($('#hall-person-boy').position().left - bubbleWidth + 50) + 'px';
        return bubbleLeft;}
    });
  });
  $(function() {
    if($.browser.msie && $.browser.version.substr(0,3) == "6.0") {$(document).pngFix();}
  });
</script>
<div id="oporka">
	<div id="bubble" class="bubble">
		<table class="bubble-main" cellspacing="0" cellpadding="0">
		<tbody><tr><td class="bubble-top-left"></td><td class="bubble-top-center"></td><td class="bubble-top-right"></td></tr>
			<tr><td class="bubble-center-left"></td><td class="bubble-center-center">
				<div class="content404">
					<div class="error-code"></div>
					<div class="error-code-description">Данный раздел сайта временно не доступен</div>
					<div class="error-code-human-explain">Приглашаем вас вернуться в <a href="<?php echo url_for('@homepage', true) ?>">MerryMall</a>.</div>
				</div>
			</td><td class="bubble-center-right"></td></tr>
			<tr><td class="bubble-bottom-left"></td><td class="bubble-bottom-center"></td><td class="bubble-bottom-right"></td></tr>
		</tbody></table>
	</div>
	<div class="page404">
		<div class="logotip404">
		<a href="<?php echo url_for('@homepage', true) ?>">
		<img  src="/images/404/logotip.jpg" alt="MerryMall" />
		</a>
		</div>
		<div class="main404">
			<div id="hall-person-girl" class="girl404"><img src="/images/404/girl.png" alt="Merry" /></div>
			<div class="door404">
				<a href="<?php echo url_for('@homepage', true) ?>"><img class="door" src="/images/404/shop_enter.png" /></a>
				<a href="<?php echo url_for('@homepage', true) ?>"><img class="arrow" src="/images/404/arror_up.png" /></a>
			</div>
			<div id="hall-person-boy" class="boy404"><img src="/images/404/boy.png" alt="Merry" /></div>
		</div>
	</div>
</div>
