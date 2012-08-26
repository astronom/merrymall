<?php

class partnerLogoValidateFile extends sfValidatedFile {

  private $savedFilename = 'logo';

  // Override sfValidatedFile's save method
  public function save($file = null, $fileMode = 0666, $create = true, $dirMode = 0777) 
  {
    // Let the original save method do its magic :)
    return parent::save($this->savedFilename, $fileMode, $create, $dirMode);
  }
}
