<?php
	require "../php/logincheck.php";
	require '../php/connect.php';

	if(!isset($_POST["action"]) || $_POST["action"] != "accept") {
		header("Location: ../views/index.php");
	}

	//DB接続
	$con = new connect();
	$pdo = $con->connectdb();

	$id = $_SESSION['content_id'];
	$title = $_SESSION['content_title'];
	$uid = $_SESSION['id'];

	// print_r($_POST);
	// print_r($_SESSION);

	//受け取ったデータを書き込むsab
	if (isset($_POST["action"])) {
		$id = $_SESSION['content_id'];
		$process = '2';
		//$content = $_POST["content"];
		$sql = "UPDATE contents SET process_status = :process WHERE id = :id;";
		$stmt = $pdo->prepare($sql);
		$stmt -> bindValue(":process", $process, PDO::PARAM_INT);
		$stmt -> bindValue(":id", $id, PDO::PARAM_INT);
		$stmt -> execute();

		//ログに書き込む
		$sql = "INSERT INTO logs (process_status, contents_title, log_comment, updater_id) VALUES ('承認', :title, 'コンテンツが承認されました', :uid)";
		$stmt = $pdo->prepare($sql);
		$stmt -> bindValue(":title", $title, PDO::PARAM_STR);
		$stmt -> bindValue(":uid", $uid, PDO::PARAM_INT);
		$stmt -> execute();
	}    
  
	//処理終了後コンテンツ一覧に戻る
	header("Location: ../views/contents_list.php");
?>