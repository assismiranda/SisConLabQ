<?php
	include_once 'conexao.php'; 
	$pdo = conectar(); 
	$id = $_POST['busca1'];
	$qtd = $_POST['busca2'];
	$sql = $pdo->prepare("SELECT qtd_mat FROM lab.estoquemat WHERE id_mat ='$id'");
	$conn = $sql->execute();
	$resultReag =  $sql->fetch(PDO::FETCH_ASSOC);
	
	$qtd2 = (int)$resultReag['qtd_mat'];

	$result = (int)$qtd2 - (int)$qtd;
    


	if ($result < 0) {
		echo 'Quantidade indisponível! Total disponivel: '.$qtd2.''; 
	}else if ($result >= 0){
		echo '<div class="form-group">
			  <label class="col-md-4 control-label" for="desc_Mat">Descrição</label>
			  <div class="col-md-5">
				  <input id="desc_Mat" name="desc_Mat" type="text" placeholder="Descrição" class="form-control input-md" required="">
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