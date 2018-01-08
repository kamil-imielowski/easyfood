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

  public function addMenuItem(array $_t)
  {
    $query = "
        INSERT INTO products (name, description, price, user_id, state)
        VALUES (:name, :description, :price, :user_id, 'on')
    ";

    $params = [
        "name" => $_t['name'],
        "description" => $_t['description'],
        "price" => $_t['price'],
        "user_id" => $this->userID
    ];

    return $this->db->setQuery($query)->setParams($params)->execute();
  }

  public function deleteMenuItem(int $id)
  {
    $query = "
        DELETE FROM products
        WHERE id = :id AND user_id = :user_id
    ";

    $params = [
        "id" => $id,
        "user_id" => $this->userID
    ];

    return $this->db->setQuery($query)->setParams($params)->execute();
  }

  public function addToBasket($_t)
  {
    $query = 'SELECT id FROM orders WHERE user_id = :user_id AND restaurer_id = :restaurer_id AND state="new"';
    $param = [
              'user_id' => $this->userID,
              'restaurer_id' => $_t['id']
              ];
    $this->db->setQuery($query)->setParams($param)->execute();
    $re = $this->db->fetchData();



    if (!empty($re[0]['id'])) {
      $pid = $re[0]['id'];
    }else {
      $pid = $this->createNewOrder($_t['id']);
    }

    $query = 'SELECT orders_details.id FROM orders_details LEFT JOIN orders ON orders_details.order_id = orders.id WHERE orders_details.product_id = :product_id AND orders_details.order_id = :order_id AND orders.state = "new"';
    $params = [
        "product_id" => $_t['product_id'],
        "order_id" => $pid
    ];

    $this->db->setQuery($query)->setParams($params)->execute();
    $tmp = $this->db->fetchData();

    if ($tmp) {
      $query = "
        UPDATE orders_details
        SET quantity = quantity+1
        WHERE id = :id;
      ";

      $params = [
          "id" => $tmp[0]['id']
      ];
    }else {
      $query = "
          INSERT INTO orders_details (product_id, order_id, price)
          VALUES (:product_id, :order_id, :price)
      ";

      $params = [
          "product_id" => $_t['product_id'],
          "order_id" => $pid,
          "price" => $_t['price']
      ];
    }




    return $this->db->setQuery($query)->setParams($params)->execute();

  }

  public function createNewOrder($id) : int
  {
    $query = "
        INSERT INTO orders (restaurer_id, user_id, state)
        VALUES (:id, :user_id, 'new')
    ";

    $params = [
        "id" => $id,
        "user_id" => $this->userID
    ];

    $this->db->setQuery($query)->setParams($params)->execute();

    return $this->db->getLastId();
  }

}

?>
