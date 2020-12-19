 <?php
    include_once 'conexao.php';
    $pdo = conectar();
    $select="<select id='risco' name='risco' class='form-control'>";
    $sql = $pdo->prepare("SELECT id_risco,desc_risco FROM lab.risco");
    $result = $sql->execute();
       
    while($exibir = $sql->fetch(PDO::FETCH_ASSOC)){
      $select.="<option value='".$exibir['id_risco']."'>".$exibir['desc_risco']."</option>";
    }
    $select.="</select>";

    echo $select;
 ?> 





