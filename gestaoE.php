<?php
	session_start();
	include"header.php"; 
	include_once 'conexao.php'; 
	$pdo = conectar(); 
	if (isset($_SESSION['user'])) {
?>
<script type="text/javascript">
            //método que garante que o JQuery é executado somente após o documento ser carregado
            $('document').ready(function() {
                    $('#qtd_Equip').keyup(function() {
                        $.post('cont_equip.php', {busca1: $('#id_Equip').val(),busca2: $('#qtd_Equip').val()},
                        function(data) {
                            $('#conteudopesquisa').show();
                            $('#conteudopesquisa').empty().html(data);
                        }
                        );
                    });
                });
             
            
        </script>
	<div id="portal-column-content" class="cell width-3:4 position-1:4">
	  <a name="acontent" id="acontent" class="anchor">conteúdo</a>
	  	<p><center><h2>Gestão do Estoque de Equipamentos</h2></center><br></p>
	  	  <form class="form-horizontal" action="gE.php" method="post" enctype="multipart/form-data">
			<fieldset>
			<div class="form-group">
			  <label class="col-md-4 control-label" for="id_Equip">Equipamento</label>  
			  <div class="col-md-5" id="busca1">
			  	<select id="id_Equip" name="id_Equip" class="form-control">
            	<?php
          		    $sql = $pdo->prepare("SELECT id_Equip FROM lab.estoqueequip");
          		    $result = $sql->execute();

          		    ?>
          		    <option value="" disabled selected>Selecione</option>
          		    <?php
          		    
          		    while($exibir = $sql->fetch(PDO::FETCH_ASSOC)){
          		    	$id =$exibir['id_equip'];
          		    	$sql2 = $pdo->prepare("SELECT desc_Equip FROM lab.equipamento WHERE id_equip ='$id'");
          		    	$result2 = $sql2->execute();
          		    	$exibir2 = $sql2->fetch(PDO::FETCH_ASSOC);
          		    	$ponto = " - ";
          		    	?>

          		      <option value="<?php echo $exibir['id_equip'];?>"><?php echo $exibir['id_equip'],$ponto,$exibir2['desc_equip']; ?></option>
          		     <?php 
          		     } ?>
              </select>
			  
			    
			  </div>
			</div>

			<div class="form-group">
			  <label class="col-md-4 control-label" for="qtd_Equip">Quantidade</label>  
			  <div class="col-md-5" id="busca2">
			  <input id="qtd_Equip" name="qtd_Equip" type="text" placeholder="Quantidade" class="form-control input-md" required="">

			    
			  
			</div>

			</div>
			<div  id="conteudopesquisa" ></div>
			
			<div class="form-group">
				<?php
			       if (isset($_SESSION['erro'])) {
			          if ($_SESSION['erro']=="ERRO") {
			        ?>
			          <div id="erro" class="alert alert-warning" role="alert">Falha na alteração do estoque!</div>
			        <?php
			          }
			          else if ($_SESSION['erro']=="OK"){
			        ?>
			          <div id="erro" class="alert alert-success" role="alert"> Estoque alterado com sucesso!</div>
			        <?php
			        }
			      $_SESSION['erro']="TESTE";
			      }
			      ?>
			</div>
		</form>
		 
	</div>
    <script type="text/javascript">
        setTimeout(function() {
            $("#erro").fadeOut().empty();
        }, 6000);
  	</script>
  		<?php
  
    } else { //CASO NÃO ESTEJA AUTENTICADO
        echo '<div class="alert alert-warning" style="text-align:center;">Esta é uma área reservada, só usuários autorizados podem ter acesso. 
            <br/><a href="Index.php">Se identifique aqui</a></div>';
    }
?>

<?php include"footer.php"; ?>