<?xml version="1.0" encoding="UTF-8"?>
 <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
    <?php include_http_metas() ?>
    <?php include_metas() ?>
    <title><?php include_slot('title','Мерри Молл')?></title>
    <link rel="shortcut icon" href="/favicon.ico" />
    <?php include_stylesheets() ?>
    <?php include_javascripts() ?>
  </head>
  <body>
    <?php //include_partial('cart/miniCart', array('form' => $form)) ?>
    <?php include_component('pageParts','miniCart')?>
    <div id="page">
      <?php include_component('pageParts', 'header') ?>

      <?php echo $sf_content ?>

    <?php //include_component('pageParts','footer', array("floor_id" => $floor->getId(), 'floor_name' => $floor->getName(), 'floor_url' => $floor->getUrl()))?>
</div>
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
  </body>
</html>
