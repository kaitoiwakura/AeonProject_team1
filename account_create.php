<?php
  require 'connect.php';
  /* session_start();
  session_regenerate_id();	//セッションID更新 */

  // $_SESSION['id'] = (int)$user['id'];
  // $_SESSION['name'] = $user['name'];
  // $_SESSION['mail'] = $user['mail'];
  // $_POST['password'] = $user['password'];
  // $_SESSION['authority'] = (int) $user['authority'];
  // $_SESSION['creat_at timestamp'] = $user['creat_at timestamp'];
  // $_SESSION['update_at datetime'] = $user['update_at datetime'];
  // $_SESSION['delete_at datetime'] = $user['delete_at datetime'];

  //エラ〜メッセージ
  $errorMessage = "";
  //登録完了初期化
  $singUpMessage = "";

  //新規登録ボタン押した時
  //IDはPOSTされない
    if($_POST["password"] = $_POST["password2"]){
      //入力したもの格納
      $name = $_POST['name'];
      $mail = $_POST['mail'];
      $password = $_POST['password'];
      $authority = $_POST['authority'];

      //エラー処理
      try {
        $con = new connect();
        $pdo = $con->connectdb();


        $sql ="INSERT INTO
        users(name, password, mail, authority)
        VALUES ('$name','$mail','$password','$authority');";

        //print $sql;

        $stmt = $pdo->prepare($sql);

        $stmt->execute();

        header("Location:index.html");
        $signUpMessage = '登録が完了しました';

      }catch(PDOException $e){
        //DBエラー
        $errorMessage = 'データベースエラー';
      }
    }else{
      $errorMessage = 'パスワードに誤りがあります。';}
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

    <title></title>
	</head>
  <body>
		<div id="wrap" class="container">
			<div id="header"></div>
			<div class="container mini-wrap">
				<div style="color: #999999">
					<?php
						print $$signUpMessage;
					?>
				</div>

				<p class="text-center align-middle mt-4">

				</p>
			</div>
		</div>
		<script src="./js/bootstrap.bundle.min.js"></script>
	</body>
</html>
