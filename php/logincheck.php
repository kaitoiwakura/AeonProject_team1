<?php
	session_start();

	$is_admin = false;
	
	if (!isset($_SESSION['id']) || !isset($_SESSION['authority'])) {
		header("Location: ../views/login.html");
	} else if ($_SESSION['authority'] == 0) {
		$is_admin = true;
	}
?>