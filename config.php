<?php
	class Database {
		private static $dbName = 'iaq'; // Example: private static $dbName = 'myDB';
		private static $dbHost = 'localhost'; // Example: private static $dbHost = 'localhost';
		private static $dbUsername = 'root'; // Example: private static $dbUsername = 'myUserName';
		private static $dbUserPassword = ''; // // Example: private static $dbUserPassword = 'myPassword';
		 
		private static $cont  = null;
		 
		public function __construct() {
			die('Init function is not allowed');
		}
		 
		public static function connect() {
      // One connection through whole application
      if ( null == self::$cont ) {     
        try {
          self::$cont =  new PDO( "mysql:host=".self::$dbHost.";"."dbname=".self::$dbName, self::$dbUsername, self::$dbUserPassword); 
        } catch(PDOException $e) {
          die($e->getMessage()); 
        }
      }
      return self::$cont;
		}
		 
		public static function disconnect() {
			self::$cont = null;
		}

		public static function authenticateUser($username, $password) {
			$pdo = self::connect();
			$sql = "SELECT * FROM users WHERE username = ?";
			$q = $pdo->prepare($sql);
			$q->execute([$username]);
	
			if ($user = $q->fetch()) {
				if (password_verify($password, $user['password'])) {
					return $user;
				}
			}
	
			return false;
		}
	}
?>