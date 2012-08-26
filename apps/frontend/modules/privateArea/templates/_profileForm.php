<?php include_stylesheets_for_form($form) ?>
<?php include_javascripts_for_form($form) ?>
<script>
/*$(function() {
$('form').submit(function() {
    var dataString = $(this).serialize();
    $.ajax({
        type: "POST",
        url: "/privateArea/updateProfile",
        data: dataString,
        success: function(data) {
                              $('#window_popup_content').html(data);
        },
        error: function(data) {
        	                  $('#window_popup_content').html(data);
        }

       });
    return false;
  });
});
var save_form = function() {
}*/
</script>
<form class="order-form" action="<?php echo url_for('@private_area_edit_profile')?>" method="POST">
    <fieldset>
      <?php echo $form ?>
      <br /><br />
      <button type="submit">Сохранить изменения</button>
      <button type="reset">Отмена</button>
    </fieldset>
</form>