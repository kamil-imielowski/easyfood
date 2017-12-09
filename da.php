<?php
require_once 'vendor/autoload.php';
require_once dirname(__FILE__).'/include/init.php';


$out = '';
if(!empty($HTTP_RAW_POST_DATA)){
	$HTTP_RAW_POST_DATA = json_decode($HTTP_RAW_POST_DATA);
	foreach ($HTTP_RAW_POST_DATA as $key => $value) {
		$_REQUEST[$key] = $value;
	}
}


if (empty($out)) {
  http_response_code(404);
}


echo json_encode($out);

?>
