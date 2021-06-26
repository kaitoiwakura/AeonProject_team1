<?php
	require 'db_connect.php';

	$list = "";

	//ユーザー名を取得
	$sql = "SELECT id, name, authority FROM users";
	$query = mysqli_query($con,$sql) or die("SQL失敗");
	if (mysqli_num_rows($query) == 0) {
		$list = "データがありません";
	} else {
		while ($result = mysqli_fetch_array($query)) {
			$users_list[] = $result;
			$list .= "<tr><td>".$result[1]."</td><td class='col-4'>";
			$list .= "<select name='".$result[0]."' class='form-select'>";
			$list .= "<option value='0'>管理者</option><option value='1'>編集者</option></select></td></tr>";
		}
	}
?>
				
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

		<title>アカウント管理</title>
	</head>

	<body>
		<div id="wrap" class="container">
			<div id="header"></div>

			<div class="container" style="width: 70%">
				<form id="changeAuthority" name="changeAuthority" method="post" action="authority_change.php">
					<div class="row">
						<table class="table table-hover">
							<tbody>
								<?php print $list; ?>
							</tbody>
						</table>
					</div>

					<div class="row">
						<!-- Modal trigger -->
						<button type="button" class="btn btn-secondary"  style="width: fit-content;" data-bs-toggle="modal" data-bs-target="#confirmModal">
							変更する
						</button>
					</div>
				</form>
			</div>
		</div>

		<!-- Modal -->
		<div class="modal fade" id="confirmModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-body">
					ユーザーの権限を変更します。よろしいですか？
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">いいえ</button>
					<button type="summit" form="changeAuthority" class="btn btn-success">はい</button>
				</div>
			</div>
		</div>
	</div>

		<script src="./js/bootstrap.bundle.min.js"></script>

		<script type="text/javascript">
			var users_list = <?php echo json_encode($users_list); ?>;
			console.log(users_list);

			var selector;
			users_list.forEach(function(item, i) {
					selector = document.getElementsByName(item[0]);
					$(selector).val(item[2]);
			});
		</script>
	</body>
</html>