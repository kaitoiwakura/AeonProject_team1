<?php
	require 'connect.php';
	$authority = ["管理者","編集者"];

	$con = new connect();
	$pdo = $con->connectdb();

	$updateResult = "";	//変更結果
	foreach ($_POST as $key => $value) {
		//権限をupdate
		$stmt = $pdo->prepare('UPDATE users SET authority = :authority WHERE id = :id');
		$stmt->bindvalue(':authority', (int)$value, PDO::PARAM_INT);
		$stmt->bindvalue(':id', (int)$key, PDO::PARAM_INT);
		$stmt->execute();

		//権限変更したユーザーの名前を取得
		$stmt = $pdo->prepare('SELECT name FROM users WHERE id = :id');
		$stmt->bindvalue(':id', (int)$key, PDO::PARAM_INT);
		$stmt->execute();
		$username = $stmt->fetch();
		$updateResult .= "ユーザー : ".$username['name']." ➔ 権限 : ".$authority[$value]."<br>";
	}
	
?>
<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="utf-8">
		<meta name="robots" content="none,noindex,nofollow">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<link rel="stylesheet" href="../css/bootstrap.min.css">
		<link rel="stylesheet" href="../css/style.css">
		
		<script src="../js/jquery-3.4.1.min.js"></script>
		<script src="../js/script.js"></script>

		<title>ユーザー権限変更</title>
	</head>

	<body>
		<div id="wrap" class="container">
			<div id="header"></div>

			<div class="container mini-wrap">
				<!-- <div style="color: #999999">
					<?php
						print "<p class='lead'>権限が変更されたユーザー一覧：</p>";
						print $updateResult;
					?>
				</div> -->

				<div class="row mx-auto text-center" style="width: fit-content;">
					<p>ユーザーの権限を更新しました。</p>
					<p><a href="../views/users_list.php" style="font-size: 0.9rem;">ユーザー一覧に戻る</a></p>
				</div>
			</div>
		</div>
		<script src="../js/bootstrap.bundle.min.js"></script>
	</body>
</html>