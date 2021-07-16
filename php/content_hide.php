<?php
	require "../php/logincheck.php";
	require '../php/connect.php';

	if((!isset($_POST["news"]) || $_POST["news"] == "") && (!isset($_POST["detail"]) || $_POST["detail"] == "")) {
		header("Location: ../views/index.php");
	}

	// if(isset($_POST["news"]) && $_POST["news"] != "") {
	// 	$id = $_POST["news"];

	// 	//DB接続
	// 	$con = new connect();
	// 	$pdo = $con->connectdb();
	
	// 	$stmt = $pdo->prepare('SELECT C.*, N.name as tag, P.name as status FROM contents C JOIN news_category N ON C.news_category = N.id JOIN process_status P ON C.process_status = P.id WHERE C.id = :id');
	// 	$stmt->bindvalue(':id', $id, PDO::PARAM_STR);
	// 	$stmt->execute();
	
	// 	$content = $stmt->fetch();

	// 	$_SESSION['content_newscat'] = $content['news_category'];
	// }
	
	// if(isset($_POST["detail"]) && $_POST["detail"] != "") {
	// 	$id = $_POST["detail"];

		//DB接続
		$con = new connect();
		$pdo = $con->connectdb();
	
	// 	$stmt = $pdo->prepare('SELECT C.*, P.name as status FROM contents C JOIN process_status P ON C.process_status = P.id WHERE C.id = :id');
	// 	$stmt->bindvalue(':id', $id, PDO::PARAM_STR);
	// 	$stmt->execute();
	
	// 	$content = $stmt->fetch();
	// }

    $id = $_SESSION['content_id'];
	// $_SESSION['content_id'] = $id;
	// $_SESSION['content_cat'] = $content['contents_category'];
	// $_SESSION['content_title'] = $content['title'];
	// $_SESSION['content_text'] = $content['content'];
	// $_SESSION['content_img'] = $content['image_path'];
	// $_SESSION['content_url'] = $content['video_url'];
	// $_SESSION['content_status'] = $content['process_status'];
	// $_SESSION['content_release'] = $content['released_at'];
    // $_SESSION['content_hide'] = $content['deleted_at'];

    print_r($_POST);

    //受け取ったデータを書き込むsab
	if (isset($_POST["action"])) {
        $id = $_SESSION['content_id'];
        $process = '5';
        //$content = $_POST["content"];
		$sql = "UPDATE contents SET process_status = :process, updated_at = CURRENT_TIMESTAMP  WHERE id = :id;";
		$stmt = $pdo->prepare($sql);
        $stmt -> bindValue(":process", $process, PDO::PARAM_INT);
        $stmt -> bindValue(":id", $id, PDO::PARAM_INT);
		$stmt -> execute();
	}
    
    // // 受け取ったデータを書き込む
	// //if (isset($_POST["action"])) {
    //     $content = "2";
    //     //成功
    //     $sql = "UPDATE contents SET process_status = :content, updated_at = CURRENT_TIMESTAMP  WHERE id = 5;";
    //     //$sql = "UPDATE contents SET process_status, updated_at = VALUES (:content, NOW()) WHERE id = 5;";
	// 	//$sql  = "INSERT INTO contents (process_status, updated_at) VALUES (:content, NOW());";
	// 	$stmt = $pdo->prepare($sql);
	// 	 $stmt -> bindValue(":content", $content, PDO::PARAM_INT);
	// 	$stmt -> execute();
	// //}
	
?>