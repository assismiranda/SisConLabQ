<?php
	include_once 'conexao.php'; 
	$pdo = conectar(); 
	$cas = $_POST['cas'];
	$sql = $pdo->prepare("SELECT lote FROM lab.estoquereag WHERE cas ='$cas'");
	$result = $sql->execute();

	if ($sql->rowCount() == 0) {
	    echo '<option value="0">' . htmlentities('Não tem reagente com esse cas') . '</option>';
	} 
	else {
	    while ($linha = $sql->fetch(PDO::FETCH_ASSOC)) {
	        echo '<option value="' . $linha['lote'] . '">' . utf8_encode($linha['lote']) . '</option>';
	    }
	}
?>