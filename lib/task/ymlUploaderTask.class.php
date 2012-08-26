<?php

class ymlUploaderTask extends sfBaseTask
{
  protected function configure()
  {
    // // add your own arguments here
    // $this->addArguments(array(
    //   new sfCommandArgument('my_arg', sfCommandArgument::REQUIRED, 'My argument'),
    // ));

    $this->addOptions(array(
      new sfCommandOption('application', null, sfCommandOption::PARAMETER_REQUIRED, 'The application name'),
      new sfCommandOption('env', null, sfCommandOption::PARAMETER_REQUIRED, 'The environment', 'dev'),
      new sfCommandOption('connection', null, sfCommandOption::PARAMETER_REQUIRED, 'The connection name', 'doctrine'),
      // add your own options here
    ));

    $this->namespace        = 'project';
    $this->name             = 'yml-upload';
    $this->briefDescription = 'Parse and load YML Files';
    $this->detailedDescription = <<<EOF
The [ymlUploader|INFO] task does things.
Call it with:
project:yml-upload
  [php symfony ymlUploader|INFO]
EOF;
  }

  protected function execute($arguments = array(), $options = array())
  {
    // initialize the database connection
    $databaseManager = new sfDatabaseManager($this->configuration);
    $connection = $databaseManager->getDatabase($options['connection'])->getConnection();
    
    $filename = 'Z:/merrymall/web/uploads/company/39/store_cataloge/2010-12-03.xml';
    $parser = new ymlParser($filename,'39');
    $parser->insertCategories();
    unset($parser);
  }
}
