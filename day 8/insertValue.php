<?php

$host ="localhost";
$db ="dbdonjeta";
$user ="root";
$pass ="";

try{
    $pdo= new PDO("mysql:host=$host,dbname=$db",$user,$pass);
     
$username="toenaaa";
$password="toenaaa123";

$sql= "INSERT INTO users (id,username,password)Values (1,'$username','$password')";

       $pdo->exec($sql);
       echo "User is addedd";
}catch(Exception $e){
    echo "Error creating table" . $e->getMessage();
}




?>