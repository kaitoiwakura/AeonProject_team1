<?php
	require "../php/logincheck.php";
	require '../php/connect.php';

	if(!isset($_POST["action"]) || $_POST["action"] != "reject") {
		header("Location: ../views/index.php");
	}

	//DB接続
	$con = new connect();
	$pdo = $con->connectdb();

	$id = $_SESSION['content_id'];
	$title = $_SESSION['content_title'];
	$comment = "コンテンツが却下されました。<br>";
	$comment .= "理由：" . $_POST['reason'];
	$uid = $_SESSION['id'];

  //print_r($_POST);

	//受け取ったデータを書き込むsab
	if (isset($_POST["action"])) {
		$id = $_SESSION['content_id'];
		$process = '3';
		//$content = $_POST["content"];
		$sql = "UPDATE contents SET process_status = :process WHERE id = :id;";
		$stmt = $pdo->prepare($sql);
		$stmt -> bindValue(":process", $process, PDO::PARAM_INT);
		$stmt -> bindValue(":id", $id, PDO::PARAM_INT);
		$stmt -> execute();

		//ログに書き込む
		$sql = "INSERT INTO logs (process_status, contents_title, log_comment, updater_id) VALUES ('戻し', :title, :comment, :uid)";
		$stmt = $pdo->prepare($sql);
		$stmt -> bindValue(":title", $title, PDO::PARAM_STR);
		$stmt -> bindValue(":comment", $comment, PDO::PARAM_STR);
		$stmt -> bindValue(":uid", $uid, PDO::PARAM_INT);
		$stmt -> execute();
	}

	//処理終了後コンテンツ一覧に戻る
	header("Location: ../views/contents_list.php");
?>