<?php

require_once dirname(__FILE__).'/../lib/vendor/symfony/lib/autoload/sfCoreAutoload.class.php';
sfCoreAutoload::register();

class ProjectConfiguration extends sfProjectConfiguration
{
  public function setup()
  {
    $this->enablePlugins('sfDoctrinePlugin');
    $this->enablePlugins('sfDoctrineGuardPlugin');
    $this->enablePlugins('csDoctrineActAsSortablePlugin');
    $this->enablePlugins('sfFirePHPPlugin');
    $this->enablePlugins('sfThumbnailPlugin');
    $this->enablePlugins('sfJqueryReloadedPlugin');
    //$this->enablePlugins('mGamePlugin');
    $this->enablePlugins('sfWebBrowserPlugin');
    $this->enablePlugins('sfPhpExcelPlugin');

    //Подключаем дополнительные функции для панели отладки
//    $this->dispatcher->connect('debug.web.load_panels', array(
//    	'amWebDebugPanelDocumentation',
//    	'listenToLoadDebugWebPanelEvent'
//    ));
  }
}
