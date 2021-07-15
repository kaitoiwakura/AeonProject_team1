<?php
	require "../php/logincheck.php";
	require '../php/connect.php';

	$list = "";

	//ユーザー名を取得
	$con = new connect();
	$pdo = $con->connectdb();

	$stmt = $pdo->prepare("SELECT contents_title, process_status, log_comment, name, L.updated_at FROM logs L JOIN users U ON L.updater_id = U.id");
	$stmt->execute();

	$list = "";
	if($stmt->columnCount() === 0) {
		$list = "データがありません";
	} else {
		$logs = $stmt->fetchall();
		foreach($logs as $log) {
			//$logs_list[] = $log;	//jsにデータを渡すための変数
			$list .= "<tr class='log-row'><td>".$log['contents_title']."</td>";
			$list .= "<td>".$log['process_status']."</td>";
			$list .= "<td>".$log['log_comment']."</td>";
			$list .= "<td>".$log['name']."</td>";
			$list .= "<td>".$log['updated_at']."</td></tr>";
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

		<title>ログ</title>
	</head>

	<body>
		<div id="wrap" class="container">
			<div id="header"></div>

			<div class="container mini-wrap">

				<div class="row justify-content-end">
					<div class="col-5 mb-4">
						<input class="form-control" type="text" id="keyword" placeholder="検索">
					</div>
				</div>

				<div class="row">
					<table class="table table-hover">
						<thead>
							<tr>
								<th>タイトル</th>
								<th class="col-1">処理状況</th>
								<th class="col-4">処理内容</th>
								<th class="col-1">作成者</th>
								<th class="col-2">更新日時</th>
							</tr>
						</thead>
						<tbody>
							<?php print $list; ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>

		<script src="../js/bootstrap.bundle.min.js"></script>

		<script type="text/javascript">
			const yougo_area = document.getElementById('sample_area');
			const yougo_parts = document.getElementsByClassName('log-row');
			const input = document.getElementById('keyword');

			input.addEventListener('input',()=>{
				reset();
				const sword = input.value;
				if(sword==''){return}
				const regexp = new RegExp(`(?<=>)[^<>]*?(${sword})[^<>]*?(?=<)`,'gi');
				const regexp2 = new RegExp(sword,'gi');
				[...yougo_parts].forEach(part=>{
					if(part.textContent.indexOf(sword)==-1){
						part.classList.add('hide');
					}
				});
			});

			function reset(){
				console.log('reset');
				[...document.getElementsByClassName('hide')].forEach(el=>{
					el.classList.remove('hide');
				});
			}
		</script>
	</body>
</html>