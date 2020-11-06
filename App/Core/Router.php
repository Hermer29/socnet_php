<?php

class Router
{
	public static function find_route($uri)
	{
		if($uri[0] === "")
		{
			$_SERVER["REQUEST_URI"] = "/messenger";
			header("Location: /messenger", true, 303);
			exit;
		}
		$controller = $uri[0];

		$controller[0] = strtoupper($controller[0]);
		$controller .= "Controller";

		if(file_exists("App/Controllers/".$controller.".php"))
		{
			include("App/Controllers/".$controller.".php");
			$controller_instance = new $controller();
			$controller_instance -> action();
		}
		else
		{
			include("App/Views/404.html");
		}
	}
}