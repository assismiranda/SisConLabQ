 <?php
    include_once 'conexao.php';
    $pdo = conectar();
    $select="<select id='classe' name='classe' class='form-control'>";
    $sql = $pdo->prepare("SELECT id_classe,desc_classe FROM lab.classe");
    $result = $sql->execute();
       
    while($exibir = $sql->fetch(PDO::FETCH_ASSOC)){
      $select.="<option value='".$exibir['id_classe']."'>".$exibir['desc_classe']."</option>";
    }
    $select.="</select>";

    echo $select;
 ?> 





