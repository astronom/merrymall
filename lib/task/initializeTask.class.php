<?php

class initializeTask extends sfBaseTask
{
  protected function configure()
  {
    // // add your own arguments here
    // $this->addArguments(array(
    //   new sfCommandArgument('my_arg', sfCommandArgument::REQUIRED, 'My argument'),
    // ));
    $this->addArgument('dbname', sfCommandArgument::REQUIRED, 'Database name');
    $this->addOption('leave-dev', null, sfCommandOption::PARAMETER_OPTIONAL, 'Don\'t remove dev controllers');
      //new sfCommandOption('connection', null, sfCommandOption::PARAMETER_REQUIRED, 'The connection name', 'doctrine'),
      // add your own options here

    $this->namespace        = 'project';
    $this->name             = 'initialize';
    $this->briefDescription = 'Initializes project after checkout from svn.';
    $this->detailedDescription = <<<EOF
The [initialize|INFO] task initializes project after its checkout.
Call it with:

  [php symfony initialize|INFO]
EOF;
  }

  protected function execute($arguments = array(), $options = array())
  {
    // initialize the database connection
//    $databaseManager = new sfDatabaseManager($this->configuration);
//    $connection = $databaseManager->getDatabase($options['connection'] ? $options['connection'] : null)->getConnection();
    // add your code here
    $this->runTask('project:permissions');

    $this->runTask('configure:database', array('mysql:host=localhost;dbname='.$arguments['dbname'],'root','snkEld23prsD8'), array('env' => 'prod'));
    $this->runTask('configure:database', array('mysql:host=localhost;dbname='.$arguments['dbname'],'root','snkEld23prsD8'), array('env' => 'dev'));

    if(!in_array('leave-dev', $options))
      $this->runTask('project:clear-controllers');

    // Удаляем текущую upload и ставим на ее место симлинк
    // Для этого сначала мочим все файлы в аплоаде
    $fileFinder = sfFinder::type('file')->ignore_version_control(false);
    $this->getFilesystem()->remove($fileFinder->in(sfConfig::get('sf_upload_dir')));
    // Потом все дирректории в аплоаде
    $dirFinder = sfFinder::type('dir')->ignore_version_control(false);
    $this->getFilesystem()->remove($dirFinder->in(sfConfig::get('sf_upload_dir')));
    // А потом и сам аплоад
    $this->getFilesystem()->remove(sfConfig::get('sf_upload_dir'));
    // И со спокойной душой ставим симлинк
    $this->getFilesystem()->symlink('/home/sale.merrymall/uploads', sfConfig::get('sf_upload_dir'));

    $this->runTask('project:permissions');
    $this->runTask('plugin:publish-assets');
    //$this->runTask('doctrine:build', --all');
    $this->runTask('cache:clear');
  }
}
