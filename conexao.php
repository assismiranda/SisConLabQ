<?php

function conectar(){
	//$servername = "10.90.24.54";
	$servername = "200.18.128.54";
	$username = "karla";
	$password = "karla";

	try {
		$conn = new PDO("pgsql:host=$servername;dbname=karla",$username,$password);
		//$conn = new PDO('mysql:host=localhost;dbname=bdpessoa', 'root', '');
	    // set the PDO error mode to exception
	    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	    //echo true;
	}
	catch(PDOException $e){
	    echo "Falha na conexao: " . $e->getMessage();
	    //echo false;
	}
	return $conn;
}

//conectar();

?>