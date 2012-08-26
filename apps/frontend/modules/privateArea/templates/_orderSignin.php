<script>
$(function() {
	$("ul#order_form_user").tabs("div.panes > div");
	var api = $("ul#order_form").data("tabs");
	$("#myform_signin").validator({ lang: 'ru' }).submit(function(e) {
		submitForm($(this),e);
		});
	$.tools.validator.fn("[data-equals]", "Повторите пароль в точности", function(input) {
		var name = input.attr("data-equals"),
			 field = this.getInputs().filter("[name *=" + name + "]");
		return input.val() == field.val() ? true : [name]; 
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
							api.next();

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

<ul id="order_form_user" class="tabs">
	<li><a href="#">Авторизация</a></li>
	<li><a href="#">Регистрация</a></li>
</ul>
<div class="panes">
	<div>
		<form id="myform_signin" class="order-form" action="<?php echo url_for('@sf_guard_signin') ?>" method="post">
    		<fieldset>
    		    <?php echo $userForm ?>
    		    <br />
      			<button type="submit">Войти</button>
      			<button type="reset">Сбросить</button>
      			<br />
      			<a href="<?php echo url_for('@sf_guard_restore_password') ?>">Забыли пароль?</a>
      			<a href="<?php echo url_for('@sf_guard_register') ?>">Регистрация</a>
		    	</fieldset>
  		</form>
	</div>
	<div>
		<form id="myform_register" class="order-form" action="<?php echo url_for('@sf_guard_register') ?>" method="post">
			<fieldset>
              <?php echo $registerForm ?>
      		  <br />
      		  <br />	
      		  <button type="submit">Зарегистрироваться</button>
      		  <button type="reset">Сбросить</button>
<!--      Внимание, поля, отмеченные символом <span class="blue">*</span><br>являются обязательными для заполнения.-->
    		</fieldset>
  		</form>
	</div>
</div>
