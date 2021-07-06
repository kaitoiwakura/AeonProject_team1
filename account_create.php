<?php
  require 'connect.php';
  session_start();
  session_regenerate_id();	//セッションID更新

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


        $sql ='INSERT INTO
        users(name, password, mail, authority)
        VALUES ($name,$mail,$password,$authority)';

        print $sql;

        // $stmt = $pdo->prepare($sql);

        // $stmt->execute();

        //dsn='mysql:dbname=EC;charset=utf8';
        //stmt = $pdo -> prepare("INSERT INTO users(name,mail,password,password2,authority))

  //       $signUpMessage = '登録が完了しました';
  //     }catch(PDOException $e){
  //       //DBエラー
  //       $errorMessage = 'データベースエラー';
  //     }
  //   }
  // else{
  //     $errorMessage = 'パスワードに誤りがあります。';}

?>
