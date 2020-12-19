<?php
	
	session_start();
	include_once 'conexao.php';
	$pdo = conectar();
	
	# recuperando os dados enviados via post:
	$id_Mat = filter_input(INPUT_POST, 'id_Mat', FILTER_SANITIZE_NUMBER_INT);
	$desc_Mat = filter_input(INPUT_POST, 'desc_Mat', FILTER_SANITIZE_STRING);
	$qtd_Mat = filter_input(INPUT_POST, 'qtd_Mat', FILTER_SANITIZE_NUMBER_INT);

	$sql1 = $pdo->prepare("SELECT qtd_mat from lab.estoquemat WHERE id_mat = '$id_Mat'");
	$result = $sql1->execute();
	$exibir = $sql1->fetch(PDO::FETCH_ASSOC);
	$qtd_velho = $exibir['qtd_mat'];

	$qtd_novo =$qtd_velho - (int)$qtd_Mat;
	

	$sql = $pdo->prepare("UPDATE  lab.estoquemat SET qtd_mat=:qtd_novo  WHERE id_mat='$id_Mat'");

	$sql->bindValue(":qtd_novo",$qtd_novo);
	$sql2 = $pdo->prepare("UPDATE  lab.estoquemat SET desc_mat=:desc_mat  WHERE id_mat='$id_Mat'");
	$sql2->bindValue(":desc_mat",$desc_Mat);
	
	
	try{
		$conn = $sql->execute();
		$conn = $sql2->execute();
		$_SESSION['erro'] = "OK";
		header("location:gestaoM.php");
	}catch(Exception $e){
		echo false;
		$_SESSION['erro'] = "ERRO";
		header("location:gestaoM.php");
	}
?>