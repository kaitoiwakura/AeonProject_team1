<?php
	require('connect.php');

	session_start();
	// 未定義である・複数ファイルである・$_FILES Corruption 攻撃を受けた
  // どれかに該当していれば不正なパラメータとして処理する
	if (!isset($_FILES['upimage']['error']) || !is_int($_FILES['upimage']['error'])) {
		header("Location:imageform.php");
		exit();
	}

	//ファイルが画像かどうか
	$finfo = new finfo(FILEINFO_MIME_TYPE);
	$mime_type = $finfo->file($_FILES['upimage']['tmp_name']);

	$ext = "";
	switch ($mime_type) {
			case "image/png":
				$ext = ".png";
				break;
			case "image/jpg":
			case "image/jpeg";
				$ext = ".jpg";
				break;
			case "image/gif":
				$ext = ".gif";
				break;
			default:	//画像以外選択時
			header("Location:imageform.php");
			exit();
	}

	//一時ファイルへの保存失敗時
	if(!is_uploaded_file($_FILES['upimage']['tmp_name']) || 
		$_FILES['upimage']['error'] !== UPLOAD_ERR_OK) {
			header("Location:imageform.php");
			exit();
	}

	//画像保存処理
	$name = uniqid().$ext;	//画像ファイル名の一意化
	$path = "upload/images/";	//保存ディレクトリの相対パス
	if(move_uploaded_file($_FILES['upimage']['tmp_name'], $path.$name)) {
		//画像保存成功時contentに紐づけ
		try {
			$con = new connect();
			$pdo = $con->connectdb();

			$stmt = $pdo->prepare('UPDATE contents SET image_path = :image_path WHERE id = :id');
			$stmt->bindvalue(':image_path', $name, PDO::PARAM_STR);	//画像ファイル名のみを保存
			$stmt->bindvalue(':id', (int)$_SESSION['contentId'], PDO::PARAM_INT);
			$stmt->bindvalue();
			$stmt->execute();

			unset($_SESSION['contentId']);	//画像登録成功時contentidを消去
			header("Location:index.html");
		} catch (PDOException $e) {
			//エラー発生時画像を消去して戻る
			unlink($path.$name);
			header("Location:imageform.php");
		}
	}
?>