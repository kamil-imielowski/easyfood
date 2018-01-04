<?php

namespace classes\Content;

use classes\Database\DatabaseController;
/**
 *
 */
class ContentController
{
  private $filesJS = [];
  private $filesCSS = [];
  protected $db;

  function __construct(DatabaseController $DB)
  {
    $this->db = $DB;
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

  public function siteData() : array
  {
    $_t = [];
    $date = date("Y-m-d h:i:s", strtotime("-5 day"));
    
    $query = 'SELECT COUNT(*) as ls FROM users where date_add > :date AND user_type = :user_type';//WHERE id = :id
		$param = [
		            'date' => $date,
                'user_type' => 'user'
		          ];
		$this->db->setQuery($query)->setParams($param)->execute();
		$us = $this->db->fetchData();

    $query = 'SELECT COUNT(*) as ls FROM users where date_add > :date AND user_type = :user_type';//WHERE id = :id
		$param = [
		            'date' => $date,
                'user_type' => 'restaurer'
		          ];
		$this->db->setQuery($query)->setParams($param)->execute();
		$re = $this->db->fetchData();


    $query = 'SELECT COUNT(*) as ls FROM orders where date > :date';//WHERE id = :id
    $param = [
                'date' => $date
              ];
    $this->db->setQuery($query)->setParams($param)->execute();
    $oo = $this->db->fetchData();

    $query = 'SELECT COUNT(*) as ls FROM orders_details LEFT JOIN orders ON orders_details.order_id = orders.id where orders.date > :date';//WHERE id = :id
    $param = [
                'date' => $date
              ];
    $this->db->setQuery($query)->setParams($param)->execute();
    $oi = $this->db->fetchData();


    $_t = [
      'users' => $us[0]['ls'],
      'restaurants' => $re[0]['ls'],
      'orders' => $oo[0]['ls'],
      'orders_items' => $oi[0]['ls'],
    ];

    return $_t;
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
