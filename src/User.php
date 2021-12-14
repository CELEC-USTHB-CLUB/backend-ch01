<?php 

class User {

	public PDO $pdo;

	public function __construct(PDO $pdo) {
		$this->pdo = $pdo;
	}

	public function create(array $data) : bool {
		$sql = "INSERT INTO users (id, username, email, password) VALUES (null, ?, ?, ?)";
		return $this->pdo->prepare($sql)->execute([
			$data["username"], $data["email"], password_hash($data["password"], PASSWORD_BCRYPT)
		]);
	}

}