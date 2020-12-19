<?php
	$id=$_POST['id'];
	session_start();
	include_once 'conexao.php';
	$pdo = conectar();
	
	//echo "<script>alert('$id');</script>";
	$name;
	$tmp_name;
	$error;
	$location;

	if ($_FILES["anexo"]["name"] != "") {
		$name = $_FILES["anexo"]["name"];

		$tmp_name = $_FILES['anexo']['tmp_name'];

		$error = $_FILES['anexo']['error'];

		$location = 'upload/';

		move_uploaded_file($tmp_name, $location.$name);
	  }
	
	$anexo = $location."".$name;
	//echo "<script>alert('$anexo');</script>";

	$sql = $pdo->prepare("UPDATE lab.reagente SET anexo=:anexo WHERE cas='$id'");

	$sql->bindValue(":anexo",$anexo);
	//var_dump($sql);

	try{
		$conn = $sql->execute();
		$_SESSION['erro'] = "OK";
		header("location:anexo.php?id=$id");
	}catch(Exception $e){
		$_SESSION['erro'] = "ERRO";
		header("location:anexo.php?id=$id");
	}
	
?>