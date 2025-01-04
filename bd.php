<?php

$host = "localhost";
$user = "root";
$password = "";
$dbname = "paneladministracion";

try{
	$conexion = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
}catch(PDOException $e){
	echo "Error de conexion: ".$e.getMessage();
}

?>