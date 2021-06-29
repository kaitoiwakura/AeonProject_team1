<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="utf-8">
		<meta name="robots" content="none,noindex,nofollow">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<link rel="stylesheet" href="./css/bootstrap.min.css">
		<link rel="stylesheet" href="./css/common.css">
		<link rel="stylesheet" href="./css/style.css">
		
		<script src="./js/jquery-3.4.1.min.js"></script>
		<script src="./js/script.js"></script>

		<title>トップページ</title>
	</head>

	<body>
		<div id="wrap" class="container">
			<div id="header"></div>
			<div class="container" style="width: 70%">
				<div style="color: #999999">
					<?php
						//ユーザー権限の処理を書いて～
						print "<p class='lead'>権限が変更されたユーザー一覧：</p>";
						foreach ($_POST as $key => $value) {
							print "ユーザーID : ".$key." ➔ 権限 : ".$value."<br>";
						}
					?>
				</div>

				<p class="text-center align-middle mt-4">
					ユーザーの権限を更新しました。
				</p>
			</div>
		</div>
		<script src="./js/bootstrap.bundle.min.js"></script>
	</body>
</html>