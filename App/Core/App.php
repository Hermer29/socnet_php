<?php

class App
{
    private const router = "App/Core/Router.php";
    public function __construct()
	{
		if(session_status() == 0)
		{
			session_start();
        }
		include(self::router);
        $url = $_SERVER["REQUEST_URI"];

        $url = UrlCutter::cut($url);
        if(isset($_SESSION["REDIRECT"]))
		{
            unset($_SESSION["REDIRECT"]);
            $url = UrlCutter::cut($_SESSION["REDIRECT"]);
		}
		else if($url[0] === "")
		{
            $_SESSION["REDIRECT"] = "/messenger";
			header("Location: /messenger", true, 303);
			exit;
		}
		Router::findRoute($url);
	}
}

class UrlCutter
{//Cuts url, delimit it by slashes
	public static function cut($url)
	{
		return explode("/", strtolower(trim("/", $url)));
	}
}