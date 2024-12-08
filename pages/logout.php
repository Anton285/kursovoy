<?php 
	include 'init.php';

	unset($_SESSION['auth']);
    unset($_SESSION['username']);
	header("Location: ../index.php");