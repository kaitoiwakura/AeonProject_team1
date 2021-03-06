<?php require "../php/logincheck.php"; ?>

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

		<title>トップページ</title>
	</head>

	<body>
		<div id="wrap" class="container">
			<div id="header"></div>
			
			<div class="container mini-wrap">
				<div class="list-group mx-auto list-group-flush">
					<?php if ($is_admin): ?>
						<a href="./users_list.php" class="list-group-item list-group-item-action admin-menu">ユーザー管理</a>
					<?php endif; ?>
					<a href="./createnews.php" class="list-group-item list-group-item-action">コンテンツ追加</a>
					<a href="./contents_list.php" class="list-group-item list-group-item-action">コンテンツ一覧</a>
					<a href="./logs.php" class="list-group-item list-group-item-action">更新ログ</a>
					<a href="./change_password.php" class="list-group-item list-group-item-action">パスワード変更</a>
				</div>
			</div>
		</div>
		<script src="../js/bootstrap.bundle.min.js"></script>
	</body>
</html>

