<?php
class mmRouting extends sfPatternRouting
{
  public function initialize(sfEventDispatcher $dispatcher, sfCache $cache = null, $options = array())
  {
    $options['context']['prefix'] = isset($options['prefix']) ? $options['prefix'] : '';
    parent::initialize($dispatcher, $cache, $options);
  }

  public function getRouteThatMatchesUrl($url)
  {
    if(isset($this->options['context']['prefix']))
    {
      $url = substr($url, strlen($this->options['context']['prefix']));
    }
    if($url == '')
    {
      $url = '/';
    }
    return parent::getRouteThatMatchesUrl($url);
  }
}