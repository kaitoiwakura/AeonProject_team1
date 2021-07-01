<?php
	$db_host = "localhost";
	$db_user = "root";
	$db_pass = "";
	$db_name = "aeon";

	$con = mysqli_connect($db_host,$db_user,$db_pass,$db_name) or die("接続失敗");
	mysqli_set_charset($con,"utf8");
?>