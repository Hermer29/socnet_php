<?php
include ("./Core/Model.php");


class MessengerModel extends Model
{ 
  public function get_data()
  {
    $query = 'SELECT * FROM "messages"';
    return Model::$pdo -> query($query) -> fetchAll(PDO::FETCH_ASSOC);
  }
  
  public function set_data(string $text)
  {
    $query = "INSERT INTO 'messages' (info) VALUES ('{$text}')";
    Model::$pdo -> query($query);
  }
}
$context = new MessengerModel();

if(isset($_POST["message"]))
{
	$message = $_POST["message"];
	$context -> set_data($message);
}
else 
{
	$messages = $context -> get_data();
	foreach($messages as $message)
	{
		echo "<li>".$message["info"]."</li>";
	}
}

