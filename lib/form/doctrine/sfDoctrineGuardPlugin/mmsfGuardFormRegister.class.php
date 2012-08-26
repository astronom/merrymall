<?php
class mmsfGuardFormRegister extends sfGuardFormRegister
{
  public function configure()
  {
    parent::configure();

    unset($this['id']);

    $this->getWidget('username')
          ->setAttributes(array(
           				  'pattern'  => '[a-zA-Z0-9]{3,128}',
                     	  'required' => 'required',
    ));
    $this->getWidget('password')->setAttributes(array('required' => 'required'));
    $this->getWidget('password2')->setAttributes(array('data-equals' => 'password'));
    $this->getWidget('email')->setOption('type', 'email');
    $this->getWidget('email')->setAttributes(array('required' => 'required'));

    $this->disableLocalCSRFProtection();

  }
}