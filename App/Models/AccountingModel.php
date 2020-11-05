<?php
include ("./Core/Model.php");


class AccountingModel extends Model
{ 
  public function login(string $login, string $password)
  {
    $query = 'SELECT $login = $password FROM "accounts" WHERE $login = $password';
    $is_exists = Model::$pdo -> query($query) -> fetchAll(PDO::FETCH_ASSOC);
    if($is_exists)
    {
        $_SESSION["authenticated"] = true;
        setcookie("login", $login, 60*1000*1000);
        setcookie("password", $password, 60*1000*1000);
        return 1;
    }
    return 0;
  }
  
  public function register(string $login, string $password)
  {
    $query = "SELECT $login = $password FROM 'accounts' WHERE $login = $password";
    $is_acc_exists = Model::$pdo -> query($query) -> fetchAll(PDO::FETCH_ASSOC); 
    if(!$is_acc_exists)
    {
        $query = "INSERT INTO 'accounts' (account_name, password) VALUES ('$login', '$password')";
        Model::$pdo -> query($query);
        setcookie("login", $login, 60*1000*1000);
        setcookie("password", $password, 60*1000*1000);
        $_SESSION["authenticated"] = true;
        return 1;
    }
    $_SESSION["authenticated"] = false;
    return 0;
  }}
$context = new AccountingModel();

if(isset($_POST["loginOp"]))
{
    $login = $_POST["login"];
    $password = $_POST["password"];
    $result = $context -> login($login, $password);
    echo $result;
    
}
else if(isset($_POST["registerOp"]))
{
    $login = $_POST["login"];
    $password = $_POST["password"];
    $result = $context -> register($login, $password);
    echo $result;
}
else 
{
    echo 2;
}

