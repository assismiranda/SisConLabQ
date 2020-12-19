<?php

	include_once 'conexao.php';
	$pdo = conectar();
	
	# recuperando os dados enviados via post:
	$id_Mat = filter_input(INPUT_POST, 'id_Mat', FILTER_SANITIZE_NUMBER_INT);
	$desc_Mat = filter_input(INPUT_POST, 'desc_Mat', FILTER_SANITIZE_STRING);
	$area_Mat = filter_input(INPUT_POST, 'area_Mat', FILTER_SANITIZE_STRING);
	$local_Mat = filter_input(INPUT_POST, 'local_Mat', FILTER_SANITIZE_STRING);
	$qtd_Mat = filter_input(INPUT_POST, 'qtd_Mat', FILTER_SANITIZE_NUMBER_INT);

	$sql = $pdo->prepare("INSERT INTO lab.material (id_Mat,desc_Mat,area_Mat,local_Mat)  VALUES (:id_Mat,:desc_Mat,:area_Mat,:local_Mat)");
	$sql->bindValue(":id_Mat",$id_Mat);
	$sql->bindValue(":desc_Mat",$desc_Mat);
	$sql->bindValue(":area_Mat",$area_Mat);
	$sql->bindValue(":local_Mat",$local_Mat);
	
	$sql2 = $pdo->prepare("INSERT INTO lab.EstoqueMat (id_Mat, qtd_Mat)  VALUES (:id_Mat,:qtd_Mat)");
	$sql2->bindValue(":id_Mat",$id_Mat);
	$sql2->bindValue(":qtd_Mat",$qtd_Mat);
	try{
		$conn = $sql->execute();
		try {
			$conn = $sql2->execute();
			echo true;
		} catch (Exception $e) {
			echo false;
			$sql3 = $pdo->prepare("DELETE FROM lab.material WHERE id_Mat = '$id_Mat'");
			$conn = $sql3->execute();
		}
	}catch(Exception $e){
		echo false;
	}
?>