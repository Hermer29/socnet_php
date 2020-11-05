<?php

class Router
{
	public function find_route()
	{
		$uri = $_SERVER["REQUEST_URI"];
		$uri = trim("/", $uri);
		$uri = explode("/", $uri);

		$controller = $uri[0];
		$redirected = $_SESSION["redir"];
		if($controller == null && $redirected)
		{
			header("Location: /messenger");
			$_SESSION["redir"] = true;
			exit;
		}

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