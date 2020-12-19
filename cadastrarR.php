<?php

	include_once 'conexao.php';
	$pdo = conectar();
	session_start();
	# recuperando os dados enviados via post:
	$desc_Risco = filter_input(INPUT_POST, 'desc_Risco', FILTER_SANITIZE_STRING);
	$email = $_SESSION['user'];

	$sql = $pdo->prepare("INSERT INTO lab.risco (desc_Risco, email)  VALUES (:desc_Risco, :email)");

	$sql->bindValue(":desc_Risco",$desc_Risco);
	$sql->bindValue(":email",$email);

	$conn = $sql->execute();

	if($conn){
		echo true;
	}else{
		echo false;
	}
?>