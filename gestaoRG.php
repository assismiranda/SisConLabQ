<?php 
	session_start();
	include"header.php"; 
	include_once 'conexao.php'; 
	$pdo = conectar(); 
	if (isset($_SESSION['user'])) {
?>
<script type="text/javascript">
            //método que garante que o JQuery é executado somente após o documento ser carregado
            $(document).ready(function() { 
                //método executado quando o usuário selecionar um item no dropdown de estado
                //necessário identificar o name do select
                $("select[name=cas]").change(function() {
                    //monta o primeiro item do select de cidades 
                    $("select[name=lote]").html('<option value="0">Carregando...</option>');
                    //invoca o arquivo cidades.php e passa para ele o valor do estado selecionado
                    $.post("lote.php", //método de envio dos dados para cidades.php
                            {cas: $(this).val()}, //valor repassado para cidades.php
                    function(valor) { //função para carregar o select de cidade
                        $("select[name=lote]").html(valor);
                    }
                    )
                })
            })
</script>
        <script type="text/javascript">
            //método que garante que o JQuery é executado somente após o documento ser carregado
            $('document').ready(function() {
                    $('#qtd_Reag').keyup(function() {
                        $.post('cont_reag.php', {busca: $('#cas').val(),busca3: $('#lote').val(),busca2: $('#qtd_Reag').val()},
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
		<p><center><h2>Gestão do Estoque de Reagentes</h2></center><br></p>
		<form class="form-horizontal" action="gRG.php" method="post" enctype="multipart/form-data">
			<fieldset>

			<div class="form-group">
			  <label class="col-md-4 control-label" for="cas">CAS</label>  
			  <div class="col-md-5" id="busca">
			  <select id="cas" name="cas" class="form-control">
	            	
	            	<?php
	              //$email = $_SESSION['user'];
	          		    $sql = $pdo->prepare("SELECT DISTINCT cas FROM lab.estoquereag  ");
	          		    $result = $sql->execute();
	          		    ?>
	          		    <option value="" disabled selected>Selecione</option>
	          		    <?php
	          		    while($exibir = $sql->fetch(PDO::FETCH_ASSOC)){
	          		    	$id =$exibir['cas'];
	          		    	$sql2 = $pdo->prepare("SELECT desc_reag FROM lab.reagente WHERE cas ='$id'");
	          		    	$result2 = $sql2->execute();
	          		    	$exibir2 = $sql2->fetch(PDO::FETCH_ASSOC);
	          		    	$ponto = " - ";
	          		    	?>

	          		      <option value="<?php echo $exibir['cas'];?>" ><?php echo $exibir['cas'],$ponto,$exibir2['desc_reag']; ?></option>
	          		     <?php 
	          		     } ?>
	              </select>
			    
			    
			  </div>
			</div>

			<div class="form-group">
			  <label class="col-md-4 control-label" for="lote">Lote</label>  
			  <div class="col-md-5" id="busca3">
			  <select id="lote" name="lote" class="form-control">
               <option value="" disabled selected>Escolha um reagente primeiro</option>
            </select>
			  </div>
			</div>

			<div class="form-group" >
			  <label class="col-md-4 control-label" for="qtd_Reag">Quantidade</label>  
			  <div class="col-md-5" id="busca2">
			  <input id="qtd_Reag" name="qtd_Reag" type="text" placeholder="Quantidade que irá utilizar" class="form-control input-md" required="">
			    
			  </div>
			</div>

			<div   id="conteudopesquisa" >
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