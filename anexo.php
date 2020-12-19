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
    $id_reag=$_GET['id'];
?>

<!-- Conteudo -->

<div id="portal-column-content" class="cell width-3:4 position-1:4">
  <a name="acontent" id="acontent" class="anchor">conteúdo</a>
  <p><center><h2>Cadastro de Anexo</h2></center><br></p>
   <div class="col-md-10">
       	<form class="form-horizontal" method="POST" action="CadastrarAn.php" enctype="multipart/form-data">
          <p></p>
          <div class="form-group">
            <label class="col-md-4 control-label" for="idTitulo">Anexo: </label>  
            <div class="col-md-7">
              <input  name="id" type="hidden" id="<?php echo $id_reag;?>" value= "<?php echo $id_reag;?>">
              <input  type="file" id="anexo" name="anexo" placeholder="Anexo" class="form-control input-md">    
            </div>
              <a href="" title="Cadastrar Anexo"><input style="margin: -6% 0% 0% 92%" type="submit" class="btn btn-success" value="Cadastrar" ></a>
          </div>
        </form>
    </div>

	<!--<p><br></p>

	<div  class="col-md-10">    
    <div class="col-md-5">
      <input id="desc_Mat" name="desc_Mat" type="text" placeholder="Descrição" class="form-control input-md" required="" style="text-align: center;">
    </div>
    <a href="" title="Pesquisar Anexo"><button type="button" class="btn btn-secundary" data-toggle="modal" data-target="#addMaterialModal">Pesquisar</button></a>
  </div>-->
  <p><br><br></p>
  <?php
        //session_destroy();
        //$_SESSION['erro'] = true;
        if (isset($_SESSION['erro'])) {
          if ($_SESSION['erro']=="ERRO") {
        ?>
          <div id="erro" class="alert alert-warning" role="alert">Falha no cadastro do Anexo!</div>
        <?php
          }
          else if ($_SESSION['erro']=="OK"){
        ?>
          <div id="erro" class="alert alert-success" role="alert">Anexo cadastrado com sucesso!</div>
        <?php
        }
        $_SESSION['erro']="TESTE";
      //session_unset($_SESSION['erro']);
      }
  ?>
  <script type="text/javascript">
        setTimeout(function() {
            $("#erro").fadeOut().empty();
        }, 6000);
  </script>
<table class="table table-hover">
    <thead>
      <tr>
        <th scope="col" width="90%">Anexo</th>
        <th></th>
      </tr>
    </thead>
    <?php
    //$email = $_SESSION['user'];
        $sql = $pdo->prepare("SELECT anexo FROM lab.reagente WHERE cas = '$id_reag'");
        $result = $sql->execute();

        while($exibir = $sql->fetch(PDO::FETCH_ASSOC)){
        ?>
    <tbody>
      <tr>
        <th scope="row"><?php echo $exibir['anexo']; ?></th>
        <td><a href="" title="Vizualizar Anexo"><button type="button" class="btn btn-secundary" data-toggle="modal" data-target="#visulReagenteModal">Visualizar</button></a></td>
      </tr>
    </tbody>
    <?php 
     } ?>
  </table>
</div>
<?php
        } else { //CASO NÃO ESTEJA AUTENTICADO
            echo '<div class="alert alert-warning" style="text-align:center;">Esta é uma área reservada, só usuários autorizados podem ter acesso. 
            <br/><a href="Index.php">Se identifique aqui</a></div>';
        }
?>

<?php include"footer.php"; ?>