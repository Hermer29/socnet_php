<?php
namespace Hermer29\Core;

use Hermer29\Controllers;

class Router
{
	private $uri;
	public function __construct()
	{
		$this -> uri = explode("/", trim("/", $_SERVER["REQUEST_URI"]));
	}

	public function execute()
	{
		//Locate controller
		$controller = $this -> uri[0] === "" ? "Index": $this -> uri[0];
		$controller = ucfirst($controller);
		$ctrlr_dest = "./classes/$controller"."C.php";
		if(file_exists($ctrlr_dest)) {
			include($ctrlr_dest);
		} else {
			throw new \Exception("Controller \"$controller\" doesn't exists");
		}
		//Create controller sample and execute its main op
		$controller_full_name = "Hermer29\\Controllers\\".$controller;
		$controller_inst = new $controller_full_name;
		$controller_inst -> execute();
	}
}