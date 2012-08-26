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
                    <form action="<?php echo url_for2('sf_guard_reset_password',array('guid' => $guid)) ?>" method="post">


                      <table class="center guardform" cellspacing="0" cellpadding="0" align="center">
                        <tr>
                          <td class="ra1" colspan="2">Добро пожаловать, <?php echo $user ?>. Для завершения процедуры смены пароля введите дважды новый пароль в форму.</td>
                        </tr>
                        <tr>
                        	<td><?php echo $form ?></td>
                        </tr>
                        <tr>
                          <td class="ra2">&nbsp;</td>
                          <td class="ra6"><input type="image" src="/images/buttons/submit.gif" /></td>
                        </tr>
                      </table>

              </form>           </div>
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