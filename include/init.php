<?php
 error_reporting(E_ALL);
 ini_set('display_errors', '1');



 require_once dirname(__FILE__).'/local.php';
 require_once dirname(__FILE__).'/session_start.php';
 require_once dirname(__FILE__).'/db_config.php';

 use classes\Database\DatabaseController;
 $DB = new DatabaseController($__dbConfig);

 use classes\Users\UsersController;
 $uac = new UsersController($DB);

 use classes\Content\ContentController;
 $cnt = new ContentController();



 require_once dirname(__FILE__).'/content_prepare.php';

?>
