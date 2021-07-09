<?php
	require('connect.php');
	
	$con = new connect();
	$pdo = $con->connectdb();

	$stmt = $pdo->prepare('SELECT name FROM contents_category');
	$stmt->execute();
	$contentbuf	= $stmt->fetchall();

	$contents = [];
	foreach($contentbuf as $value) {
		$contents[] = current($value);
	}
	
	$stmt = $pdo->prepare('SELECT name FROM news_category');
	$stmt->execute();
	$newsbuf = $stmt->fetchall();

	$news = [];
	foreach($newsbuf as $value) {
		$news[] = current($value);
	}

	echo json_encode(array('contents'=>$contents, 'news'=>$news), JSON_UNESCAPED_UNICODE);
	/**
	 * const array =JSON.parse(data)でJavaScript側でjsonとして受け取れる
	 * arrayの中身、値の数は可変
	 * { "contents":["A","BBB"],
	 *    "news":["Cc","DD","ee"]}
	 * 	array["contents"][0] = A
	 *  array["news"][2] = ee
	 */
?>