<?php
/**
 * sfWidgetFormInput represents an HTML text input tag.
 *
 * @package    symfony
 * @subpackage widget
 * @author     Astronom
 * @version    SVN: $Id: sfWidgetFormInputText.class.php 20941 2009-08-08 14:11:51Z Kris.Wallsmith $
 */
class mmWidgetFormJQueryToolsInput extends sfWidgetFormInput
{
  /**
   * @param array $options     An array of options
   * @param array $attributes  An array of default HTML attributes
   *
   * @see sfWidgetForm
   */
  protected function configure($options = array(), $attributes = array())
  {
    parent::configure($options, $attributes);

    $this->setOption('type', 'text');
  }
}