<?php use_helper('I18N') ?>

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
              <form action="<?php echo url_for('@sf_guard_register') ?>" method="post">
                <table id="centerform" cellspacing="0" cellpadding="0">
                  <tr>
                    <td class="cr4">
                      <h1 class="title padL15">Подтверждение регистрации</h1>
                      <div class="info">Ошибка. Данный код подтверждения не связан ни с одним пользователем.</div>
                    </td>
                  </tr>
                </table>
              </form>       </div>
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