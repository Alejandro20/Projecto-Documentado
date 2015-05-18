<?php

	ini_set('display_errors', 'on');
	require 'constants.php';

	Session::init();
				
	Core::iniciar(new Request);

?>