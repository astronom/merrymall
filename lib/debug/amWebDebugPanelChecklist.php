<?php

/**
 * Symfony Deployment Checklist web debug panel
 *
 * @package     amWebDebug
 * @subpackage  debug
 * @author      Ryan Weaver <ryan@thatsquality.com>, Astronom <a.manichev@gmail.com>
 * @link        http://symfony-check.org/
 * @since       2009-10-24
 * @update     2010-08-27
 * @version     svn:$Id$ $Author$
 */
class amWebDebugPanelChecklist extends sfWebDebugPanel
{
  public static function listenToLoadDebugWebPanelEvent(sfEvent $event)
  {
    $event->getSubject()->setPanel(
    	'checklist',
    new self($event->getSubject())
    );
  }
  
  protected $checkList = array(
  1   => 'Customize the "Oops! Page Not Found page',
  2   => 'Customize the "Oops! An Error Occurred" page',
  3   => 'Customize the "Login Required" page',
  4   => 'Customize the "Credentials Required" page',
  5   => 'Customize the "This Module is Unavailable" page',
  6   => 'Customize the "Website Temporarily Unavailable" page',
  7   => 'Add a favicon',
  8   => 'Change the cookie names',
  9   => 'Check the configuration of the production server',
  10  => 'Customize the language of your pages',
  11  => 'Delete  "/backend.php/" from your uri',
  12  => 'Install a PHP Accelerator',
  19  => 'Optimize Apache: avoid .htaccess',
  13  => 'Log errors in the production environment',
  14  => 'Customize rsync_exclude.txt',
  15  => 'Escape your templates',
  16  => 'Protect your forms',
  17  => 'Redirect to the unavailable screen during the maintenance operations',
  18  => 'Optimize your routes',
  19  => 'Remove .htaccess when possible',
  20  => 'Protect yourself against user uploaded files',

  );

  /**
   * @see sfWebDebugPanel
   */
  public function getTitle()
  {
    return '<img src="/images/debug/check.png" alt="Symfony Deployment Checklist" height="16" width="16" /> checklist';
  }

  /**
   * @see sfWebDebugPanel
   */
  public function getPanelTitle()
  {
    return 'Symfony Deployment Checklist';
  }

  /**
   * Iterates through all of the steps and attempts to determine if each
   * is completed, incomplete, or unknown. Finally outputs the correct
   * contents based on these tests
   *
   * @see sfWebDebugPanel
   */
  public function getPanelContent()
  {
    $content = '';
    foreach($this->checkList as $num => $item)
    {
      $url = 'http://symfony-check.org/#todo' . $num;
      //Todo list
      $content .= sprintf('<tr><td style="width: 20px;" valign="middle">%s</td><td><h3 style="margin: 3px;"><a href="%s" title="%s" style="color: #0397D6;" target="_blank">%s</a></h3></td><td>%s</td></tr>
      						<tr><td colspan="3"><div id="check'.$num.'" style="display: none;">%s</div></td></tr>',
      $this->getCheckIcon($num),
      $url,
      $url,
      $item,
      $this->getToggler('check'.$num, $item),
      $this->getCheckInfo($num)
      );
    }

    $header = sprintf('
      <h2><a href="http://symfony-check.org" target="_blank">http://symfony-check.org</a></h2>
      The symfony deployment checklist, provided by 
      <a href="http://ui-studio.fr/">UI Studio</a> is a great way to make
      sure you\'ve got everything prepared before going to production. This
      panel attempts to determine which of the following items have been completed.
      <ul><li>%s means complete</li><li>%s means incomplete</li><li>%s means
      that it cannot be determined automatically</li></ul><hr/>',
    $this->getColorSpan(true),
    $this->getColorSpan(false),
    $this->getColorSpan(null)
    );
    
    //Some styles
    $content .= '
    	<style type="text/css">
    	pre {
				-moz-border-radius:3px 3px 3px 3px;
				background-color:#E0E0E0;
				margin:1em 0;
				padding:1em;
		}
    	</style>';
    return sprintf('%s<table>%s</table>', $header, $content);
  }

  /**
   * Determines whether the given step number should be given a check
   * for "complete", "incomplete", or "unknown"
   *
   * @param   integer $num  The step number to check
   *
   * @return  string  The Y, X or ? with correct markup for color
   */
  protected function getCheckIcon($num)
  {
    $method = 'isChecked'.$num;

    if (method_exists($this, $method))
    {
      $ret = $this->$method();
    }
    else
    {
      $ret = null;
    }

    return $this->getColorSpan($ret);
  }

