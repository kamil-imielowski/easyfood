<?php
require_once 'vendor/autoload.php';
require_once dirname(__FILE__).'/include/init.php';


$out = '';




if(!empty($HTTP_RAW_POST_DATA)){
	$HTTP_RAW_POST_DATA = json_decode($HTTP_RAW_POST_DATA);
	foreach ($HTTP_RAW_POST_DATA as $key => $value) {
		$_POST[$key] = $value;
	}
}

if ($_SERVER['REQUEST_METHOD'] == 'PUT' || $_SERVER['REQUEST_METHOD'] == 'DELETE' ||$_SERVER['REQUEST_METHOD'] == 'UPDATE') {
	 parse_str(file_get_contents("php://input"), $q);
	 $_POST = array_merge($_POST, $q);
}



if ($_GET['module'] == 'user') {
	if ($_GET['action'] == 'register') {

		if(!$uac->CheckEmailExist($_POST['email'])){

			$address = $_POST['street'].', '.$_POST['postcode'].' '.$_POST['city'];
			$url = 'http://maps.googleapis.com/maps/api/geocode/json?address=' . urlencode($address) . '&sensor=true';
        $json = @file_get_contents($url);
        $data = json_decode($json);
        if ($data->status == "OK"){
					$lat = $data->results[0]->geometry->location->lat;
        	$lng = $data->results[0]->geometry->location->lng;
				}else{
					$lat = 0;
					$lng = 0;
				}




			$query = "
					INSERT INTO users (date_add, user_type, email, pass, firstname, lastname, street, postcode, city, phone, map_lat, map_lng, state)
					VALUES (NOW(), :type, :email, :pass, :firstname, :lastname, :street, :postcode, :city, :phone, :map_lat, :map_lng, 'on')
			";

			$params = [
					"type" => $_POST['type'],
					"email" => strtolower(trim($_POST['email'])),
					"pass" => md5($_POST['password']),
					"firstname" => (($_POST['type'] == 'restaurateur') ? $_POST['res_name'] : $_POST['firstname']),
					"lastname" => (($_POST['type'] == 'restaurateur') ? '' : $_POST['lastname']),
					"street" => $_POST['street'],
					"postcode" => $_POST['postcode'],
					"city" => $_POST['city'],
					"phone" => $_POST['phone'],
					"map_lat" => $lat,
					"map_lng" => $lng
			];

			$DB->setQuery($query)->setParams($params)->execute();



			$out = [
							'status'=> 'succ',
							'message' => 'Account registred.'
						];
		}else{
			$out = [
							'status'=> 'err',
							'message' => 'Email exist.'
						];
			http_response_code(404);
		}


	}elseif ($_GET['action'] == 'login') {
		if ($uac->userLogin($_POST['email'], $_POST['pass'])) {
			$out = [
							'status'=> 'succ',
							'message' => 'Account registred.'
						];
		}else{
			$out = [
							'status'=> 'err',
							'message' => 'Bad email or password.'
						];
			http_response_code(404);
		}
	}
}elseif ($_GET['module'] == 'restaurant') {
	if ($_GET['action'] == 'addMenuItem') {
		$r->addMenuItem($_POST);
		$out = [
						'status'=> 'succ',
						'message' => 'Item added.'
					];
	}elseif ($_GET['action'] == 'deleteMenuItem') {
		$r->deleteMenuItem($_POST['id']);
		$out = [
						'status'=> 'succ',
						'message' => 'Account registred.'
					];
	}elseif ($_GET['action'] == 'addToBasket') {
		$r->addToBasket($_POST);
		$out = [
						'status'=> 'succ',
						'message' => 'Item added to basket.'
					];
	}elseif ($_GET['action'] == 'deleteBasketItem') {
		$uac->deleteBasketItem($_POST['id']);
		$out = [
						'status'=> 'succ',
						'message' => 'Item deleted.'
					];
		# code...deleteBasketItem
	}
}


if (empty($out)) {
	$out = [
					'status'=> 'err',
					'message' => 'Request not found'
				];
  http_response_code(404);
}


echo json_encode($out);

?>
