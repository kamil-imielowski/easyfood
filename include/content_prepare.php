<?php
	//print_r($_REQUEST);
	$_registerParams = ['g','act', 'mod'];
	$_onlyLogged = [];
	$_onlyNotLogged = [];


	foreach ($_registerParams as $val) {
		if(!isset($_GET[$val])) $_GET[$val] = '';
	}

	// NOTE: CSS GLOBALS
	$cnt->addAsset('bootstrap.min.css');
	$cnt->addAsset('font-awesome.min.css');
	$cnt->addAsset('custom.min.css');

	// NOTE: JS GLOBALS
	$cnt->addAsset('jquery-3.2.1.slim.min.js');
	$cnt->addAsset('popper.min.js');
	$cnt->addAsset('bootstrap.min.js');
	$cnt->addAsset('app/'.$_GET['g'].'.js');


	if(file_exists(template_dir.$_GET['g'].'.tpl.php')){
		$content['template_file'] = $_GET['g'].'.tpl.php';
	}else{
		if(empty($_GET['g']))
		{
			$content['template_file'] = 'home.tpl.php';
		}else{
			//	header('Location: /404.html');
			exit();
		}
	}

?>
