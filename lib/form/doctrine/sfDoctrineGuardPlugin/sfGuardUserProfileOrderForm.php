<?php
class sfGuardUserProfileOrderForm extends PluginsfGuardUserProfileForm
{
  public function configure()
  {
  	 
  	$this->useFields(array('firstname', 'phone'));
  	$this->widgetSchema->setLabels(array(
  	'firstname'   => 'Имя:',
  	'phone' 	  => 'Контактный телефон:',  	  	
));
	$this->getWidget('firstname')
	      ->setAttributes(array(
	                      'required' => 'required',
	                      'pattern'  => '[а-яА-Я ]{3,}'
	      ));
	$this->getWidget('phone')
	      ->setAttributes(array(
	                      'required' => 'required',
	                      'pattern'  => '[0-9\- ]{6,}'
	      ));	
    //Убираем случайные пробелы в начале и конце
	$this->getValidator('firstname')->setOption('trim', true);
    $this->getValidator('phone')->setOption('trim', true);
    
    
  }
}