<?php

class CheckBrowser extends sfTestBrowser
{
  public function loadData()
  {
    Doctrine::loadData(sfConfig::get('sf_test_dir').'/fixtures');

    return $this;
  }

  public function signin($username = 'astronom', $password = 'q1w2e3r4')
  {
    $this->
      info(sprintf('Signin user using username "%s" and password "%s"', $username, $password))->
      get('/login')->
      click('#submitButton', array('signin' => array('username' => $username,'password' => $password)))->

      with('response')->begin()->
        isRedirected()->
        isStatusCode(302)->
      end()->

      followRedirect()
      ;
    return $this;
  }
}