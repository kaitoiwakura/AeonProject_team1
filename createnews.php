<?php
	require('connect.php');
	
	session_start();


	$title = htmlspecialchars($_POST['title']);
	$content = htmlspecialchars($_POST['content']);
	$newsCategory = $_POST['news_category'];
	$contentCategory = $_POST['contents_category'];
	$processStatus  = 1 ;	//初回申請時のステータス 1
	$applicant = $_SESSION['id'];	//申請者ID

	try {
		$con = new connect();
		$pdo = $con->connectdb();

		$sql = 'INSERT INTO 
		 contents(contents_category, title, content, news_category, applicant_id, process_status, already_read_status)
		 VALUES ((select id from contents_category WHERE name = :contents_category), :title, :content, (select id from news_category WHERE name = :news_category), :applicant_id, :process_status, :already_read_status)';
		$stmt = $pdo->prepare($sql);
		$stmt->bindvalue(':contents_category', $contentCategory, PDO::PARAM_STR);
		$stmt->bindvalue(':title', $title, PDO::PARAM_STR);
		$stmt->bindvalue(':content', $content, PDO::PARAM_STR);
		$stmt->bindvalue(':applicant_id',$applicant, PDO::PARAM_INT);
		$stmt->bindvalue(':news_category', $newsCategory, PDO::PARAM_STR);
		$stmt->bindvalue(':process_status', $processStatus, PDO::PARAM_STR);
		$stmt->bindvalue(':already_read_status', false, PDO::PARAM_BOOL);

		$stmt->execute();

		//画像保存用にcontentidをセッションに保存して渡す
		session_start();
		$_SESSION['contentId'] = $pdo->lastInsertId();
		header("Location:imageform.php");
		
	} catch(PDOException $e) {
		header('Content-Type: text/html; charset=UTF-8');
		echo $e->getMessage();
		echo $applicant;
	}
	


	// header('Content-Type: text/plain; charset=UTF-8');
	// echo $content;
	// echo nl2br($content);
	// echo mb_internal_encoding();	//文字コード

	//nl2br 改行コードを<br>に置き換えてくれる
?>