<?php
class WidgetFormWYSIWYG extends sfWidgetFormTextarea
{
  public function getStylesheets()
  {
    // the array keys are files and values are the media names
    // separated by a colon (,)
    return array('/css/wysiwyg.css' => 'all');
  }

  public function getJavaScripts()
  {
    return array('/js/plugin/wysiwyg.js');
  }

  public function render($name, $value = null, $attributes = array(), $errors = array())
  {
    $textarea = parent::render($name, $value, $attributes, $errors);
    $js = sprintf(<<<EOF
<script type="text/javascript">
  $(function()
  {
    $('#%s').wysiwyg();
  });
</script>
EOF
    ,
    $this->generateId($name));

    return $js.$textarea;
  }
}
