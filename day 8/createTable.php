<?php

$host ="localhost";
$db ="dbdonjeta";
$user ="root";
$pass ="";

try{
    $pdo= new PDO("mysql:host=$host,dbname=$db",$user,$pass);
    $sql = "CREATE TABLE users (
       id INT(6) NOT NULL PRIMARY KEY,
       username VARCHAR(30) NOT NULL,
       password varchar(50) Not null)";

       $pdo->exec($sql);
       echo "Table is created susscessfully";
}catch(Exception $e){
    echo "Error creating table" . $e->getMessage();
}




?>