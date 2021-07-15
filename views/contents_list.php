<?php
	require "../php/logincheck.php";
	require '../php/connect.php';

	//DBアクセス
	$con = new connect();
	$pdo = $con->connectdb();

	$stmt = $pdo->prepare("SELECT C.id, contents_category, title, U.name as creator, P.name as status, released_at, C.deleted_at FROM contents C JOIN users U ON C.applicant_id = U.id JOIN process_status P ON P.id = C.process_status ORDER BY C.id");
	$stmt->execute();

	$list1 = "";
	$list2 = "";
	$list3 = "";
	if($stmt->columnCount() === 0) {
		$list1 = $list2 = $list3 = "データがありません";
	} else {
		$contents = $stmt->fetchall();
		foreach($contents as $content) {
			if($content['contents_category'] == 1) { //お知らせ一覧
				$list1 .= "<tr><td>".$content['title']."</td>";
				$list1 .= "<td>".$content['creator']."</td>";
				$list1 .= "<td>".$content['status']."</td>";
				$list1 .= "<td>".$content['released_at']."</td>";
				$list1 .= "<td>".$content['deleted_at']."</td>";
				$list1 .= "<td><button type='submit' name='".$content['id']."' class='btn btn-warning btn-sm'>詳細</button></td></tr>";
			} elseif ($content['contents_category'] == 2) { //HAL学生制作一覧
				$list2 .= "<tr><td>".$content['title']."</td>";
				$list2 .= "<td>".$content['creator']."</td>";
				$list2 .= "<td>".$content['status']."</td>";
				$list2 .= "<td>".$content['released_at']."</td>";
				$list2 .= "<td>".$content['deleted_at']."</td>";
				$list2 .= "<td><button type='submit' name='".$content['id']."' class='btn btn-warning btn-sm'>詳細</button></td></tr>";
			} else { //企業商品紹介一覧
				$list3 .= "<tr><td>".$content['title']."</td>";
				$list3 .= "<td>".$content['creator']."</td>";
				$list3 .= "<td>".$content['status']."</td>";
				$list3 .= "<td>".$content['released_at']."</td>";
				$list3 .= "<td>".$content['deleted_at']."</td>";
				$list3 .= "<td><button type='submit' name='".$content['id']."' class='btn btn-warning btn-sm'>詳細</button></td></tr>";
			}
		}
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

		<title>トップページ</title>
	</head>

	<body>
		<div id="wrap" class="container">
			<div id="header"></div>
			
			<div class="container mini-wrap">
			<form method="POST" action="contents_list.php">
				
				<!-- カテゴリー選択 -->
				<div class="row justify-content-end">
					<div class="col-5 mb-4">
						<select name="content_category" class="form-select">
							<option value="news" selected>お知らせ</option>
							<option value="hal">HAL学生制作</option>
							<option value="aeon">企業商品紹介</option>
						</select>
					</div>
				</div>

				<!-- お知らせ一覧 -->
				<div id="news">
					<div class="row">
						<table class="table table-hover">
							<thead>
								<tr>
									<th class="col-5">タイトル</th>
									<th>作成者</th>
									<th>処理状況</th>
									<th>公開日</th>
									<th colspan="2">終了日</th>
								</tr>
							</thead>
							<tbody>
								<?php print $list1; ?>
							</tbody>
						</table>
					</div>
				</div>

				<!-- HAL学生制作一覧 -->
				<div id="hal">
					<div class="row">
						<table class="table table-hover">
							<thead>
								<tr>
									<th class="col-5">タイトル</th>
									<th>作成者</th>
									<th>処理状況</th>
									<th>公開日</th>
									<th colspan="2">終了日</th>
								</tr>
							</thead>
							<tbody>
								<?php print $list2; ?>
							</tbody>
						</table>
					</div>
				</div>

				<!-- 企業商品紹介一覧 -->
				<div id="aeon">
					<div class="row">
						<table class="table table-hover">
							<thead>
								<tr>
									<th class="col-5">タイトル</th>
									<th>作成者</th>
									<th>処理状況</th>
									<th>公開日</th>
									<th colspan="2">終了日</th>
								</tr>
							</thead>
							<tbody>
								<?php print $list3; ?>
							</tbody>
						</table>
					</div>
				</div>
			</form>
		</div>

		</div>
		<script src="../js/bootstrap.bundle.min.js"></script>
	</body>
</html>