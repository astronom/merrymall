<?php

class myUser extends sfGuardSecurityUser
{
  public function getUserFullName()
  {
    $userFullName = '';
    if($profile = $this->getProfile())
    {
      $userFullName = $profile->getLastName().' '.$profile->getFirstName().' '.$profile->getPatronymic();
    }
    // Если не одно из полей ФИО не заполнено возвращаем username [login]
    if(trim($userFullName) == '')
    {
      return $this->getUsername();
    }
    else
    {
      return $userFullName;
    }
  }
  public function getUserAge()
  {
    return  $this->getProfile()->getAge().' лет';
  }
  public function getUserCity()
  {
    return  $this->getProfile()->getAddress();
  }
  public function getUserEmail()
  {
    return  $this->getProfile()->getEmail();
  }
  public function getUserPhone()
  {
    return  $this->getProfile()->getPhone();
  }
  public function getIcq()
  {
    return  $this->getProfile()->getIcq();
  }
  public function getId() {

    if($this->isAuthenticated())
    {
      if($profile = $this->getProfile())
      {
        return $profile->getUserId();
      }
      else
      {
        $this->signInAnonymous();
        return $this->getId();
      }
    }
    else
    {
      return false;
    }
  }
  /**
   * Отвечает за создание и авторизацию анонимного пользователя
   *
   * @param Doctrine_Connection $con
   */
  public function signInAnonymous($con = null)
  {
    //create anonymous User
    $user = new sfGuardUser();
    $user->setUsername($this->generateAnonymousName('anonymous'));
    $user->setPassword('anonymous');
    $user->setIsActive(true);
    $user->setLastLogin(date('Y-m-d H:i:s'));
    $user->addGroupByName('anonymous');
    $user->save($con);

    $user->reloadGroupsAndPermissions();
    $user->loadGroupsAndPermissions();

    $userprofile = new sfGuardUserProfile();
    $userprofile->setUserId($user->getId());
    $userprofile->save();

    // signin
    $this->setAttribute('user_id', $user->getId(), 'sfGuardSecurityUser');
    $this->setAuthenticated(true);
    $this->clearCredentials();
    $this->addCredentials($user->getAllPermissionNames());

    $expiration_age = sfConfig::get('app_anonymous_cookie_expiration_age', 24 * 3600);

    $anonymous_cookie = sfConfig::get('app_anonymous_cookie_name', 'amAnonymousCustomer');
    sfContext::getInstance()->getResponse()->setCookie($anonymous_cookie, $user->getId(), time() + $expiration_age);

  }

  /**
   * Returns a random Anonymous name.
   *
   * @param string $preString The pre String
   * @param int $len The key length
   * @return string
   */
  protected function generateAnonymousName($preString = '',$len = 8)
  {
    $string = '';
    $pool   = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    for ($i = 1; $i <= $len; $i++)
    {
      $string .= substr($pool, rand(0, 61), 1);
    }

    return $preString.$string;
  }

  public function isAnonymous()
  {
    if(in_array('anonymous', $this->getCredentials()))
    {
      return true;
    }
    else
    {
      return !$this->isAuthenticated();
    }


  }

  /**
   * @see PluginsfGuardUser::getAllPermissions
   */
  public function getAllPermissions()
  {
    $this->refresh(true);
    return parent::getAllPermissions();
  }


