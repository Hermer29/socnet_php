<?php
namespace Hermer29\Core;
require "./ModelSystem.php";

class Authentication extends ModelSystem
{
	private const LOGIN_STATEMENT1 = "SELECT login FROM users WHERE login= :login AND password= :password";
	private const REGISTER_STATEMENT2 = "INSERT INTO users (login,password) VALUES (:login,:password)";

	public function login(string $login, string $password)
	{
		$query = $this -> pdo -> prepare(self::LOGIN_STATEMENT1);
		$query -> execute([
			":login" => $login,
			":password" => $password
		]);
		$result = $query -> fetchAll(\PDO::FETCH_ASSOC);
		if(count($result) != 0)
		{
			setcookie("login", $login, strtotime("+30 days"),"/");
			setcookie("password", $password, strtotime("+30 days"),"/");
		}
		else
		{
			throw new \Exception("Wrong login or password");
		}
	}

	public function register(string $login, string $password) : mixed
	{

	}
}