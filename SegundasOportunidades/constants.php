<?php

	define('DS', DIRECTORY_SEPARATOR);
	define('ROOT', realpath(dirname(__FILE__)) . DS);
	define('SYS', ROOT . 'sys' . DS);
	
	require_once SYS . 'Config.php';
	require_once SYS . 'Request.php';
	require_once SYS . 'Core.php';
	require_once SYS . 'Controller.php';
	require_once SYS . 'Model.php';
	require_once SYS . 'View.php';
	require_once SYS . 'Database.php';
	require_once SYS . 'Session.php';

?>