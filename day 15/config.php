
<?php

include_once("config.php");

session_start();

$user="root";
$pass="";
$server="localhost";
$dbname="dbdiar";

try{

    $conn= new PDO("mysql:host=$server; dbname=$dbname", $user, $pass);

    echo "connected to database";

}catch(PDOException $e){
 echo "error : ". $e->getMessage();
}
 

  ?>