<?php
namespace Hermer29\Core;
require "./ModelSystem.php";
require "./Exceptions.php";

use Hermer29\Core\Exceptions as Exceptions;

class Authentication extends ModelSystem
{
	private function executeQuery(string $statement, array $data = []) : mixed //I want to implement options
	{
		$statement_list = [
			"GET" => "SELECT login FROM users WHERE login= :login AND password= :password",
			"SET" => "INSERT INTO users (login,password) VALUES (:login,:password)"
		];
		try
		{
			$query = $this -> pdo -> prepare(self::STATEMENT_LIST[$statement]);
		}
		catch(OutOfBoundsException $ex)
		{
			throw new Exceptions\InternalException("Operation $statement not found (maybe you didn't implement it)");
		}
		$query -> execute(array_map(function ($elem)
		{
			$elem = ":".$elem;
		}, $data));
		return $query -> fetchAll(\PDO::FETCH_ASSOC);
	}

	private function checkAccountExistence(string $login, string $password) : bool
	{
		$result = executeQuery("GET", ["login" => $login, "password" => $password]);
		return count($result) != 0;
	}

	public function login(string $login, string $password) : void
	{
		if(checkAccountExistence($login, $password))
		{ /* If account exists */
			setcookie("login", $login, strtotime("+30 days"),"/");
			setcookie("password", $password, strtotime("+30 days"),"/");
		}
		else
		{
			throw new Exceptions\ExternalException("Account not found");
		}
	}

	public function register(string $login, string $password) : void
	{
		if(!checkAccountExistence($login, $password))
		{ /* If account doesn't exists */
			$result = executeQuery("SET", ["login" => $login, "password" => $password]);
		}
		else
		{
			throw new Exceptions\ExternalException("Account with this login already exists");
		}
	}
}