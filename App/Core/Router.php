<?php

class Router
{
	/* 	
		Router manipulates with Pathfinder class
		get controller instance and execute 
		specified controller method/action
	*/
	public static function findRoute(string $uri) : void
	{
		if($uri[0] === "")
		{
			$_SERVER["REQUEST_URI"] = "/messenger";
			header("Location: /messenger", true, 303);
			exit;
		}
		$controller = $uri[0];

		$controller_inst = Pathfinder::findController($controller);
	}
}

class Pathfinder
{
	private const err_ctrlr_path = "App/Controllers/Controller404.php";
	public static function findController(string $ctrlr_name) : Controller
	{
		$ctrlr_name[0] = strtoupper($ctrlr_name[0]);
		$ctrlr_name .= 'Controller';
		$ctrlr_path = "App/Controllers/".$ctrlr_name.".php";

		if(file_exists($controller_path))
		{
			include($ctrlr_path);
		}
		else
		{
			include($err_ctrlr_path);
			$ctrlr_name = "Controller404";
		}

		return new $controller_name();
	}
}