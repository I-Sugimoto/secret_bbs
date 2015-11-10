<?php

session_start();

$_SESSION = array();

if (isset ($_COOKIE[session_name()]))
{
	setcookie(session_name(), '', time()-86400, '/bbs/');
}

//セッションの破棄	
session_destroy();

//ログイン画面に戻す
header('Location: login.php');