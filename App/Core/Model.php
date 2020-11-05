<?php

abstract class Model
{
	private static $pdo;
	
	public function __construct()
	{
		Model::$pdo = new PDO("sqlite:main.db.sqlite");
	}
}