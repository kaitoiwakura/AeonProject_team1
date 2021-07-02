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
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
</head>
<body>
	<h1>1</h1>
	<!-- php側で$_FILES['input type=fileのname']でデータを取得する -->
	<form action="uploadimage.php" id="imageform" method="POST" enctype="multipart/form-data">
		<input type="file" name="upimage" accept="image/*">
		<input type="submit" value="画像UPLOAD">
	</form>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script type="text/javascript">
		//画像を加えたいnewsのidを設定
		let behindId = '<input type="hidden" name = "contentid" value ="' +  <?php echo (string)$id; ?> + '">';
		$('#imageform').append(behindId);
	</script>
</body>
</html>