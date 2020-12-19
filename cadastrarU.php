<?php
	session_start();
	include_once 'conexao.php';
	$pdo = conectar();
	
	# recuperando os dados enviados via post:
	$email = $_POST['email'];
	$senha = $_POST['senha'];
	$area_Pessoa = $_POST['area_Pessoa'];
	$tipo = $_POST['tipo'];

	$sql = $pdo->prepare("INSERT INTO lab.pessoa(email,senha,area_Pessoa,tipo)  VALUES (:email,:senha,:area_Pessoa,:tipo)");

	$sql->bindValue(":email",$email);
	$sql->bindValue(":senha",$senha);
	$sql->bindValue(":area_Pessoa",$area_Pessoa);
	$sql->bindValue(":tipo",$tipo);
	
	try{
		$conn = $sql->execute();
		 
		$_SESSION['erro'] = "OK";
		header("location: index.php");
		//echo "<script> window.location('index.php');</script>";
	}catch(Exception $e){
		$_SESSION['erro'] = "ERRO";
		header("location: index.php");
		//echo "<script> window.location('index.php');</script>";
		//echo "Erro";
		//echo "<script> alert('Erro ao cadastrar o usuário!');</script>";
		   
	}
?>