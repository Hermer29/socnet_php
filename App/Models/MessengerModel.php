<?php
include ("./Core/Model.php");


class MessengerModel extends Model
{ 
  public function getData()
  {
    $query = 'SELECT * FROM "messages"';
    return Model::$pdo -> query($query) -> fetchAll(PDO::FETCH_ASSOC);
  }
  
  public function setData(string $text)
  {
    $query = "INSERT INTO 'messages' (info) VALUES ('{$text}')";
    Model::$pdo -> query($query);
  }
}
$context = new MessengerModel();

if(isset($_POST["message"]))
{
	$message = $_POST["message"];
	$context -> setData($message);
}
else 
{
	$messages = $context -> getData();
	foreach($messages as $message)
	{
		echo "<li>".$message["info"]."</li>";
	}
}

