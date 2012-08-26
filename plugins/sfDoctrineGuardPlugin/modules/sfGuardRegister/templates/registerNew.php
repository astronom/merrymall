<?php use_helper('I18N') ?>
<?php use_stylesheet('new/plugin/jQueryTools.form.css')?>
<?php use_javascript('http://cdn.jquerytools.org/1.2.5/full/jquery.tools.min.js')?>
<style>
<!--
label { display: block; }
-->
</style>
<script>
$(function() {
	$.tools.validator.localize("ru", {
		'*'			    : 'Недопустимые символы',
		'[min]'	 		: 'Минимальное количество символов: $1',
		'[max]'	 		: 'Максимальное количество символов: $1',
		'[required]'	: 'Поле обязательно к заполнению',
		':email'		: 'Введите корректный адрес электронной почты',
		'[data-equals]' : 'Повторите пароль в точности'
	});

	$("#myform_register").validator({ lang: 'ru' }).submit(function(e) {
		submitForm($(this),e);
		});

/*	$.tools.validator.fn("[data-equals]", "Повторите пароль в точности", function(input) {
		var name = input.attr("data-equals"),
			 field = this.getInputs().filter("[name *=" + name + "]");
		return input.val() == field.val() ? true : [name];
	});
*/
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
							form.hide()
							.parent('div')
							.append('<div class="notice" style="width: 95%; margin: 15px;"><p>Благодарим за регистрацию. Вам на почту отправлено письмо с дальнейшими инструкциями</p></div>');
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
});
</script>

<div id="page">
  <?php include_component('pageParts', 'header') ?>
             <div id="page_layout">
                <div class="layout_background"></div>
                <div id="page_content" class="">
                  <div class="page_content-top">
                    <a class="logo" href="<?php echo url_for('@homepage', true) ?>">
                      <?php echo image_tag('logo2.gif',array('alt_title'=>'На Главную')); ?>
                    </a>
                    <div id="register-now">
                    <?php echo image_tag('/images/registernow470x60.gif', array('alt_title' => 'Зарегистрируйся сейчас и участвую в розыгрыше приза в день открытия')) ?>
                    </div>
                  </div>
                <div class="rounded-box-10">
                    <b class="r10 white"></b>
                    <b class="r9 blr"></b>
                    <b class="r7 blr"></b>
                    <b class="r5 blr"></b>
                    <b class="r4 blr"></b>
                    <b class="r3 blr"></b>
                    <b class="r2 blr"></b>
                    <b class="r2 blr"></b>
                    <b class="r1 blr"></b>
                    <b class="r1 blr"></b>
                    <b class="r1 blr"></b>
                    <div class="content">
                      <h1 class="title padL15">Регистрация</h1>
	<div>
		<form id="myform_register" class="order-form" action="<?php echo url_for('@sf_guard_register') ?>" method="post">
			<fieldset>
              <?php echo $form ?>
      		  <br />
      		  <br />
      		  <button type="submit">Зарегистрироваться</button>
      		  <button type="reset">Отменить</button>
<!--      Внимание, поля, отмеченные символом <span class="blue">*</span><br>являются обязательными для заполнения.-->
               <br /><br /><?php echo link_to('Забыли пароль?', '@sf_guard_restore_password')?>
    		</fieldset>
  		</form>

	</div>
                    </div>
                    <b class="r1 blr"></b>
                    <b class="r1 blr"></b>
                    <b class="r1 blr"></b>
                    <b class="r2 blr"></b>
                    <b class="r2 blr"></b>
                    <b class="r3 blr"></b>
                    <b class="r4 blr"></b>
                    <b class="r5 blr"></b>
                    <b class="r7 blr"></b>
                    <b class="r10 white"></b>
                </div>
            </div>
        </div>
        <div id="page_footer">
        </div>
</div>