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

		<title>コンテンツ作成</title>
	</head>

	<body>
		<div id="wrap" class="container">
			<div id="header"></div>
			
			<div class="container mini-wrap">
				<!-- ニュース作成用フォームのひな形 name属性だけは指定されてるのを使って -->
				<form action="../php/createnews.php" id="newsform" method="POST" enctype="multipart/form-data">
					<div class="mb-3">
						<label for="title" class="form-label">タイトル</label>
						<input type="text" class="form-control" id="iTitle" name="title">
					</div>
					<div class="mb-3">
						<label for="content" class="form-label">本文</label>
						<textarea class="form-control" id="iContent" rows="10" name="content"></textarea>
					</div>
					<div class="row mb-3 gx-0 justify-content-center">
						<label for="iContentCategory" class="col-3 col-form-label">コンテンツ種類</label>
						<div id="contents-category" class="col-5"></div>
					</div>
					<div class="row mb-3 gx-0 justify-content-center">
						<label for="iNewsCategory" class="col-3 col-form-label">お知らせカテゴリー</label>
						<div id="news-category" class="col-5"></div>
					</div>
					<div class="row">
						<button type="submit" class="btn btn-secondary my-2" style="width: fit-content;">作成</button>
					</div>


					<!-- <label for="title">タイトル</label>
					<input type="text" name="title"><br>
					<label for="content">本文</label>
					<textarea name="content" rows="4" cols="40"></textarea><br>
					<input type="submit" value="作成"> -->
				</form>
			</div>
		</div>
			
		<script src="../js/bootstrap.bundle.min.js"></script>
		<script type="text/javascript">
			$(function(){	//セレクタの内容をDBから取得して表示
				$.ajax({
					tpe: "POST",
					url: "../php/loadcategory.php",
					cache: false
				}).done(function(data){
					let result =JSON.parse(data);
					/**
					 * resultの中身、値の内容個数は可変
					 * { "contents":["A","BBB"],
					 * 	"news":["Cc","DD","ee"]}
					 * result["contents"][0] = A
					 * result["news"][2] = ee
					 */
					
					let content ='<select name="contents_category" class="form-select">';
					for(let element of result["contents"]) {
						content +='<option value="' + element + '" name="contentCategory">' + element + '</option>';
					}
					content +='</select>';
					//$('#newsform').append(content);
					$('#contents-category').append(content);
					
					let news ='<select name="news_category" class="form-select">';
					for(let element of result["news"]) {
						news +='<option value="' + element + '" name="newsCategory">' + element + '</option>';
					}
					news +='</select>';
					//$('#newsform').append(news);
					$('#news-category').append(news);

					}).fail(function(){
					alert("loadcategory.phpエラー")
				});
			});
		</script>
	</body>
</html>