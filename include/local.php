<?php
define('session_panel', 'SR-System-Rekrutacji');

define('site_name', 'EasyFood');

define('date_time_now', date("Y-m-d H:i:s",time()));

define('base_url', 'http://'.$_SERVER["HTTP_HOST"].'/');

define('template_dir', 'templates/');

define('__DIR_CSS__', 'assets/css/');

define('__DIR_JS__', 'assets/js/');

define('__DIR_JS_APP__', 'assets/js/app/');

define('__DIR_UPLOAD__', 'assets/upload/');

define('request_url', $_SERVER["REQUEST_URI"]);


$st  = 'From: '.site_name.'.pl <no-reply@'.strtolower(site_name).'.pl>\n';
$st .= 'Reply-To: '.site_name.'.pl <no-reply@'.strtolower(site_name).'.pl>\n';
$st .= 'Content-Type:text/plain; charset=\"utf-8\"\n';

 define('mail_header', $st);

?>
