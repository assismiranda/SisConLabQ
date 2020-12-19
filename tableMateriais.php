<?php
    include_once 'conexao.php';
    $pdo = conectar();
    $sql = $pdo->prepare("SELECT id_mat,desc_mat,local_mat FROM lab.material");
    $result = $sql->execute();
    $tabela="<table class='table table-hover'>
        <thead>
            <tr>
                <th scope='col' width='45%'>Descrição</th>
                <th scope='col' width='30%'>Localização</th>
                <th scope='col' width='15%'>Quantidade</th>
                <th></th>
            </tr>
        </thead>
        <tbody>";

         while($exibir = $sql->fetch(PDO::FETCH_ASSOC)){
                $id = $exibir['id_mat'];
                $sql3 = $pdo->prepare("SELECT qtd_mat FROM lab.EstoqueMat where id_mat = '$id'" );
                $result3 = $sql3->execute();
                $resultMat =  $sql3->fetch(PDO::FETCH_ASSOC);

                $tabela .="<td>".$exibir['desc_mat']."</td>";
                $tabela .="<td>".$exibir['local_mat']."</td>";
                $tabela .="<td>".$resultMat['qtd_mat']."</td>";
                $tabela .="<td><a href='' title='Visualizar Material'><button type='button' class='btn btn-secundary' data-toggle='modal' data-target='#visulMaterialModal' id='".$exibir['id_mat']."'>Visualizar</button></a></td>";
                $tabela .="</tr>";
            
             } 
        $tabela .="
        </tbody>
    </table>";
    echo $tabela;
?>