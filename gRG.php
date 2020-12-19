<?php
	
	session_start();
	include_once 'conexao.php';
	$pdo = conectar();
	
	# recuperando os dados enviados via post:
	$cas = filter_input(INPUT_POST, 'cas', FILTER_SANITIZE_NUMBER_INT);
	$lote = filter_input(INPUT_POST, 'lote', FILTER_SANITIZE_STRING);
	$qtd_Reag = filter_input(INPUT_POST, 'qtd_Reag', FILTER_SANITIZE_STRING);
	$desc_Reag = filter_input(INPUT_POST, 'desc_Reag', FILTER_SANITIZE_STRING);

	$sql1 = $pdo->prepare("SELECT qtd_reag from lab.estoquereag WHERE cas = '$cas' and lote = '$lote'");
	$result = $sql1->execute();
	$exibir = $sql1->fetch(PDO::FETCH_ASSOC);
	$qtd_velho = $exibir['qtd_reag'];

	$qtd_novo =$qtd_velho - (float)$qtd_Reag;
	

	$sql = $pdo->prepare("UPDATE  lab.estoquereag SET qtd_reag=:qtd_novo  WHERE cas='$cas' and lote = '$lote'");

	$sql->bindValue(":qtd_novo",$qtd_novo);
	$sql2 = $pdo->prepare("UPDATE  lab.estoquereag SET desc_reag=:desc_reag  WHERE cas='$cas' and lote = '$lote'");
	$sql2->bindValue(":desc_reag",$desc_Reag);
	
	
	try{
		$conn = $sql->execute();
		$conn = $sql2->execute();
		$_SESSION['erro'] = "OK";
		header("location:gestaoRG.php");
	}catch(Exception $e){
		echo false;
		$_SESSION['erro'] = "ERRO";
		header("location:gestaoRG.php");
	}
?>