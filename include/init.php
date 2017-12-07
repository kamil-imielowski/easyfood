<?php
 error_reporting(E_ALL);
 ini_set('display_errors', '1');



 require_once dirname(__FILE__).'/local.php';
 require_once dirname(__FILE__).'/session_start.php';
 require_once dirname(__FILE__).'/db_config.php';

 use classes\Users\UsersController;
 $uac = new UsersController();

 use classes\Database\DatabaseController;
 $DB = new DatabaseController($__dbConfig);





 require_once dirname(__FILE__).'/content_prepare.php';

?>
