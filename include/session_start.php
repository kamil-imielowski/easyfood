<?php
session_start();

if(empty($_SESSION[session_panel])) $_SESSION[session_panel]['nid'] = '';
$nid =  $_SESSION[session_panel]['nid'];

if(!isset($_COOKIE[md5('shop')]))
	setcookie(md5('shop'), md5(getenv("REMOTE_ADDR")), time() + 3600, "/");

?>
