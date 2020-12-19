	<?php
session_start();
?>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> 
<?php 
    include"header.php";
    include_once 'conexao.php';
    $pdo = conectar(); 
    if (isset($_SESSION['user'])) {
?>
<!--<script type="text/javascript">
            //método que garante que o JQuery é executado somente após o documento ser carregado
            $('document').ready(function() {
                    $('#data').keyup(function() {
                        $.post('trataData.php', {busca: $('#data').val()},
                        function(data) {
                            $('#conteudopesquisa').show();
                            $('#conteudopesquisa').empty().html(data);
                        }
                        );
                    });
                });
</script>-->

<!-- Conteudo -->

<div id="portal-column-content" class="cell width-3:4 position-1:4">
    <a name="acontent" id="acontent" class="anchor">conteúdo</a>
    <p><center><h2>Lista de Agendamentos</h2></center><br></p>
    <a href="" title="Agendar"><button type="button" class="btn btn-success" data-toggle="modal" data-target="#addAgendaModal">Agendar</button></a>
    <form method="post" id="form_pesq">
      <div style="margin: -5% 0% 0% 20%">    
          <div class="col-md-5">
              <input id="desc_Agenda" name="desc_Agenda" type="text" placeholder="Descrição" class="form-control input-md"  style="text-align: center;" autofocus>
          </div>
          <a href="" title="Pesquisar Agendamento"><input type="submit" name="pesqAge" id="pesqAge" value="Pesquisar" class="btn btn-secundary"></a>
      </div>
    </form>
    <br>

    <span id="msg"></span>

    <div id="tabela">
      <table class="table table-hover">
        <thead>
          <tr>
            <th scope="col" width="25%">Data</th>
            <th scope="col" width="80%">Descrição</th>
            <th></th>
          </tr>
        </thead>
          <?php
              //$email = $_SESSION['user'];
              $sql = $pdo->prepare("SELECT id_agenda,data,desc_agenda FROM lab.agenda");
              $result = $sql->execute();

              while($exibir = $sql->fetch(PDO::FETCH_ASSOC)){
          ?>
        <tbody>
          <tr>
            <td><?php echo $exibir['data']; ?></td>
            <td><?php echo $exibir['desc_agenda']; ?></td>
            <td><a href="" title="Visualizar Agendamento"><button type="button" class="btn btn-secundary" data-toggle="modal" data-target="#visulAgendaModal">Visualizar</button></a></td>
          </tr>
          <?php 
            } ?>
          </tbody>
      </table>
    </div>

    <div id="addAgendaModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" style="position: fixed; height: 200%; margin-top: -25%; margin-left: -7%;">
      <div class="modal-dialog" role="document">
        <div class="modal-content" style="width: 150%">
          <div class="modal-header">
            <h4 class="modal-title" id="addUsuarioModalLabel">Agendar Laborátorio</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form class="form-horizontal" method="post" id="insert_form_A">
            <p></p>
            <div class="form-group">
            <label class="col-md-4 control-label" for="idTitulo">Data </label>  
            <div class="col-md-5" id="buscar">
              <input id="data" name="data" type="date" class="form-control input-md" style="text-align: center;" autofocus>    
            </div>
          </div>
            <div class="form-group">
              <label class="col-md-4 control-label" for="idTitulo">Descrição </label>  
              <div class="col-md-5">
                <input id="desc_Agenda" name="desc_Agenda" type="text" placeholder="Descrição" class="form-control input-md" required="" style="text-align: center;">  
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-4 control-label" for="idEdicao">Horário Início</label>  
              <div class="col-md-5">
                <input id="horaInicio" name="horaInicio" type="time" placeholder="Horário Início" class="form-control input-md" required="" style="text-align: center;">
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-4 control-label" for="idEdicao">Horário Fim</label>  
              <div class="col-md-5">
                <input id="horaFim" name="horaFim" type="time" placeholder="Horário fim" class="form-control input-md" required="" style="text-align: center;">
              </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal" style="margin-right: 78%">Fechar</button>
                <input type="submit" name="cadA" id="cadA" value="Cadastrar" class="btn btn-success">
                
            </div>
          </form>
        </div>
      </div>
    </div>

    <div id="visulUsuarioModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" style="position: fixed; height: 200%; margin-top: -25%; margin-left: -7%;" onclose="AtualizarPai()">
      <div class="modal-dialog" role="document">
        <div class="modal-content" style="width: 150%">
          <div class="modal-header">
            <h4 class="modal-title" id="visulUsuarioModalLabel">Detalhes do Agendamento</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form class="form-horizontal" action="CadastrarL.php" method="post" enctype="multipart/form-data">
            <p></p>
            <div class="form-group">
              <label class="col-md-4 control-label" for="idTitulo">Data: </label>  
              <div class="col-md-5">
                <input type="date" class="form-control input-md" style="text-align: center;">    
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-4 control-label" for="idTitulo">Descrição: </label>  
              <div class="col-md-5">
                <input id="idEdicao" name="idEdicao" type="text" value="Aula prática" class="form-control input-md" required="" style="text-align: center;">  
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-4 control-label" for="idEdicao">Horário Início</label>  
              <div class="col-md-5">
                <input id="idEdicao" name="idEdicao" type="text" placeholder="Horário Início" class="form-control input-md" required="" value="9:00" style="text-align: center;">
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-4 control-label" for="idEdicao">Horário Fim</label>  
              <div class="col-md-5">
                <input id="idEdicao" name="idEdicao" type="text" placeholder="Horário fim" class="form-control input-md" required="" value="11:00" style="text-align: center;">
              </div>
            </div>             
            <div class="modal-footer">
              <button type="button" class="btn btn-outline-success" data-dismiss="modal" style="margin-right: 82%">Editar</button>
              <button type="button" class="btn btn-outline-info" data-dismiss="modal">Fechar</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

<?php include"scriptA.js"; ?> 
<?php  
} else { //CASO NÃO ESTEJA AUTENTICADO
            echo '<div class="alert alert-warning" style="text-align:center;">Esta é uma área reservada, só usuários autorizados podem ter acesso. 
            <br/><a href="Index.php">Se identifique aqui</a></div>';
        }
?>
<?php include"footer.php"; ?>