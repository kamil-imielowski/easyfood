<?php

namespace classes\Content;

/**
 *
 */
class ContentController
{
  private $filesJS = [];
  private $filesCSS = [];

  function __construct()
  {
  }

  public function addAsset($f)
  {
    switch (pathinfo($f, PATHINFO_EXTENSION)) {
      case 'js':
          return array_push($this->filesJS, __DIR_JS__.$f);
        break;

      case 'css':
          return array_push($this->filesCSS, __DIR_CSS__.$f);
        break;
      default:
        throw new Exception("Error Processing Request", 1);
        break;
    }

  }

  public function linkJS() : string
  {
    $out = '';
    foreach ($this->filesJS as  $value) {
      if (file_exists($value)) {
        $out .= '<script src="'.base_url.$value.'"></script>';
      }
    }
    return $out;
  }

  public function linkCSS() : string
  {
    $out = '';
    foreach ($this->filesCSS as  $value) {
      if (file_exists($value)) {
        $out .= '<link href="'.base_url.$value.'" rel="stylesheet">';
      }
    }
    return $out;
  }
}

?>
