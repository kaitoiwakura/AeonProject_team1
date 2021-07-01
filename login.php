<?php
	require('connect.php');
	session_start();
	session_regenerate_id();	//セッションID更新

	$mail = $_POST['mail'];
	$password = (string)$_POST['password'];

	$con = new connect();	//クラス呼び出し
	$pdo = $con->connectdb();	//PDo作成

	$stmt = $pdo->prepare('SELECT * FROM users WHERE mail = :mail');
	$stmt->bindvalue(':mail', $mail, PDO::PARAM_STR);
	$stmt->execute();	//sql実行
	$user = $stmt->fetch();	//ユーザーデータを配列化
	if(password_verify($_POST['password'], $user['password'])) {
		$_SESSION['id'] = (int)$user['id'];
		$_SESSION['name'] = $user['name'];
		$_SESSION['mail'] = $user['mail'];
		$_SESSION['authority'] = (int) $user['authority'];
		header("Location:index.html");
	} else {
		$url = "Location:login.html";
		header($url);
	}
?>