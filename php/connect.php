<?php
	class connect {
		//接続情報設定
		const DB_NAME = 'aeon';
		const HOST = 'localhost';
		const UTF = 'utf8';
		const USER = 'root';
		const PASSWORD = '';

		function connectdb () {
			$dsn = "mysql:dbname=".self::DB_NAME.";host=".self::HOST.";charset=".self::UTF;
			$user = self::USER;
			$password = self::PASSWORD;
			try {
				$pdo = new PDO($dsn, $user, $password,
					array(
						PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
						PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
					)
				);
			} catch(Exception $e) {
				header('Content-Type: text/html; charset=UTF-8');
				echo $e->getMessage();
			}

			$pdo->setAttribute(PDO::ATTR_STRINGIFY_FETCHES, false);
			return $pdo;
		}
	}
?>