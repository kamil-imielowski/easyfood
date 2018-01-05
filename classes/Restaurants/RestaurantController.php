<?php
namespace classes\Restaurants;


use classes\Database\DatabaseController;
use classes\Users\UsersController;

class RestaurantController extends UsersController
{

  function __construct(DatabaseController $DB)
  {
    parent::__construct($DB);
  }

  public function getRestaurantsList() : array
  {
    $query = 'SELECT id, firstname, street, postcode, city, phone, map_lat, map_lng  FROM users WHERE user_type = :user_type';
    $param = [
              'user_type' => 'restaurateur'
              ];
    $this->db->setQuery($query)->setParams($param)->execute();
    $re = $this->db->fetchData();

    return $re;
  }

  public function getMenu(int $id) : array
  {

    $query = 'SELECT *  FROM products WHERE user_id = :id';
    $param = [
              'id' => $id
              ];
    $this->db->setQuery($query)->setParams($param)->execute();
    $re = $this->db->fetchData();

    return $re;
  }

  public function getRestaurantDetails(int $id) : array
  {

    $query = 'SELECT id, firstname, street, postcode, city, phone, map_lat, map_lng  FROM users WHERE user_type = :user_type AND id = :id';
    $param = [
              'user_type' => 'restaurateur',
              'id' => $id
              ];
    $this->db->setQuery($query)->setParams($param)->execute();
    $re = $this->db->fetchData();

    if(!$re) $re[0] = [];

    return $re[0];
  }

}

?>