  /**
   *
   * @see parent  sfGuardSecurityUser.class
   */
  public function signIn($user, $remember = false, $con = null)
  {
    //Если Аноним уже успел набросать в корзину и вишлист
    if($this->isAuthenticated()
    &&
    $this->hasCredential(array('anonymous')))
    {
      $anonymous_user_id = $this->getId();
      $cartlist = Doctrine::getTable('sCart')->findAllByUserId($anonymous_user_id);
      $wishlist = Doctrine::getTable('sWishlist')->findAllByUserId($anonymous_user_id);
    }

    $this->signOut();

    // signin
    $this->setAttribute('user_id', $user->getId(), 'sfGuardSecurityUser');
    $this->setAuthenticated(true);
    $this->clearCredentials();
    $this->addCredentials($user->getAllPermissionNames());

    // save last login
    $user->setLastLogin(date('Y-m-d H:i:s'));
    $user->save($con);

    // remember?
    if ($remember)
    {
      $expiration_age = sfConfig::get('app_sf_guard_plugin_remember_key_expiration_age', 15 * 24 * 3600);

      // remove old keys
      Doctrine::getTable('sfGuardRememberKey')->createQuery()
      ->delete()
      ->where('created_at < ?', date('Y-m-d H:i:s', time() - $expiration_age))
      ->execute();

      // remove other keys from this user
      Doctrine::getTable('sfGuardRememberKey')->createQuery()
      ->delete()
      ->where('user_id = ?', $user->getId())
      ->execute();

      // generate new keys
      $key = $this->generateRandomKey();

      // save key
      $rk = new sfGuardRememberKey();
      $rk->setRememberKey($key);
      $rk->setsfGuardUser($user);
      $rk->setIpAddress($_SERVER['REMOTE_ADDR']);
      $rk->save($con);

      // make key as a cookie
      $remember_cookie = sfConfig::get('app_sf_guard_plugin_remember_cookie_name', 'sfRemember');
      sfContext::getInstance()->getResponse()->setCookie($remember_cookie, $key, time() + $expiration_age);
    }

    if(isset($cartlist)&&isset($wishlist))
    {
      $user_id = $this->getId();

      if($cartlist->count())
      {
        foreach($cartlist as $cartItem)
        {
          $cartItem->setUserId($user_id)->save();
        }
      }

      if($wishlist->count())
      {
        foreach($wishlist as $wishItem)
        {
          $wishItem->setUserId($user_id)->save();
        }
      }
      //Удаляем Анонима из базы
      //      В некоторых вслучаях приводит к удалению пользователя, лучше пользоваться таской
      //      Doctrine::getTable('sfGuardUser')->createQuery()
      //      ->delete()
      //      ->where('id = ?', $anonymous_user_id)
      //      ->execute();
    }

    $expiration_age = sfConfig::get('app_anonymous_cookie_expiration_age', 24 * 3600);
    $anonymous_cookie = sfConfig::get('app_anonymous_cookie_name', 'amAnonymousCustomer');
    sfContext::getInstance()->getResponse()->setCookie($anonymous_cookie, $user->getId(), time() + $expiration_age);

//  Логиним игрока
    $this->signInGamer();

  }


  /**
   * Returns a random generated key.
   *
   * @param int $len The key length
   * @return string
   */
  protected function generateRandomKey($len = 20)
  {
    $string = '';
    $pool   = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    for ($i = 1; $i <= $len; $i++)
    {
      $string .= substr($pool, rand(0, 61), 1);
    }

    return md5($string);
  }

  /**
   * Signs out the user.
   *
   */
  public function signOut()
  {
    $this->getAttributeHolder()->removeNamespace('sfGuardSecurityUser');
    $this->user = null;
    $this->clearCredentials();
    $this->setAuthenticated(false);
    $expiration_age = sfConfig::get('app_sf_guard_plugin_remember_key_expiration_age', 15 * 24 * 3600);
    $remember_cookie = sfConfig::get('app_sf_guard_plugin_remember_cookie_name', 'sfRemember');
    sfContext::getInstance()->getResponse()->setCookie($remember_cookie, '', time() - $expiration_age);
  }

  // Game User

  /**
   * Логинит игрока
   * @param sfGuardSecurityUser $user
   */
  public function signInGamer()
  {
    //Если пользователь авторизован и не аноним
//    if($this->isAuthenticated() && !$this->hasCredential(array('anonymous')))
//    {
      if($gameAccount = Doctrine::getTable('mGameAccount')->findOneByUserId($this->getAttribute('user_id',null,'sfGuardSecurityUser')))
      {
        $this->setAttribute('game_account_id', $gameAccount->getId(), 'sfGuardSecurityUser');
      }
//    }

  }
  /**
   * Разлогинит игрока
   */
  public function signOutGamer()
  {
    $this->getAttributeHolder()->removeNamespace('sfGuardSecurityUser');
  }

  /**
   * Проверяет, является ли пользователь игроком
   *
   * @return boolean
   */
  public function isGamer()
  {
    return $this->hasAttribute('game_account_id','sfGuardSecurityUser');
  }
  // End Game User
}