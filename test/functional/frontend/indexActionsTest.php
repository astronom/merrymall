<?php
include(dirname(__FILE__).'/../../bootstrap/functional.php');

$browser = new CheckBrowser();

$browser->
  info('Index module is secured')->
  get('/')->
  with('response')->
    begin()->
    isStatusCode('401')->
  end()->
  
  signin()->
  get('/')->
  
  with('request')->begin()->
    isParameter('module','index')->
    isParameter('action','index')->
  end()->
  
  with('response')->begin()->
    info('1 - Checks if logo exists')->
    checkElement('#logo a img',true)->
  end()->

  info('1.1 - Logo leads to homepage')->
  click('#logo a')->
  
  with('request')->begin()->
    isParameter('module','index')->
    isParameter('action','index')->
  end()->
  
  with('response')->begin()->
    info('2 - Rmenu Exists')->
    checkElement('#rmenu')->
  end()
;