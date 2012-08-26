<?php //use_helper('I18N') ?>
<?php use_stylesheet('new/plugin/jQueryTools.form.css')?>
<style>
<!--
label { display: block; }
-->
</style>

<div id="page">
  <?php include_component('pageParts', 'header') ?>
             <div id="page_layout">
                <div class="layout_background"></div>
                <div id="page_content" class="">
                  <div class="page_content-top">
                    <a class="logo" href="<?php echo url_for('@homepage', true) ?>">
                      <?php echo image_tag('logo2.gif',array('alt_title'=>'На Главную')); ?>
                    </a>
                     <?php //include_component('pageParts', 'privateArea') ?>
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
                    <h1 class="title padL15">Восстановление пароля</h1>
		<form id="myform_register" class="order-form" action="<?php echo url_for('@sf_guard_restore_password') ?>" method="post">
			<fieldset>
			  <p>Для восстановления пароля укажите Логин или адрес электронной почты (E-mail)</p>
              <?php echo $form ?>
      		  <br />
      		  <br />
      		  <button type="submit">Восстановить пароль</button>
              <br /><br /><?php echo link_to('Зарегистрироваться', '@sf_guard_register')?>
    		</fieldset>
  		</form>
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
    <!-- Footer -->
        <div id="page_footer">

        </div>
    <!-- End Footer -->
</div>