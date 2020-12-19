<?php
	include_once 'conexao.php'; 
	$pdo = conectar(); 
	$cas = $_POST['busca'];
	$sql = $pdo->prepare("SELECT desc_reag FROM lab.reagente WHERE cas ='$cas'");
	$conn = $sql->execute();
	$resultReag =  $sql->fetch(PDO::FETCH_ASSOC);
	
	$desc2 = $resultReag['desc_reag'];
    


	if ($sql->rowCount() !=0) {
		echo '<input id="desc_reag" name="desc_reag" type="text"  value='.$resultReag['desc_reag'].' class="form-control input-md" readonly="readonly" style="text-align: center;">'; 
	}else if ($sql->rowCount() ==0){
		echo '<input id="desc_reag" name="desc_reag" type="text" placeholder="Descrição" class="form-control input-md" required="" style="text-align: center;">' ;
	}
	
?>