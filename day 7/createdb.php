<?php
$host="localhost";
$user="root";
$pass=" ";

try{

    $conn = new PDO("mysql;host=$host",$user,$pass);
     echo"connected";

     $sql="Create database toenadb";
     $conn->exec($sql);
     echo"The database was created.";

}catch (Exception $t){
     echo"not connected";
}
 

?>