  /**
   * Returns the colored span that relates to either a "yes", "no" or "unknown"
   *
   * @param boolean $status true, false or null for "yes", "no" or "unknown"
   */
  protected function getColorSpan($status)
  {
    if ($status === true)
    {
      $txt = 'Y';
      $color = 'darkgreen';
    }
    elseif ($status === false)
    {
      $txt = 'X';
      $color = 'darkred';
    }
    else
    {
      $txt = '?';
      $color = 'lightblue';
    }

    return sprintf('<span style="color: %s; font-weight: bold; font-size: 1.2em;">%s</span>', $color, $txt);
  }
   
  /*
   * Reterns the info of the check function, readed from data/checklist/check$num.html
   *
   * @param $num integer The step number to checkInfo
   * 
   * @return string
   *
   */

  protected function getCheckInfo($num)
  {
    
    $path = sfConfig::get('sf_data_dir').'/checklist/check'.$num.'.html';     
    return file_get_contents($path);
  }

  /*
   ************** Is-Checked functions
   */


  /*
   * Determines if the error404 page has been customized or not
   *
   * @return boolean
   */
  protected function isChecked1()
  {
    return (
    sfConfig::get('sf_error_404_module') != 'default'
    || sfConfig::get('sf_error_404_action') != 'error404'
    || file_exists(sfConfig::get('sf_app_module_dir') . '/default/templates/error404Success.php')
    );
  }

  /*
   * Determines if the error500 page has been customized or not
   *
   * @return boolean
   */
  protected function isChecked2()
  {
    return (file_exists(sfConfig::get('sf_app_config_dir').'/error/error.html.php') || file_exists(sfConfig::get('sf_config_dir').'/error/error.html.php'));
  }

  /*
   * Determines if the login page has been customized
   *
   * @return boolean
   */
  protected function isChecked3()
  {
    return (
    sfConfig::get('sf_login_module') != 'default'
    || sfConfig::get('sf_login_action') != 'login'
    || file_exists(sfConfig::get('sf_app_module_dir') . '/default/templates/loginSuccess.php')
    );
  }

  /*
   * Determines if the login page has been customized
   *
   * @return boolean
   */
  protected function isChecked4()
  {
    return (
    sfConfig::get('sf_secure_module') != 'default'
    || sfConfig::get('sf_secure_action') != 'secure'
    || file_exists(sfConfig::get('sf_app_module_dir') . '/default/templates/secureSuccess.php')
    );
  }

  /*
   * Determines if the module disabled page has been customized
   *
   * @return boolean
   */
  protected function isChecked5()
  {
    return (
    sfConfig::get('sf_module_disabled_module') != 'default'
    || sfConfig::get('sf_module_disabled_action') != 'disabled'
    || file_exists(sfConfig::get('sf_app_module_dir') . '/default/templates/disabledSuccess.php')
    );
  }

  /*
   * Determines if the "unavailable" / project-disabled page has been customized
   *
   * @return boolean
   */
  protected function isChecked6()
  {
    return (file_exists(sfConfig::get('sf_app_config_dir').'/error/unavailable.php') || file_exists(sfConfig::get('sf_config_dir').'/unavailable.php'));
  }

  /*
   * Determines if a favicon exists
   *
   * @return boolean
   */
  protected function isChecked7()
  {
    return (file_exists(sfConfig::get('sf_web_dir').'/favicon.ico'));
  }

  /*
   * Determines if the cookie name has been changed
   *
   * @return boolean
   */
  protected function isChecked8()
  {
    $options = sfContext::getInstance()->getStorage()->getOptions();

    return ($options['session_name'] != 'symfony');
  }

  /*
   * Determines if logging is enabled in production
   *
   * This one is definitely not an exact science.
   *
   * @return boolean
   */
  protected function isChecked13()
  {
    $settings = sfYaml::load(sfConfig::get('sf_app_config_dir') . '/settings.yml');

    // check for logging_enabled in settings.yml
    if (isset($settings['prod']) && isset($settings['prod']['.settings']) && isset($settings['prod']['.settings']['logging_enabled']) && !$settings['prod']['.settings']['logging_enabled'])
    {
      return false;
    }

    $factories = sfYaml::load(sfConfig::get('sf_app_config_dir') . '/factories.yml');

    if (!isset($factories['prod']) || !isset($factories['prod']['logger']) || empty($factories['prod']['logger']) || $factories['prod']['logger']['class'] == 'sfNoLogger')
    {
      return false;
    }

    return true;
  }

  /*
   * Determines if output escaping is on or not
   *
   * @return boolean
   */
  protected function isChecked15()
  {
    return (sfConfig::get('sf_escaping_strategy'));
  }

  /*
   * Determines if csrf_protection is enabled
   *
   * @return boolean
   */
  protected function isChecked16()
  {
    $form = new sfForm();

    return ($form->isCSRFProtected());
  }

  /*
   * Determines if check_locks is on
   *
   * @return boolean
   */
  protected function isChecked17()
  {
    return (sfConfig::get('sf_check_lock'));
  }

}
