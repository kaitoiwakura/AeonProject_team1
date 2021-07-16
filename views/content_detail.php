<?php
	require "../php/logincheck.php";
	require '../php/connect.php';

	if((!isset($_POST["news"]) || $_POST["news"] == "") && (!isset($_POST["detail"]) || $_POST["detail"] == "")) {
		header("Location: ../views/index.php");
	}

	if(isset($_POST["news"]) && $_POST["news"] != "") {
		$id = $_POST["news"];

		//DB接続
		$con = new connect();
		$pdo = $con->connectdb();
	
		$stmt = $pdo->prepare('SELECT C.*, N.name as tag, P.name as status FROM contents C JOIN news_category N ON C.news_category = N.id JOIN process_status P ON C.process_status = P.id WHERE C.id = :id');
		$stmt->bindvalue(':id', $id, PDO::PARAM_STR);
		$stmt->execute();
	
		$content = $stmt->fetch();

		$_SESSION['content_newscat'] = $content['news_category'];
	}
	
	if(isset($_POST["detail"]) && $_POST["detail"] != "") {
		$id = $_POST["detail"];

		//DB接続
		$con = new connect();
		$pdo = $con->connectdb();
	
		$stmt = $pdo->prepare('SELECT C.*, P.name as status FROM contents C JOIN process_status P ON C.process_status = P.id WHERE C.id = :id');
		$stmt->bindvalue(':id', $id, PDO::PARAM_STR);
		$stmt->execute();
	
		$content = $stmt->fetch();
	}

	$_SESSION['content_id'] = $id;
	$_SESSION['content_cat'] = $content['contents_category'];
	$_SESSION['content_title'] = $content['title'];
	$_SESSION['content_text'] = $content['content'];
	$_SESSION['content_img'] = $content['image_path'];
	$_SESSION['content_url'] = $content['video_url'];
	$_SESSION['content_status'] = $content['process_status'];
	$_SESSION['content_release'] = $content['released_at'];
	$_SESSION['content_hide'] = $content['deleted_at'];
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

		<title>コンテンツ詳細</title>
	</head>

	<body>
		<div id="wrap" class="container">
			<div id="header"></div>

			<div class="container mini-wrap">
				<?php if($content['contents_category'] == 1) { ?>
					<!-- お知らせの場合 -->
					<div class="row text-center">
						<p class="h3"><?php echo $content['title']; ?></p>
					</div>

					<div class="row">
						<p>カテゴリー：お知らせ(<?php echo $content['tag']; ?>)</p>
						<p>公開開始日：<?php echo $content['released_at']; ?></p>
						<p>公開終了日：<?php echo $content['deleted_at']; ?></p>
						<p>処理状況：<?php echo $content['status']; ?></p>
						<p>内容：</p>
					</div>

					<div class="border border-secondary rounded-3 p-3 mb-3">
						<div class="row mx-auto" style="width: 50%">
							<img src="../upload/images/<?php echo $content['image_path']?>" alt="イメージ">
						</div>

						<div class="row">
							<p><?php echo $content['content']; ?></p>
						</div>
					</div>

				<?php } else if($content['contents_category'] == 2) { ?>
					<!-- HAL学生制作の場合 -->
					<div class="row text-center">
						<p class="h3"><?php echo $content['title']; ?></p>
					</div>

					<div class="row">
						<p>カテゴリー：HAL学生制作</p>
						<p>公開開始日：<?php echo $content['released_at']; ?></p>
						<p>公開終了日：<?php echo $content['deleted_at']; ?></p>
						<p>処理状況：<?php echo $content['status']; ?></p>
						<p>Youtube URL：<a href="<?php echo $content['video_url']; ?>" target="_blank"><?php echo $content['video_url']; ?></a></p>
					</div>

				<?php } else { ?>
					<!-- 企業商品紹介の場合 -->
					<div class="row text-center">
						<p class="h3"><?php echo $content['title']; ?></p>
					</div>

					<div class="row">
						<p>カテゴリー：企業商品紹介</p>
						<p>公開開始日：<?php echo $content['released_at']; ?></p>
						<p>公開終了日：<?php echo $content['deleted_at']; ?></p>
						<p>処理状況：<?php echo $content['status']; ?></p>
						<p>内容：</p>
					</div>

					<div class="border border-secondary rounded-3 p-3 mb-3">
						<div class="row mx-auto" style="width: 50%">
							<img src="../upload/images/<?php echo $content['image_path']?>" alt="イメージ">
						</div>

						<div class="row">
							<p><?php echo $content['content']; ?></p>
						</div>
					</div>
				<?php } ?>

				<div class="row text-center">
					<form id="process" name="process" method="POST" action="">
						<div class="form-check form-check-inline">
							<input class="form-check-input" type="radio" name="action" value="edit" <?php if($content['status'] == "申請" || $content['status'] == "再申請" || $content['status'] == "承認") { echo "disabled"; } ?>>
							<label class="form-check-label me-4">編集</label>
						</div>

						<div class="form-check form-check-inline">
							<input class="form-check-input" type="radio" name="action" value="accept" <?php if(!$is_admin) { echo "disabled"; } ?>>
							<label class="form-check-label me-4">承認</label>
						</div>

						<div class="form-check form-check-inline">
							<input class="form-check-input" type="radio" name="action" value="reject" <?php if(!$is_admin) { echo "disabled"; } ?>>
							<label class="form-check-label me-4">戻し</label>
						</div>

						<div class="form-check form-check-inline">	
							<input class="form-check-input" type="radio" name="action" value="hide">
							<label class="form-check-label me-4">非公開</label>
						</div>

						<div class="row" id="reject-reason">
							<div class="row m-3">
								<label for="reason" class="col-3 col-form-label">却下理由</label>
								<div class="col-8">
									<input type="text" class="form-control" id="reason" name="reason">
								</div>
							</div>
						</div>

						<div class="row">
							<!-- Modal trigger -->
							<button type="button" id="modal-open" class="btn btn-secondary my-2" style="width: fit-content;" data-bs-toggle="modal" data-bs-target="#confirmModal" disabled>
								実行する
							</button>
						</div>
					</form>
				</div>
			</div>
		</div>

		<!-- Modal -->
		<div class="modal fade" id="confirmModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-body">
					<div id="msg"></div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">いいえ</button>
					<button type="summit" form="process" class="btn btn-success">はい</button>
				</div>
			</div>
		</div>

		<script src="../js/bootstrap.bundle.min.js"></script>

		<script type="text/javascript">
			$(document).ready(function() {
				//ラジオボタンの選択状態によって色々変更
				$("[name='action']").change(function() {
					//どれか選択されたらボタンが押せるようになる
					$("#modal-open").prop("disabled", false);

					//選択中のラジオボタンのvalueを取得
					var cur_value = $(this).val();
					var act = "";
					var msg = "";
					
					//valueによって遷移先とmodalの文言を変更
					//編集の場合
					if (cur_value == "edit") {
						act = "./content_edit.php";
						msg = "<div id='msg'>コンテンツを編集します。よろしいですか？</div>";
						$("#reject-reason").hide();
						$('input[type="text"]').prop("required", false);
					}
					//承認の場合
					if (cur_value == "accept") {
						act = "../php/content_accept.php";
						msg = "<div id='msg'>コンテンツを承認します。よろしいですか？</div>";
						$("#reject-reason").hide();
						$('input[type="text"]').prop("required", false);
					}
					//却下の場合
					if (cur_value == "reject") {
						act = "../php/content_reject.php";
						msg = "<div id='msg'>コンテンツを却下します。よろしいですか？</div>";
						$("#reject-reason").show();
						$('input[type="text"]').prop("required", true);
					}
					//非表示の場合
					if (cur_value == "hide") {
						act = "../php/content_hide.php";
						msg = "<div id='msg'>コンテンツを非表示にします。よろしいですか？</div>";
						$("#reject-reason").hide();
						$('input[type="text"]').prop("required", false);
					}

					$("#process").prop("action", act); //formのactionを変える
					$("#msg").replaceWith(msg); //modalの文章を変える
				});
			});
		</script>
	</body>
</html>