<?php
// データベース接続
require('connect.php');
$con = new connect();
$pdo = $con->connectdb();
//$pdo = new PDO("mysql:dbname=AEON;host=localhost;charset=utf8", "root", "");

// SQL文
$sql="SELECT title,process_status,updated_at from contents;";
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
	 $title = "";
	 $status = "";
	 $log = "";

	print_r($_POST);

// fetchで一文ずつ表示を繰り返し
while ($row = $stmt -> fetch(PDO::FETCH_ASSOC )) {
	//行番号用変数を用意
	$i=1;
		//連想配列すべてを読み出すまでループ<td>これなに'.$val.'('.$key.')</td>
		foreach($row as $key => $val){
			//番号とテーブル名とキーを表示
			print '<tr><td>行番号'.$i.'</td>
			<td>タイトル'.$val.'('.$title.')</td>
			<td>処理状態'.$val.'('.$status.')</td>
			<td>更新ログ'.$val.'('.$log.')</td></tr><br/>';
			$i+=1;
		}
		$i+=1;
	echo("<br/>");
	  
	  console_log( array($row) );
}
	//お知らせ一覧(仮)
	$list1 = "";
	for ($i = 1; $i < 5; $i++) {
		$id = $i;

		$list1 .= "<tr><td>".$row[$id]["title"]."</td>
		<td>".$row["process_status"]."</td>
		<td>".$row["updated_at"]."</td>
		<td>
			<button type='submit' name='edit_".$id."' class='btn btn-secondary btn-sm'>編集</button>
		</td>
		</tr>";
	}

	//HAL学生制作一覧(仮)
	$list2 = "";
	for ($i = 6; $i < 9; $i++) {
		$id = $i;
		$list2 .= "<tr><td>".$row["title"]."</td>
		<td>".$row["process_status"]."</td>
		<td>".$row["updated_at"]."</td>
		<td>
			<button type='submit' name='edit_".$id."' class='btn btn-secondary btn-sm'>編集</button>
		</td></tr>";
	}

	//企業商品紹介一覧(仮)
	$list3 = "";

	for ($i = 10; $i < 12; $i++) {
		$id = $i;

		$list3 .= "<tr><td>".$row["title"]."</td>
		<td>".$row["process_status"]."</td>
		<td>".$row["updated_at"]."</td>
		<td>
			<button type='submit' name='edit_".$id."' class='btn btn-secondary btn-sm'>編集</button>
		</td></tr>";
	}


	
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
			
			<div class="container" style="width: 70%">
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
									<th>処理状況</th>
									<th colspan="2">更新ログ</th>
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
									<th class="col-7">タイトル</th>
									<th>処理状況</th>
									<th colspan="2">更新ログ</th>
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
									<th class="col-7">タイトル</th>
									<th>処理状況</th>
									<th colspan="2">更新ログ</th>
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
		<script src="./js/bootstrap.bundle.min.js"></script>
	</body>
</html>