<?php
try{
$host="localhost";
$username="root";
$password="";
$database="web";
$pdo = new PDO("mysql:host=$host;dbname=Project", $username , $password);
// See the "errors" folder for details...
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $error){
    $error->getMessage();
}