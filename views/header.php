<?php require "../php/logincheck.php"; ?>

<nav class="navbar fixed-top mx-auto">
  <div class="container-fluid">
    <a class="navbar-brand" href="./index.php">
			<svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-house-fil text-secondary" viewBox="0 0 16 16">
				<path fill-rule="evenodd" d="m8 3.293 6 6V13.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5V9.293l6-6zm5-.793V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z"/>
				<path fill-rule="evenodd" d="M7.293 1.5a1 1 0 0 1 1.414 0l6.647 6.646a.5.5 0 0 1-.708.708L8 2.207 1.354 8.854a.5.5 0 1 1-.708-.708L7.293 1.5z"/>
			</svg>
		</a>

		<ul class="nav justify-content-end">
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle btn btn-outline-secondary" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">メニュー</a>
				<ul class="dropdown-menu">
					<?php if ($is_admin): ?>
						<li>
							<a class="dropdown-item" href="./users_list.php">ユーザー管理</a>
							<hr class="dropdown-divider">
						</li>
					<?php endif; ?>
					<li><a class="dropdown-item" href="./createnews.php">コンテンツ追加</a></li>
					<li><a class="dropdown-item" href="./contents_list.php">コンテンツ一覧</a></li>
					<li><a class="dropdown-item" href="./logs.php">更新ログ</a></li>
					<li><a class="dropdown-item" href="./change_password.php" class="list-group-item list-group-item-action">パスワード変更</a></li>
				</ul>
			</li>
				
			<li class="nav-item">
				<a class="nav-link btn btn-outline-secondary ms-1" href="#">ログアウト</a>
			</li>    
		</ul>
  </div>
</nav>