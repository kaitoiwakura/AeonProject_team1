<?php
	// データベース接続
	require('../php/connect.php');
	$con = new connect();
	$pdo = $con->connectdb();
	//$pdo = new PDO("mysql:dbname=AEON;host=localhost;charset=utf8", "root", "");
	// SQL文
	$sql="SELECT contents_category,title,logs.updater_id,contents.process_status,contents.updated_at,users.name,process_status.name AS process_status_name from contents inner join logs on contents.updated_at = logs.updated_at inner join users on logs.updater_id = users.id inner join process_status on contents.process_status = process_status.id;";
	//PDOに渡す
	$stmt = $pdo->prepare($sql);
	//実行
	$stmt -> execute();
	function console_log( $data ){
		echo '<script>';
		echo 'console.log('. json_encode( $data ) .')';
		echo '</script>';
	}
	//変数(仮)
	$id = 0;
	$newslist="";
	$hallist="";
	$aeonlist="";
	//テスト表示
	print_r($_POST);
	//コンテンツテーブルの全てを取り出し
	$row = $stmt->fetchAll();
	//print_r($row);
	foreach($row as $val) {
		//ニュースリスト追加
		if($val['contents_category'] == 1){
			$newslist .= "<tr>
			<td>".$val['title']."</td>
			<td>".$val['name']."</td>
			<td>".$val['process_status_name']."</td>
			<td>".$val['updated_at']."</td>
			<td><button type='submit' name='edit_".$id."' class='btn btn-secondary btn-sm'>編集</button></td>
			"."<td><button type='submit' name='check_".$id."' class='btn btn-warning btn-sm'>承認</button></td>
			</tr>";
		}//halリスト追加
		elseif($val['contents_category'] == 2){
			$hallist .= "<tr>
			<td>".$val['title']."</td>
			<td>".$val['name']."</td>
			<td>".$val['process_status_name']."</td>
			<td>".$val['updated_at']."</td>
			<td><button type='submit' name='edit_".$id."' class='btn btn-secondary btn-sm'>編集</button></td>
			"."<td><button type='submit' name='check_".$id."' class='btn btn-warning btn-sm'>承認</button></td>
			</tr>";
		}//イオン商品リスト追加
		else{
			$aeonlist .= "<tr>
			<td>".$val['title']."</td>
			<td>".$val['name']."</td>
			<td>".$val['process_status_name']."</td>
			<td>".$val['updated_at']."</td>
			<td><button type='submit' name='edit_".$id."' class='btn btn-secondary btn-sm'>編集</button></td>
			"."<td><button type='submit' name='check_".$id."' class='btn btn-warning btn-sm'>承認</button></td>
			</tr>";
		}
	}
	//変数(仮)
	$id = 0;
	$title = "タイトル";
	$val['updater_id'] = "作成者";
	$status = "処理状況";
	$log = "更新ログ";
	// //お知らせ一覧(仮)
	// $newslist = "";
	// for ($i = 1; $i < 5; $i++) {
	// 	$id = $i;
		//$newslist .= "<tr><td>".$title."</td><td>".$val['updater_id']."</td><td>".$status."</td><td>".$log."</td><td><button type='submit' name='edit_".$id."' class='btn btn-secondary btn-sm'>編集</button></td>"."<td><button type='submit' name='check_".$id."' class='btn btn-warning btn-sm'>承認</button></td></tr>";
	// }
	// //HAL学生制作一覧(仮)
	// $hallist = "";
	// for ($i = 6; $i < 9; $i++) {
	// 	$id = $i;
	// 	$hallist .= "<tr><td>".$title."</td><td>".$val['updater_id']."</td><td>".$status."</td><td>".$log."</td><td><button type='submit' name='edit_".$id."' class='btn btn-secondary btn-sm'>編集</button></td>"."<td><button type='submit' name='check_".$id."' class='btn btn-warning btn-sm'>承認</button></td></tr>";
	// }
	// //企業商品紹介一覧(仮)
	// $aeonlist = "";
	// for ($i = 10; $i < 12; $i++) {
	// 	$id = $i;
	// 	$aeonlist .= "<tr><td>".$title."</td><td>".$val['updater_id']."</td><td>".$status."</td><td>".$log."</td><td><button type='submit' name='edit_".$id."' class='btn btn-secondary btn-sm'>編集</button></td>"."<td><button type='submit' name='check_".$id."' class='btn btn-warning btn-sm'>承認</button></td></tr>";
	// }
	
?>
<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="utf-8">
		<meta name="robots" content="none,noindex,nofollow">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="./css/bootstrap.min.css">
		<link rel="stylesheet" href="./css/style.css">
		
		<script src="./js/jquery-3.4.1.min.js"></script>
		<script src="./js/script.js"></script>
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
									<th class="col-7">タイトル</th>
									<th>作成者</th>
									<th>処理状況</th>
									<th colspan="3">更新ログ</th>
								</tr>
							</thead>
							<tbody>
								<?php print $newslist; ?>	
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
									<th class="col-7">タイトル</th>
									<th>作成者</th>
									<th>処理状況</th>
									<th colspan="3">更新ログ</th>
								</tr>
							</thead>
							<tbody>
								<?php print $hallist; ?>
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
									<th class="col-7">タイトル</th>
									<th>作成者</th>
									<th>処理状況</th>
									<th colspan="3">更新ログ</th>
								</tr>
							</thead>
							<tbody>
								<?php print $aeonlist; ?>
							</tbody>
						</table>
					</div>
				</div>
			</form>
		</div>
		</div>
		<script src="./js/bootstrap.bundle.min.js"></script>
	</body>
</html>