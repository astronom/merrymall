<?php

class mmWidgetFromHtmlRow extends sfWidgetForm
{
  protected function configure($options = array(), $attributes = array())
  {
    $this->addOption('html');
    parent::configure($options, $attributes);
  }

  public function render($name, $value = null, $attributes = array(), $errors = array())
  {
    return $this->getOption('html');
  }
}