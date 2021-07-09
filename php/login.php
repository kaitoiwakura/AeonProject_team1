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

	var_dump($password);
	var_dump(password_hash($user['password'],PASSWORD_DEFAULT));


	if(password_verify($password, $user['password'])) {
		$_SESSION['id'] = (int)$user['id'];
		$_SESSION['name'] = $user['name'];
		$_SESSION['mail'] = $user['mail'];
		$_SESSION['authority'] = (int) $user['authority'];
		header("Location: ../views/index.php");
		// print "ok";
	} else {
		$url = "Location: ../views/login.html";
		header($url);
		// print "false";
	}
?>