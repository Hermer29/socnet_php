<?php
session_start();
include "./classes/Router.php";

use Hermer29\Core\Router;

$pathfinder = new Router();
$pathfinder -> execute();