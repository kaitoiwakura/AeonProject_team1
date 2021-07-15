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
				<div id="header"></div>

        <div class="container mini-wrap">
          <div class="row">
            <h1 class="text-center">アカウント追加</h1>
          </div>

          <form id="signUp" name="signUp" method="POST" action="../php/account_create.php">
            <div class="row mb-3">
              <label for="iUser" class="col-3 col-form-label">ユーザー名</label>
              <div class="col-8">
                <input type="name" name="name" class="form-control" id="iUser" required>
              </div>
            </div>
            <div class="row mb-3">
              <label for="iEmail" class="col-3 col-form-label">メールアドレス</label>
              <div class="col-8">
                <input type="mail" name="mail" class="form-control" id="iEmail" required>
              </div>
            </div>
            <div class="row mb-3">
              <label for="iPassword" class="col-3 col-form-label">パスワード</label>
              <div class="col-8">
                <input type="password" name="password" class="form-control" id="iPassword" required>
              </div>
            </div>
            <div class="row mb-3">
              <label for="iPassword2" class="col-3 col-form-label">確認用パスワード</label>
              <div class="col-8">
                <input type="password" name="password2" class="form-control" id="iPassword" required>
              </div>
            </div>
            <div class="row mb-3 justify-content-center">
              <div class="col-3">
                <input type="radio" name="authority" value="0">管理者
              </div>
              <div class="col-3">
                <input type="radio" name="authority" value="1" checked>編集者
              </div>
            </div>

						<div class="row">
							<!-- Modal trigger -->
							<button type="button" class="btn btn-secondary"  style="width: fit-content;" data-bs-toggle="modal" data-bs-target="#confirmModal">
							アカウント追加
							</button>
						</div>

						<!-- <div class="row">
							<button type="submit" class="btn btn-secondary my-2" style="width: fit-content;">アカウント追加</button>
						</div> -->
          </form>
        </div>
      </div>

			<!-- Modal -->
			<div class="modal fade" id="confirmModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-body">
						アカウントを追加します。よろしいですか？
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">いいえ</button>
						<button type="summit" form="signUp" class="btn btn-success">はい</button>
					</div>
				</div>
			</div>

			<script src="../js/bootstrap.bundle.min.js"></script>
    </body>
  </html>
