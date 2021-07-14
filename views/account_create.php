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
      <title>アカウント追加</title>
    </head>

    <body>
      <div id="wrap" class="container">
        <div class="container mini-wrap">
          <div class="row">
            <h1 class="text-center">アカウント追加</h1>
          </div>
          <form name="singUp" method="POST" action="../php/account_create.php">
            <div class="row mb-3">
              <label for="iUser" class="col-3 col-form-label">ユーザー名</label>
              <div class="col-8">
                <input type="name" name="name" class="form-control"id="iUser">
              </div>
            </div>
            <div class="row mb-3">
              <label for="iEmail" class="col-3 col-form-label">Email address</label>
              <div class="col-8">
                <input type="mail" name="mail" id="iEmail" class="form-control">
              </div>
            </div>
            <div class="row mb-3">
              <label for="iPassword" class="col-3 col-form-label">password</label>
              <div class="col-8">
                <input type="password" name="password" class="form-control" id="iPassword">
              </div>
            </div>
            <div class="row mb-3">
              <label for="iPassword2" class="col-3 col-form-label">確認用パスワード</label>
              <div class="col-8">
                <input type="password" name="password2" class="form-control" id="iPassword">
              </div>
            </div>
            <div class="row mb-3">
              <div class="col-3">
                <input type="radio" name="authority" value="0">管理者
              </div>
              <div class="col-3">
                <input type="radio" name="authority" value="1">編集者
              </div>
            </div>
            <button type="submit" name="" class="btn btn-secondary my-2" style="width: fit-content;">アカウント追加</button><br>
          </form>
        </div>

      </div>
    </body>

  </html>