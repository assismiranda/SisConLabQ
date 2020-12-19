<?php

	include_once 'conexao.php';
	$pdo = conectar();
	session_start();
	# recuperando os dados enviados via post:
	$desc_Classe = filter_input(INPUT_POST, 'desc_Classe', FILTER_SANITIZE_STRING);
	$email = $_SESSION['user'];

	$sql = $pdo->prepare("INSERT INTO lab.classe (desc_Classe, email)  VALUES (:desc_Classe, :email)");

	$sql->bindValue(":desc_Classe",$desc_Classe);
	$sql->bindValue(":email",$email);

	$conn = $sql->execute();

	if($conn){
		echo true;
	}else{
		echo false;
	}
?>