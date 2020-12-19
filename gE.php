<?php
	
	session_start();
	include_once 'conexao.php';
	$pdo = conectar();
	
	# recuperando os dados enviados via post:
	$id_Equip = filter_input(INPUT_POST, 'id_Equip', FILTER_SANITIZE_NUMBER_INT);
	$desc_Equip = filter_input(INPUT_POST, 'desc_Equip', FILTER_SANITIZE_STRING);
	$qtd_Equip = filter_input(INPUT_POST, 'qtd_Equip', FILTER_SANITIZE_NUMBER_INT);

	$sql1 = $pdo->prepare("SELECT qtd_equip from lab.estoqueequip WHERE id_equip = '$id_Equip'");
	$result = $sql1->execute();
	$exibir = $sql1->fetch(PDO::FETCH_ASSOC);
	$qtd_velho = $exibir['qtd_equip'];

	$qtd_novo =$qtd_velho - (int)$qtd_Equip;
	

	$sql = $pdo->prepare("UPDATE  lab.estoqueequip SET qtd_equip=:qtd_novo  WHERE id_equip='$id_Equip'");

	$sql->bindValue(":qtd_novo",$qtd_novo);
	$sql2 = $pdo->prepare("UPDATE  lab.estoqueequip SET desc_equip=:desc_equip  WHERE id_equip='$id_Equip'");
	$sql2->bindValue(":desc_equip",$desc_Equip);
	
	
	try{
		$conn = $sql->execute();
		$conn = $sql2->execute();
		$_SESSION['erro'] = "OK";
		header("location:gestaoE.php");
	}catch(Exception $e){
		echo false;
		$_SESSION['erro'] = "ERRO";
		header("location:gestaoE.php");
	}
?>