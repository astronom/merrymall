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
                    <h1 class="title padL15">Восстановление пароля</h1>
                      <script type="text/javascript">
                        var sec = 6;
                        var redirect = '<?php echo url_for('@homepage') ?>';
                        var display_selector = '#countdown';

                        function countdown_redirect()
                        {
                          if(sec == 0)
                          {
                            location.replace(redirect);
                          }
                          else
                          {
                            sec--;
                            $(display_selector).html(rus_time(sec));
                            setTimeout(countdown_redirect, 1000);
                          }
                        }

                        function rus_time(s)
                        {
                          e = '';
                          if (!((s > 10) && (s < 20)))
                          {
                            x = s % 10;
                            if (x == 1)
                              e = 'у';
                            else if ((x == 2) || (x == 3) || (x == 4))
                              e = 'ы';
                          }
                          return sec + ' секунд' + e;
                        }

                        $(function()
                        {
                          countdown_redirect()
                        });
                      </script>
                      <div class="info">Вы успешно изменили пароль и будете перемещены на <?php echo link_to('главную страницу', '@homepage') ?> через <span id="countdown">5 секунд</span>.</div>
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