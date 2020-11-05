<?php

class Router
{
	public function find_route()
	{
		$uri = $_SERVER["REQUEST_URI"];
		$uri = trim("/", $uri);
		$uri = explode("/", $uri);

		
	}
}

