<?php
class mailComponents extends sfComponents
{
  private $messages = Array('orderSet' => 'Спасибо за покупку', 'register' => 'Спасибо за регистрацию');
  
  public function executeFooter()
  {
  }

  public function executeHeader()
  {
  }

  public function executeBody()
  {
    $this->header_mesage = $this->messages[$this->getVar('partial')];
    $this->partial = $this->getVar('partial');
    $this->vars = $this->getVar('vars');
  }
}