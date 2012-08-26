<?php

include(dirname(__FILE__).'/../../bootstrap/functional.php');

$browser = new CheckBrowser();

$browser->
  info('The admin side is secured')->
  get('/')->
  with('response')->
    begin()->
    isStatusCode(401)->
  end()->
  signin()->
  get('/')->
  with('request')->begin()->
    isParameter('module', 'index')->
    isParameter('action', 'index')->
  end()->
  info('The actions use the standard sfDoctrineGuardPlugin, they don\'t need to be tested')
  ;  
  
//$browser->  
//  info('2 - Upload Some File')->
//  get('/index')->
//  
//  with('request')->begin()->
//    hasCookie('merrymall')->
//  end();
//  checkElement('form', '!/Form exist/')->
//  click('Загрузить', array('s_file' => array(
//  'filename' => sfConfig::get('sf_data_dir').'/tenantryFiles/test.xlsx',
//  'comment'  => 'Тестовый каталог'
//  )))->
//  
//  with('request')->begin()->
//    isParameter('module', 'index')->
//    isParameter('action','index')->
//  end()  
//;
