<?php
session_start();

include("App/Core/Router.php");

$router = new Router();

$router -> find_route();


