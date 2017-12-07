<?php
	//print_r($_REQUEST);
	$_registerParams = ['g','act', 'mod'];
	$_onlyLogged = [];
	$_onlyNotLogged = [];



	foreach ($_registerParams as $val) {
		if(!isset($_GET[$val])) $_GET[$val] = '';
	}

	echo $_GET['g'];



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
