<?php
include("App/Core/Router.php");
session_start();

$url = $_SERVER["REQUEST_URI"];
$url = UrlCutter::cut($url);
Router::find_route($url);



class UrlCutter
{//Cuts url, delimit it by slashes
	public static function cut($url)
	{
		return explode("/", strtolower(trim("/", $url)));
	}
}