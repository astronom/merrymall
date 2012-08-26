<?php

class amThumbnailPluginTask extends sfBaseTask
{
  public $counter = 0;

  protected function configure()
  {
    // // add your own arguments here
    $this->addArguments(array(
    new sfCommandArgument('width', sfCommandArgument::REQUIRED, 'Width of new image'),
    new sfCommandArgument('height', sfCommandArgument::REQUIRED, 'Height of new image'),
    new sfCommandArgument('company', sfCommandArgument::REQUIRED, 'Url OR Id of company'),
    ));

    $this->addOptions(array(
    new sfCommandOption('quality',null ,sfCommandOption::PARAMETER_REQUIRED, 'Quality of new image', 60),
    new sfCommandOption('db-modified', null, sfCommandOption::PARAMETER_OPTIONAL, 'Modify db', false),
    new sfCommandOption('connection', null, sfCommandOption::PARAMETER_REQUIRED, 'The connection name', 'doctrine'),
    new sfCommandOption('env', null, sfCommandOption::PARAMETER_REQUIRED, 'The environment', 'dev'),
    new sfCommandOption('only-resize', null, sfCommandOption::PARAMETER_OPTIONAL, 'Set to true if only resize images', false),
    ));

    $this->namespace        = 'thumbnail';
    $this->name             = 'create-images';
    $this->briefDescription = 'Creates thumbnail images according to size from source';
    $this->detailedDescription = <<<EOF
The [thumbnail:create-images|INFO] Creates thumbnail images according to size from source.

	[./symfony thumbnail:create-images|INFO]
EOF;
  }

  protected function execute($arguments = array(), $options = array())
  {

    $databaseManager = new sfDatabaseManager($this->configuration);

    if(is_int($arguments['company']))
    {
      $company = Doctrine::getTable('Company')->findOneById($arguments['company']);
    }
    elseif(is_string($arguments['company']))
    {
      $company = Doctrine::getTable('Company')->findOneByUrl($arguments['company']);
    }

    if(!is_object($company))
    {
      $this->logSection('There is no company with Url or Id', $arguments['company']);
      die;
    }
    else $companyId = $company->getId();

    $companyImages = Doctrine::getTable('sImage')->getAllCompanyImagesQuery($companyId);
    $companyRemoteImages = Doctrine::getTable('sImage')->getRemoteCompanyImagesQuery($companyId);

    $countAllCompanyImages = $companyImages->count();
    $countRemoteCompanyImages = $companyRemoteImages->count();

    $this->logSection('all images found: ', $countAllCompanyImages);
    $this->logSection('remote images found: ', $countRemoteCompanyImages);

    $storeImagesDir = sfConfig::get('sf_upload_dir').'/company/'.$companyId.'/store_images/';
    if(!is_dir($storeImagesDir))
    {
      mkdir($storeImagesDir, 0777);
      $this->logSection('store images dir created', $storeImagesDir);
    }


    if($countRemoteCompanyImages > 0 && !($options['only-resize'])) {

      $this->log('download remote images');

      if($options['db-modified'])
      {
        $this->log('image url in database will be set to NULL');
      }
      foreach ($companyRemoteImages->execute() as $remoteImage)
      {
          if($remoteImage->getUrl() != '') {
            $thumbnail = new sfThumbnail();
            try {
              $thumbnail->loadFile($remoteImage->getUrl());
            }
            catch (Exception $e) {
              $this->logSection('image can not be download. Error: ', $e->getMessage());
              continue;
            }

            if(!is_dir($remoteImage->getThumbnailSavePath()))
            {
              mkdir($remoteImage->getThumbnailSavePath(), 0777);
            }
            $thumbnail->save($remoteImage->getThumbnailSavePath().'/'.$remoteImage->getId().'.jpg', 'image/jpeg');

            if($options['db-modified'])
            {
              $remoteImage->setUrl(NULL);
              $remoteImage->save();
            }
        }
      }
      $this->log('download complete');
    }

    $dirFinder = sfFinder::type('dir')
    ->ignore_version_control(true)
    ->in($storeImagesDir);

    $this->log('start resizing');

    foreach($dirFinder as $dir)
    {
      $imagesFinder = sfFinder::type('file')
      ->ignore_version_control(true)
      ->not_name('*_*.jpg')
      ->in($dir);
      foreach($imagesFinder as $image)
      {
        $thumbnail = new sfThumbnail($arguments['width'], $arguments['height'], true, true, $options['quality']);
        $thumbnail->loadFile($image);
        $thumbnail->save(str_replace('.jpg','_'.$arguments['width'].'_'.$arguments['height'].'.jpg',$image), 'image/jpeg');
      }

    }
    $this->log('resizing complete');

    $this->log('complete all');

  }

}
