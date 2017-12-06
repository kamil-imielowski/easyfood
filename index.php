<?php
//test push
session_start();
require_once dirname(__FILE__).'/vendor/autoload.php';
include_once dirname(__FILE__).'/displayErrors.php';
require_once dirname(__FILE__).'/functions/cityForMap.php';

$translate = new classes\Languages\Translate($_COOKIE['lang']);

#countries for map
$countriesForMap = getCountriesForMap();

if(isset($_POST['action']) || isset($_GET['action'])){
	$action = isset($_POST['action']) ? $_POST['action'] : $_GET['action'];

    switch ($action) {
        case 'value':
            # code...
            break;
    }
}else{
    include dirname(__FILE__).'/templates/index.html.php';
}


?>
