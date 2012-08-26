<?php
class mmWidgetFormJQueryToolsDateInput extends sfWidgetFormInput
{
  public function getStylesheets()
  {
    // the array keys are files and values are the media names
    // separated by a colon (,)
    return array('/css/new/plugin/jQueryTools.dateinput.css' => 'all');
  }

  public function getJavaScripts()
  {
    return array('http://cdn.jquerytools.org/1.2.5/form/jquery.tools.min.js');
  }

  public function render($name, $value = null, $attributes = array(), $errors = array())
  {
    $input = parent::render($name, $value, $attributes, $errors);
    $js = sprintf(<<<EOF
<script type="text/javascript">
  $(function()
  {
$.tools.dateinput.localize("ru", {
   months: 'Январь,Февраль,Март,Апрель,Май,Июнь,Июль,Август,Сентябрь,Октябрь,Ноябрь,Декабрь',
   shortMonths:  'Jan,Feb,Mar,Apr,May,Jun,Jul,Aug,Sep,Oct,Nov,Dec',
   days:         'Воскресенье,Понедельник,Вторник,Среда,Четверг,Пятница,Суббота',
   shortDays:    'Вс,Пн,Вт,Ср,Чт,Пт,Суб'
});
	$('#%s').dateinput({
	lang: 'ru', 
	format: 'dd.mm.yyyy',
	firstDay: 1
	});
  });
</script>
EOF
    ,
    $this->generateId($name));

    return $js.$input;
  }
}