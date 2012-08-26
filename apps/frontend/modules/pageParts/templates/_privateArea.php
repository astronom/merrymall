<?php use_javascript('plugin/fancybox/jquery.fancybox-1.3.4.pack.js')?>
<?php use_javascript('http://cdn.jquerytools.org/1.2.5/form/jquery.tools.min.js')?>
<?php use_javascript('plugin/JQueryTools/validator.ru.js')?>
<?php use_stylesheet('new/plugin/jQueryTools.form.css')?>
<script type="text/javascript">
<!--
$(function()
		  {
$("#login_form").validator({ lang: 'ru', position: 'top center' }).submit(function(e) {
	submitForm($(this),e);
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
						$('#user-info').html(json['user']);
						get_user_cart('<?php echo url_for('@cart_full') ?>');

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
//Магия подсказок для формы логина
//var currentValue;
//var changed = new Array();
//$('#login_form > fieldset').children('input[type!=checkbox]')
//	.bind({
//		focusin:  function(){
//					currentValue = $(this).val();
//					if(!changed[$(this).attr('name')])
//					{
//						$(this).val('');
//					}
//				   },
//		focusout: function(){
//					if(!changed[$(this).attr('name')])
//					{
//						$(this).val(currentValue);
//					}
//				  },
//		change:   function(){
//					changed[$(this).attr('name')] = true;
//				  }
//	});
});


//-->
</script>
<div class="user-info<?php echo $userCssClass ?>">
<?php if(!$sf_user->isAnonymous()): ?>
<img src="/images/icons/user_16x16.png" alt="" />
<a href="<?php echo url_for('@private_area')?>" title="Перейти в личный кабинет">
<?php echo $sf_user->getUserFullName() ?>
</a>
<?php //include_partial('mGameButton/gameAccount') ?>
<?php echo jq_link_to_remote(image_tag('/images/icons/delete_16x16.png',array('alt'=>'Выйти'))
                            , array(
                            'url' => '@sf_guard_signout',
                            'method' => 'POST',
                            'success' => '$("#user-info").html(data); clean_cart({"success": true});'

                            )
                            , array(
                            'class' => 'user-quit',
                            'title' => 'Выйти',
                            'href'  => url_for('@sf_guard_signout'))
)
 ?>
<?php else: ?>
<?php echo form_tag('@sf_guard_signin',array('class' => 'login-form','id' => 'login_form'))?>
<fieldset>
    <?php echo $form['username']->render(); ?>
    <?php echo $form['username']->renderError(); ?>

    <?php echo $form['password']->render(); ?>
    <?php echo $form['password']->renderError(); ?>

    <?php echo $form['remember']->render(); ?>
    <?php echo $form['remember']->renderLabel(); ?>

    <?php echo $form->renderHiddenFields(); ?>
  <div class="enter-row">
    <a id="button-register" title="Регистрация пользователя MerryMall" href="<?php echo url_for('@sf_guard_register', array('ajax' => false)) ?>">регистрация</a>
    <input type="image" src="/images/buttons/enter.gif" alt="вход" />
  </div>
</fieldset>
</form>
<?php endif; ?>
<script  type="text/javascript" src="http://yandex.st/share/share.js" charset="utf-8"></script>
<div class="yashare-auto-init" data-yashareType="button" data-yashareQuickServices="yaru,vkontakte,facebook,twitter,odnoklassniki,moimir"></div> </div>