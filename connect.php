<?php
$localhost="localhost";
$username="root";
$password="";
$database="newbank";


try{
    $dns = "mysql:host=".$localhost.";dbname=".$database;
    $pdo = new PDO($dns,$username,$password); 
}catch(\Exception $e){
  echo "Error:";
}


?>