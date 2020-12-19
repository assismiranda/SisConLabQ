<?php
	include_once 'conexao.php'; 
	$pdo = conectar(); 
	$data= $_POST['busca'];
	$sql = $pdo->prepare("SELECT count(*) FROM lab.agenda WHERE data ='$data' and");
	$conn = $sql->execute();
	$result =  $sql->fetch(PDO::FETCH_ASSOC);
	


	if ($result < 0) {
		echo 'Essa data ja esta reservada'; 
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