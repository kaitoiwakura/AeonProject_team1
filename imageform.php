<?php
	session_start();
	if(isset($_SESSION['contentId'])) {
		$id = $_SESSION['contentId'];
	}	else {
		/**
		 * 後に画像を変更する処理を加える際に$_SESSION['contentId']にcontentidを入れるのを忘れない
		 */
		header("Location:index.html");
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

			<title>画像アップロード</title>
		</head>

	<body>

		<div id="wrap" class="container">
			<div id="header"></div>

			<div class="container" style="width: 70%">
				<div class="row align-items-center align-self-center">
					<!-- php側で$_FILES['input type=fileのname']でデータを取得する -->
					<form action="uploadimage.php" id="imageform" method="POST" enctype="multipart/form-data">
						<!-- <input type="file" name="upimage" accept="image/*">
						<input type="submit" value="画像UPLOAD"> -->
						<div class="input-group">
							<input type="file" class="form-control" name="upimage" accept="image/*" title="画像選択">
							<button type="submit" class="btn btn-secondary m-0" style="width: fit-content;">UPLOAD</button>
						</div>
					</form>
				</div>
			</div>
		</div>
		
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script type="text/javascript">
			//画像を加えたいnewsのidを設定
			let behindId = '<input type="hidden" name = "contentid" value ="' +  <?php echo (string)$id; ?> + '">';
			$('#imageform').append(behindId);
		</script>
	</body>
</html>