<?php

$host ="localhost";
$db ="dbdonjeta";
$user ="root";
$pass ="";

try{
    $pdo= new PDO("mysql:host=$host,dbname=$db",$user,$pass);

    $sql =  "ALTER TABLE products ADD email VARCHAR(255)";


       $pdo->exec($sql);
       echo "Column is created susscessfully";


}catch(Exception $e){
    echo "Error creating table" . $e->getMessage();
}




?>