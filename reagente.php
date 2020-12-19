<?php
session_start();
?>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script><script type="text/javascript">
            //método que garante que o JQuery é executado somente após o documento ser carregado
            $('document').ready(function() {
                    $('#cas').keyup(function() {
                        $.post('des_reag.php', {busca: $('#cas').val()},
                        function(data) {
                            $('#conteudopesquisa').show();
                            $('#conteudopesquisa').empty().html(data);
                        }
                        );
                    });
                });
             
            
        </script>
<?php

include"header.php";

include_once 'conexao.php';
$pdo = conectar();

  if (isset($_SESSION['user'])) {
?>
<div id="portal-column-content" class="cell width-3:4 position-1:4">
  <a name="acontent" id="acontent" class="anchor">conteúdo</a>
  <p><center><h2>Lista de Reagentes cadastrados</h2></center><br></p>
  <a href="" title="Cadastrar Reagente"><button type="button" class="btn btn-success" data-toggle="modal" data-target="#addReagenteModal">Cadastrar</button></a>
  <form method="post" id="form_pesq">
    <div style="margin: -5% 0% 0% 20%">    
      <div class="col-md-5">
        <input id="desc_Reag" name="desc_Reag" type="text" placeholder="Descrição" class="form-control input-md"  style="text-align: center;" autofocus>
      </div>
      <a href="" title="Pesquisar Reagente"><input type="submit" name="pesqReag" id="pesqReag" value="Pesquisar" class="btn btn-secundary"></a>
    </div>
  </form>
  <br>

  <span id="msg"></span>

  <div id="tabela">
    <table class="table table-hover">
      <thead>
        <tr>
          <th></th>
          <th scope="col" width="10%">Lote</th>
          <th scope="col" width="10%">CAS</th>
          <th scope="col" width="45%">Descrição</th>
          <th scope="col" width="5%">Risco</th>
          <th scope="col" width="5%">Quantidade</th>
          <th></th>
          <th></th>
        </tr>
      </thead>
      <?php
      //$email = $_SESSION['user'];
          $dataAtual = date("Y-m-d");
          $sql = $pdo->prepare("SELECT lote,cas,desc_reag,id_risco FROM lab.reagente");
          $result = $sql->execute();    

          
          while($exibir = $sql->fetch(PDO::FETCH_ASSOC)){
          	
            $pesq = $exibir['id_risco'];
            $sql2 = $pdo->prepare("SELECT desc_risco FROM lab.risco WHERE id_risco = '$pesq'");
            $result2 = $sql2->execute();
            $risco = $sql2->fetch(PDO::FETCH_ASSOC);

            $lote = $exibir['lote'];
            $cas = $exibir['cas'];
            $sql3 = $pdo->prepare("SELECT cas,qtd_reag,unidade,validade,lote FROM lab.EstoqueReag where cas = '$cas' AND lote = '$lote'" );
          	$result3 = $sql3->execute();
          	$resultReag =  $sql3->fetch(PDO::FETCH_ASSOC);

          ?>

      <tbody>
        <tr>
          <?php 
            $time_validade = strtotime($resultReag['validade']);
            $time_atual = strtotime($dataAtual);
            // Calcula a diferença de segundos entre as duas datas:
            $diferenca = $time_validade - $time_atual; // 19522800 segundos
            // Calcula a diferença de dias
            $dias = (int)floor( $diferenca / (60 * 60 * 24)); // 225 dias

            if ($dias < 0) {
              echo '<th scope="row"><img src="imagens/vencido.png" title="Vencido" width="30" height="30"></th>';
            }elseif ($dias > 10) {
              echo '<th scope="row"><img src="imagens/ok.png" title="OK" width="30" height="30"></th>';
            }else{
              echo '<th scope="row"><img src="imagens/quase.png" title="Quase Vencido" width="30" height="30"></th>';
            }
           ?>
           <td><?php echo $exibir['lote']; ?></td>
          <td><?php echo $exibir['cas']; ?></td>
          <td><?php echo $exibir['desc_reag']; ?></td>
          <td><?php echo $risco['desc_risco']; ?></td>
          <td><?php echo $resultReag['qtd_reag']; echo $resultReag['unidade'];?></td>
          <td><a href="" title="Vizualizar Reagente"><button type="button" class="btn btn-secundary" data-toggle="modal" data-target="#visulReagenteModal" id="<?php echo $exibir['cas']; ?>">Visualizar</button></a></td>
          <td><a  title="Cadastrar Anexo"><button type="button" class="btn btn-success" id="<?php echo $exibir['cas']; ?>"  onclick="retornaValor(this)" name="BotaoAnexo">Anexo</button></a></td>
        </tr>
        <?php 
           } ?>
      </tbody>
    </table>
  </div>

  <div id="addReagenteModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" style="position: fixed; height: 200%; margin-top: -25%; margin-left: -7%;">
  <!-- style="position: fixed; height: 100; margin-top: -15.2%; margin-left: -6%; --> 
    <div class="modal-dialog" role="document">
      <div class="modal-content" style="width: 150%">
        <div class="modal-header">
          <h4 class="modal-title" id="addReagenteModalLabel">Cadastrar Reagente</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form class="form-horizontal" id="insert_form_RG" method="post" enctype="multipart/form-data">
          <p></p>
          <div class="form-group">
            <label class="col-md-4 control-label" for="lote">Lote</label>  
            <div class="col-md-5">
              <input id="lote" name="lote" type="text" placeholder="Lote" class="form-control input-md" required="" style="text-align: center;" autofocus="">
            </div>
            <div class="col-md-2">
              <select class="form-control" id="area_reag" name="area_reag" style="margin: 0% -60% 0% 0%">
                <option value="Biologia">Biologia</option>
                <option value="Física">Física</option>
                <option value="Química">Química</option>
              </select> 
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-4 control-label" for="cas">CAS</label>  
            <div class="col-md-5" id="busca">
              <input id="cas" name="cas" type="text" placeholder="CAS" class="form-control input-md" required="" style="text-align: center;" autofocus="">
            </div>
            
        </div>
        <div class="form-group">
            <label class="col-md-4 control-label" for="desc_Reag">Descrição</label>  
            <div class="col-md-5"  id="conteudopesquisa" >
              
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-4 control-label" for="local_Reag">Localização</label>  
            <div class="col-md-5">
              <input id="local_reag" name="local_reag" type="text" placeholder="Localização" class="form-control input-md" required="" style="text-align: center;">
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-4 control-label" for="controlado">Controlado</label>
            <div class="col-md-3">
              <select id="controlado" name="controlado" class="form-control">
                <option value="Sim">Sim</option>
                <option value="Nao">Não</option>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-4 control-label" for="classe">Classe </label>  
            <div class="col-md-5" id="selClasses">
            <select id="classe" name="classe" class="form-control">
            	<?php
              //$email = $_SESSION['user'];
          		    $sql = $pdo->prepare("SELECT id_classe,desc_classe FROM lab.classe");
          		    $result = $sql->execute();
          		    
          		    while($exibir = $sql->fetch(PDO::FETCH_ASSOC)){?>
          		      <option value="<?php echo $exibir['id_classe'];?>"><?php echo $exibir['desc_classe']; ?></option>
          		     <?php 
          		     } ?>
              </select>
            </div>
            <div class="col-md-2">
              <button style="margin: 0% -60% 0% 0%" type="button" class="btn btn-success" data-toggle="modal" data-target="#addClasseModal">Adicionar</button> 
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-4 control-label" for="risco">Risco</label>
            <div class="col-md-3" id="selRiscos">
              <select id="risco" name="risco" class="form-control">
                <?php
          		    $sql = $pdo->prepare("SELECT id_risco,desc_risco FROM lab.risco");
          		    $result = $sql->execute();
          		    
          		    while($exibir = $sql->fetch(PDO::FETCH_ASSOC)){?>
          		      <option value="<?php echo $exibir['id_risco'];?>"><?php echo $exibir['desc_risco']; ?></option>
          		     <?php 
          		     } ?>
              </select>
            </div>
            <div class="col-md-2">
              <button style="margin: 0% -60% 0% 0%" type="button" class="btn btn-success" data-toggle="modal" data-target="#addRiscoModal" >Adicionar</button> 
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-4 control-label" for="idTitulo">Quantidade </label>  
            <div class="col-md-5">
                <input name="qtd_reag" placeholder="Quantidade exemplo: 2.5" class="form-control input-md" style="text-align: center;">
            </div>
            <div class="col-md-2">
              <select name="unidade" class="form-control" style="margin: 0% -60% 0% 0%">
                <option value="L">L</option> 
              </select> 
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-4 control-label" for="idTitulo">Validade </label>  
            <div class="col-md-5">
              <input name="validade" type="date" class="form-control input-md" style="text-align: center;">    
            </div>
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal"  style="margin-right: 77.5%">Fechar</button>
              <input type="submit" name="cadRG" id="cadRG" value="Cadastrar" class="btn btn-success">
          </div>
          </form>
        </div>
    </div>
  </div>

  <div id="visulReagenteModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" style="position: fixed; height: 200%; margin-top: -25%; margin-left: -7%;" onclose="AtualizarPai()">
    <div class="modal-dialog" role="document">
      <div class="modal-content" style="width: 150%">
        <div class="modal-header">
          <h4 class="modal-title" id="visulReagenteModalLabel">Detalhes do Reagente</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
          
        <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
          <p></p>
          <div class="form-group">
            <label class="col-md-4 control-label" for="lote">Lote</label>  
            <div class="col-md-5">
              <input id="lote" type="text" placeholder="Lote" class="form-control input-md" required="" value="64-19-7" style="text-align: center;">
            </div>
            <div class="col-md-2">
              <select class="form-control" id="area_Reag" style="margin: 0% -60% 0% 0%">
                <option value="Sim">Biologia</option>
                <option value="Não">Física</option>
                <option value="Não">Química</option>
              </select> 
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-4 control-label" for="cas">CAS</label>  
            <div class="col-md-5">
              <input id="cas" type="text" placeholder="CAS" class="form-control input-md" required="" value="64-19-7" style="text-align: center;">
            </div>
            
          </div>
          <div class="form-group">
            <label class="col-md-4 control-label" for="desc_Reag">Descrição</label>  
            <div class="col-md-5">
              <input id="desc_Reag" type="text" placeholder="Nome" class="form-control input-md" required="" value="Ácido Acético" style="text-align: center;">
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-4 control-label" for="local_Reag">Localização</label>  
            <div class="col-md-5">
              <input id="local_Reag" type="text" placeholder="Localização" class="form-control input-md" required="" value="Armário X" style="text-align: center;">
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-4 control-label" for="controlado">Controlado</label>
            <div class="col-md-3">
              <select id="controlado" class="form-control">
                <option value="Sim" selected="">Sim</option>
                <option value="Não">Não</option>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-4 control-label" for="classe">Classe: </label>  
            <div class="col-md-5">
            <select id="classe" name="classe" class="form-control">
              <?php
              //$email = $_SESSION['user'];
                  $sql = $pdo->prepare("SELECT id_classe,desc_classe FROM lab.classe");
                  $result = $sql->execute();
                  
                  while($exibir = $sql->fetch(PDO::FETCH_ASSOC)){?>
                    <option value="<?php echo $exibir['id_classe'];?>"><?php echo $exibir['desc_classe']; ?></option>
                   <?php 
                   } ?>
              </select>
            </div>
            <div class="col-md-2">
              <button style="margin: 0% -60% 0% 0%" type="button" class="btn btn-success" data-toggle="modal" data-target="#addClasseModal">Adicionar</button> 
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-4 control-label" for="risco">Risco</label>
            <div class="col-md-3">
              <select id="risco" name="risco" class="form-control">
                <?php
                  $sql = $pdo->prepare("SELECT id_risco,desc_risco FROM lab.risco");
                  $result = $sql->execute();
                  
                  while($exibir = $sql->fetch(PDO::FETCH_ASSOC)){?>
                    <option value="<?php echo $exibir['id_risco'];?>"><?php echo $exibir['desc_risco']; ?></option>
                   <?php 
                   } ?>
              </select>
            </div>
            <div class="col-md-2">
              <button style="margin: 0% -60% 0% 0%" type="button" class="btn btn-success" data-toggle="modal" data-target="#addRiscoModal" >Adicionar</button> 
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-4 control-label" for="idTitulo">Quantidade: </label>  
            <div class="col-md-5">
              <input placeholder="Quantidade" value="2" class="form-control input-md" style="text-align: center;">
            </div>
            <div class="col-md-2">
              <select class="form-control" style="margin: 0% -60% 0% 0%">
                <option value="L" selected="">L</option> 
              </select> 
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-4 control-label" for="idTitulo">Validade: </label>  
            <div class="col-md-5">
              <input name="validade" type="date" placeholder="Validade" class="form-control input-md" style="text-align: center;">    
            </div>
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal" style="margin-right: 77.5%>Fechar</button>
              <input type="submit" name="cadRG" id="cadRG" value="Editar" class="btn btn-success">
          </div>   
        </form>
      </div>
    </div>
  </div>

  <div id="addClasseModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" style="position: fixed; margin-top: -10%; margin-left: 10%;">  
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="addClasseModalLabel">Cadastrar Classe</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
         <form class="form-horizontal" method="post" id="insert_form_C" enctype="multipart/form-data">
          <p></p>
            <div class="form-group">
              <label class="col-md-4 control-label" for="desc_Classe">Classe</label>  
              <div class="col-md-5">
                <input id="desc_Classe" name="desc_Classe" type="text" placeholder="Descrição" class="form-control input-md" required="" style="text-align: center;">
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
              <div style="width: 100%;">
              <center>
                <span id="msg2"></span>
              </center>
            </div>
              <input type="submit" name="cadC" id="cadC" value="Cadastrar" class="btn btn-success">
            </div>
        </form>                   
      </div>
    </div>
  </div>

  <div id="addRiscoModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" style="position: fixed; margin-top: -10%; margin-left: 10%;">  
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="addRiscoModalLabel">Cadastrar Risco</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
         <form class="form-horizontal" method="post" id="insert_form_R" enctype="multipart/form-data">
          <p></p>
            <div class="form-group">
              <label class="col-md-4 control-label" for="desc_Risco">Risco</label>  
              <div class="col-md-5">
                <input id="desc_Risco" name="desc_Risco" type="text" placeholder="Descrição" class="form-control input-md" required="" style="text-align: center;">
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
              <div style="width: 100%;">
              <center>
                <span id="msg3"></span>
              </center>
            </div>
              <input type="submit" name="cadR" id="cadR" value="Cadastrar" class="btn btn-success">
            </div>
        </form>                   
      </div>
    </div>
  </div>
</div>
<?php
  } else { //CASO NÃO ESTEJA AUTENTICADO
    echo '<div class="alert alert-warning" style="text-align:center;">Esta é uma área reservada, só usuários autorizados podem ter acesso. 
            <br/><a href="Index.php">Se identifique aqui</a></div>';
  }
?>
<script>
function retornaValor(elemento) {
  var x = elemento.id;
  window.location.href = "anexo.php?id="+x;
}
</script>
<?php include"scriptR.js"; ?> 
<?php include"scriptC.js"; ?> 
<?php include"scriptRG.js"; ?>    
<?php include"footer.php"; ?>
