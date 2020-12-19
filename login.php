<?php

    include_once 'conexao.php';
    $pdo = conectar();
    session_start();
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $sql = $pdo->prepare("SELECT * from lab.pessoa where email='$email' and senha='$senha'");
    $sql->execute();

    if ($sql->rowCount() > 0) {

        $linha = $sql->fetch(PDO::FETCH_ASSOC);
        
        $_SESSION['user'] = $linha['email'];
        $_SESSION['area_pessoa'] = $linha['area_pessoa'];
        //$_SESSION['tipo'] = $linha['tipo'];

        header("location: reagente.php");
    } else {
        
        $_SESSION['erro2']='Erro';
        //echo $_SESSION['erro'];
        header("location: index.php");

    }

?>
