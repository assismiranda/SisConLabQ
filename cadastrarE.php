<?php

	include_once 'conexao.php';
	$pdo = conectar();
	
	# recuperando os dados enviados via post:
	$id_Equip = filter_input(INPUT_POST, 'id_Equip', FILTER_SANITIZE_NUMBER_INT);
	$desc_Equip = filter_input(INPUT_POST, 'desc_Equip', FILTER_SANITIZE_STRING);
	$area_Equip = filter_input(INPUT_POST, 'area_Equip', FILTER_SANITIZE_STRING);
	$local_Equip = filter_input(INPUT_POST, 'local_Equip', FILTER_SANITIZE_STRING);
	$qtd_Equip = filter_input(INPUT_POST, 'qtd_Equip', FILTER_SANITIZE_NUMBER_INT);

	$sql = $pdo->prepare("INSERT INTO lab.equipamento (id_Equip,desc_Equip,local_Equip,area_Equip)  VALUES (:id_Equip,:desc_Equip,:local_Equip,:area_Equip)");
	$sql->bindValue(":id_Equip",$id_Equip);
	$sql->bindValue(":desc_Equip",$desc_Equip);
	$sql->bindValue(":local_Equip",$local_Equip);
	$sql->bindValue(":area_Equip",$area_Equip);
	
	$sql2 = $pdo->prepare("INSERT INTO lab.EstoqueEquip (id_Equip,qtd_Equip)  VALUES (:id_Equip,:qtd_Equip)");
	$sql2->bindValue(":id_Equip",$id_Equip);
	$sql2->bindValue(":qtd_Equip",$qtd_Equip);
	try{
		$conn = $sql->execute();
		try {
			$conn = $sql2->execute();
			echo true;
		} catch (Exception $e) {
			echo false;
			$sql3 = $pdo->prepare("DELETE FROM lab.equipamento WHERE id_Equip = '$id_Equip'");
			$conn = $sql3->execute();
		}
	}catch(Exception $e){
		echo false;
	}
?>