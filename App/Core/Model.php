<?php

abstract class Model
{
	private static $pdo;
	
	public function __construct()
	{
		Model::$pdo = new PDO("sqlite:main.db");
	}
	
	public abstract function get_data();
	
	public abstract function set_data(array $data);
}