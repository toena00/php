<?php
$host="localhost";
$user="root";
$pass=" ";

try{

    $conn = new PDO("mysql;host=$host",$user,$pass);
     echo"connected";

}catch (Exception $t){
     echo"not connected";
}
 

?>