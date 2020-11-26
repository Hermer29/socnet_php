<?php

namespace Hermer29\Models;

include "Authentication.php";

use Hermer29\Core\Authentication;

$request = $_SERVER["REQUEST_METHOD"];

if($request == "POST")
{
    $auth_example = new Authentication();
    $login = $_POST["login"];
    $password = $_POST["password"];
    try {
        $auth_example -> login($login,$password);
    } catch(\Exception $e) {
        $_SESSION["wrong-pass"] = true;
    }
    header("Location: /");
}
