<?php
echo $_POST["id_mat"];
if(isset($_POST["id_mat"])){
	include_once "conexao.php";
	$pdo = conectar();
	$resultado = '';
    
    //comentei as linhas do select

	$sql = $pdo->prepare("SELECT desc_mat,qtd_mat,area_mat,local_mat FROM lab.material where id_mat	='" . $_POST["id_mat"] . "'");
    $result = $sql->execute();
	$exibir = $sql->fetch(PDO::FETCH_ASSOC);
	
	//$resultado .= '<dl class="row">';
	
	//$resultado .= '<dt class="col-sm-3">ID</dt>';
	//$resultado .= '<dd class="col-sm-9">'.$row_user['id'].'</dd>';
	$resultado .= '<input value='.$row_user['desc_mat'].' style="text-align: center;">';
	
	//$resultado .= '<dt class="col-sm-3">Nome</dt>';
	//$resultado .= '<dd class="col-sm-9">'.$row_user['nome'].'</dd>';
	
	//$resultado .= '<dt class="col-sm-3">E-mail</dt>';
	//$resultado .= '<dd class="col-sm-9">'.$row_user['email'].'</dd>';
		
	//$resultado .= '</dl>';
	
                     /*   <div class="col-md-2">
                            <select class="form-control" id="area_Mat" style="margin: 0% -60% 0% 0%">
                                <option value="Biologia">Biologia</option>
                                <option value="Física">Física</option>
                                <option value="Química">Química</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="local_mat">Localização</label>
                        <div class="col-md-5">
                            <input id="local_mat" type="text" placeholder="Localização" class="form-control input-md"
                                required="" value="Armário X" style="text-align: center;">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="qtd_Mat">Quantidade</label>
                        <div class="col-md-5">
                            <input id="qtd_Mat" type="text" placeholder="Quantidade" class="form-control input-md"
                                required="" value="6" style="text-align: center;">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal" style="margin-right: 81%">Fechar</button>
                        <button type="button" class="btn btn-success" data-dismiss="modal">Editar</button>
                    </div>*/
	echo $resultado;
}