<?php
	include 'config.php';

	if ( isset($_SESSION['user']) )
		include("public/views/home.php");
	else
		include("public/views/login.php");
