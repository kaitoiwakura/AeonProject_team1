<?php
	require('connect.php');
	session_start();
	session_regenerate_id();	//セッションID更新

	$mail = $_POST['mail'];
	$password = (string)$_POST['password'];

	$con = new connect();
	$pdo = $con->connectdb();

	$stmt = $pdo->prepare('SELECT * FROM users WHERE mail = :mail');
	$stmt->bindvalue(':mail', $mail, PDO::PARAM_STR);
	$stmt->execute();
	$user = $stmt->fetch();
	if(password_verify($_POST['password'], $user['password'])) {
		$_SESSION['name'] = $user['name'];
		$_SESSION['mail'] = $user['mail'];
		$_SESSION['password'] = $user['password'];
		$_SESSION['authority'] = (int) $user['authority'];
		header("Location:index.html");
	} else {
		$url = "Location:login.html";
		header($url);
	} 
?>