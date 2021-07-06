<?php
  require 'connect.php';
  session_start();
  session_regenerate_id();	//セッションID更新

  $con = new connect();	//クラス呼び出し
	$pdo = $con->connectdb();	//PDo作成


  $_SESSION['id'] = (int)$user['id'];
  $_SESSION['name'] = $user['name'];
  $_SESSION['mail'] = $user['mail'];
  $_POST['password'] = $user['password'];
  $_SESSION['authority'] = (int) $user['authority'];
  $_SESSION['creat_at timestamp'] = $user['creat_at timestamp'];
  $_SESSION['update_at datetime'] = $user['update_at datetime'];
  $_SESSION['delete_at datetime'] = $user['delete_at datetime'];

  //エラ〜メッセージ
  $errorMessage = "";
  //登録完了初期化
  $singUpMessage = "";

  //新規登録ボタン押した時
  //IDはPOSTされない
  if(isset($_SESSION['singUp'])){
    //ユーザID未入力

    if (empty($_SESSION["name"])) {
        $errorMessage = '名前が未入力です。';
    }else if (empty($_SESSION["mail"])) {
        $errorMessage = 'メールアドレスが未入力です。';
    }else if (empty($_POST["password"])) {
        $errorMessage = 'パスワードが未入力です。';
    }else if (empty($_POST["password2"])) {
        $errorMessage = '再パスワードが未入力です。';
    }
    if(!empty($_SESSION["name"]) && !empty($_SESSION["mail"]) &&!empty($_POST["password"])&& $_POST["password"]= $_POST["password2"]&& !empty($_POST["password2"])){
      //入力したもの格納
      $name = $_SESSION['name'];
      $mail = $_SESSION['mail'];
      $password = $_POST['password'];



      //認証
      $dns = sprintf('mysql: host=%s; dbname=%s; charset=utf8 ',$db['host'], $db['name']);



      //エラー処理
    // try {
    //   $pdo = new PDO($dsn,$ &,array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
    //   $stmt = $pdo->prepare("INSERT INTO userData(name,  password,  ) VALUES (?, ?)");
    //   //dsn='mysql:dbname=EC;charset=utf8';
    //   //stmt = $pdo -> prepare("INSERT INTO users(name,mail,password,password2,authority))
    //   $signUpMessage = '登録が完了しました';
    // }catch(PDOException $e){
    //   //DBエラー
    //   $errorMessage = 'データベースエラー';
    // }if($_POST["password"] != $_POST["password2"]){
    //   $errorMessage = 'パスワードに誤りがあります。';
    // }

  }
}



?>
