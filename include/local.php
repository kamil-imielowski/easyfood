<?php
require_once 'db_config.php';

define('session_panel', 'SR-System-Rekrutacji');

define('site_name', 'System Rekrutacji');

define('date_time_now', date("Y-m-d H:i:s",time()));

define('base_url', 'http://'.$_SERVER["HTTP_HOST"].'/');

define('template_dir', 'templates/');

define('app_route', 'js/app/');

define('user_files', 'files/users');

define('request_url', $_SERVER["REQUEST_URI"]);


$st  = 'From: '.site_name.'.pl <no-reply@'.strtolower(site_name).'.pl>\n';
$st .= 'Reply-To: '.site_name.'.pl <no-reply@'.strtolower(site_name).'.pl>\n';
$st .= 'Content-Type:text/plain; charset=\"utf-8\"\n';

 define('mail_header', $st);

?>
