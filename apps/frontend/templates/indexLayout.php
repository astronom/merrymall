<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
  <head>
    <?php include_http_metas() ?>
    <?php include_metas() ?>
    <?php include_title() ?>
    <link rel="shortcut icon" href="/favicon.ico" />
    <?php include_stylesheets() ?>
    <?php include_javascripts() ?>
    <script type="text/javascript">
      if ($.browser.msie && $.browser.version.substr(0,1)<7)
        window.location = "/ie6BrowserChoice";
    </script>


    <script type="text/javascript">
      var floor = 1;
      var floor_max = <?php echo $sf_request->getAttribute('floors_count')?>;

      $(function()
      {
        scrollBuildingToFloor(1);

        if($.browser.msie && $.browser.version.substr(0,3) == "6.0") {$(document).pngFix();}

        $("#tabloid > .mask").jCarouselLite(
        {
          speed: 1000,
          visible: 1,
          vertical: true,
          auto: 5000
        });

        //$('ul#ticker').liScroll();
        //scrollBuildingToFloor(floor_max, false);

        // on window resize - update building position
        $(window).resize(function ()
        {
          scrollBuildingToFloor(floor);
        });


        // building scrolling events
        $('.floor-block > a.fl').click(function()
        {
          floor_new = $(this).parent().attr('id').substr(6);
          if(floor_new != floor)
          {
            scrollBuildingToFloor(floor_new);
            return false;
          }
        });
      });

      function scrollBuildingToFloor(floor_new, animate)
      {
        $('#rmenu').trigger('floor_selected#rmenu', [ floor_new, floor_max ]);

        animate = typeof(animate) != 'undefined' ? animate : true;
        $('#floor-' + floor).removeClass('floor-selected');
        $('#floor-' + floor_new).addClass('floor-selected');

        floor = floor_new;
        if(floor > 1)
        {
          var h_fl = $('#building-layer').height() - $('#floor-' + floor).position().top;
          var h_md = $('body').height() / 3 * 2;
          var y = ((h_md - h_fl) < 0) ? (h_md - h_fl) : 0;
        }
        else
        {
          var y = 0;
        }

        if (animate)
          $('#building-layer').stop().animate({bottom: + y}, 1000);
        else
          $('#building-layer').css('bottom', y);
      }
    </script>
    <script type="text/javascript">
      var _gaq = _gaq || [];
      _gaq.push(['_setAccount', 'UA-17017834-1']);
      _gaq.push(['_setDomainName', '.merrymall.ru']);
      _gaq.push(['_trackPageview']);
      (function() {
        var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
      })();
    </script>
  </head>

  <body>

    <div id="wrapper">
      <?php echo $sf_content ?>
    </div><!-- #wrapper -->

  </body>
</html>