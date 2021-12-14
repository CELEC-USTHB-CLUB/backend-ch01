<?php 

class Form {

	public PDO $pdo;

	public function __construct() {
		try {		
			$pdo = new PDO('mysql:host=0.0.0.0:3300;dbname=celec', 'root', 'root');
		} catch (Exception $e) {
			var_dump($e);
			exit;
		}
		$this->pdo = $pdo;
	}

	public function emptyData(array $data, array $files) : bool {
		return (empty($data["username"]) OR empty($data["email"]) OR empty($data["password"]) OR !is_uploaded_file($files["picture"]["tmp_name"]));
	}

	public function validEmail(string $email) : bool {
		return filter_var($email, FILTER_VALIDATE_EMAIL);
	}

	public function isEmailUnique(string $email) : bool {
		$sql = "SELECT COUNT(email) as counter FROM users WHERE email = ?";
		$stm = $this->pdo->prepare($sql);
		$stm->execute([$email]);
		return (int)($stm->fetch()["counter"]) === 0;
	}

	public function checkFileSize(array $fileInfo, float $size) : bool {
		return $fileInfo["size"] < $size;
	}

	public function checkFileType(array $fileInfo, string $mime) : bool {
		$checkIfImage = getimagesize($fileInfo["tmp_name"]);
		if (!$checkIfImage) {
			return false;
		}
		return $checkIfImage["mime"] === $mime;
	}

	public function uploadFile(array $fileInfo, string $dir) : bool {
		$name = $this->generateRandomName();
		return move_uploaded_file($fileInfo["tmp_name"], $dir.$name.".png");
	}

	public function generateRandomName() : string {
		return md5(time());
	}

}