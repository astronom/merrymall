<?php

class PriceValidatedFile extends sfValidatedFile {

  private $savedFilename = null;

//  public function __construct($originalName, $type, $tempName, $size)
//  {
//    parent::__construct($originalName, $type, $tempName, $size);
//  }

  // Override sfValidatedFile's save method
  public function save($file = null, $fileMode = 0666, $create = true, $dirMode = 0777)
  {
    // This makes sure we use only one savedFilename (it will be the first)
    if ($this->savedFilename === null) {

      $this->savedFilename = date("Y-m-d", time()).'_'.$this->originalName;
    }
    // Let the original save method do its magic :)
    return parent::save($this->savedFilename, $fileMode, $create, $dirMode);
  }
}