<?php

/**
 * sImage
 *
 * This class has been auto-generated by the Doctrine ORM Framework
 *
 * @package    merrymall
 * @subpackage model
 * @author     Wronglink, Astronom <a.manichev@gmail.com>
 * @version    SVN: $Id: Builder.php 7021 2010-01-12 20:39:49Z lsmith $
 */
class sImage extends BasesImage
{
  public function getImageUrl()
  {
    if($this->getUrl()=='')
    {
    return sprintf('/uploads/company/%d/store_images/%d/%d.jpg', $this->getCompanyId(), $this->getId(), $this->getId());
    }
    else
    {
      return $this->getUrl();
    }
  }

  public function getImagePath()
  {
    return sprintf('%s/company/%d/store_images/%d/%d.jpg', sfConfig::get('sf_upload_dir'), $this->getCompanyId(), $this->getId(), $this->getId());
  }

  public function getThumbnailUrl($size = array())
  {
    $url = '';
    if($this->getUrl()=='')
    {
    $dir = sprintf('/uploads/company/%d/store_images/%d',$this->getCompanyId(), $this->getId());
    $file = sprintf('/%d_%d_%d.jpg',$this->getId(), $size['width'], $size['height']);
//    $firephp = FirePHP::getInstance(true);
//    $firephp->fb(sfConfig::get('sf_web_dir').$dir.$file);
//    if(file_exists(sfConfig::get('sf_web_dir').$dir.$file))
//    {
//     $url = $dir.$file;
//    }
//    else $url = sprintf('/images/c/item_default_%d_%s.jpg',$size['width'], $size['height']);
    $url = $dir.$file;
    }
    else $url = $this->getUrl();
    return $url;
//
//    switch ($size)
//    {
//      case 150:
//        //  По дефолту выводим нашу "заглушку" на товар для 150 px
//        $url = '/images/c/item_default.jpg';
//
//        {
//          $url = $file;
//        }
//        break;
//      case 60:
//        //  По дефолту выводим нашу "заглушку" на товар для 60 px
//        $url = '/images/item_default.png';
//
//        $file = sprintf('/uploads/company/%d/store_images/%d/60_%d.jpg', $this->getCompanyId(), $this->getId(), $this->getId());
//        if(file_exists(sfConfig::get('sf_web_dir').$file))
//        {
//          $url = $file;
//        }
//        break;
//    }
//    return $url;
  }

  public function getThumbnailPath($width = 150, $height = 140)
  {
    return sprintf('%s/company/%d/store_images/%d/%d_%d_%d.jpg', sfConfig::get('sf_upload_dir'), $this->getCompanyId(), $this->getId(), $this->getId(), $width, $height);
  }

  public function getThumbnailSavePath()
  {
    return sprintf('%s/company/%d/store_images/%d', sfConfig::get('sf_upload_dir'), $this->getCompanyId(), $this->getId());
  }

  public function isMain()
  {
    return ($this->getIsMain() == '1');
  }
}