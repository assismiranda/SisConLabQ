<?php
	include_once 'conexao.php'; 
	$pdo = conectar(); 

	$cas = $_POST['busca'];
	$lote = $_POST['busca3'];
	$qtd = $_POST['busca2'];
	$sql = $pdo->prepare("SELECT qtd_reag FROM lab.estoquereag WHERE cas='$cas' and lote = '$lote'");
	$conn = $sql->execute();
	$resultReag =  $sql->fetch(PDO::FETCH_ASSOC);
	
	$qtd2 = (float)$resultReag['qtd_reag'];

	$result = (float)$qtd2 - (float)$qtd;
    


	if ($result < 0) {
		echo 'Quantidade indisponível! Total disponivel: '.$qtd2.''; 
	}else if ($result >= 0){
		echo '<div class="form-group">
			  <label class="col-md-4 control-label" for="desc_Equip">Descrição</label>
			  <div class="col-md-5">
				  <input id="desc_Equip" name="desc_Equip" type="text" placeholder="Descrição" class="form-control input-md" required="">
				</div>
			  </div>

			<div class="form-group">
			  <label class="col-md-4 control-label" for="idConfirmar"></label>
			  <div class="col-md-8">
			    <input type="submit" name="cadRG" id="cadRG" value="Enviar" class="btn btn-success" style="margin-left: 47%">
			  </div>
			</div>' ;
	}
	
?>