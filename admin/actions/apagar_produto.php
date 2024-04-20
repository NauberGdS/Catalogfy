<?php

// Verificar se a sessão não existe:
    session_start();
    if(!isset($_SESSION['usuario'])) {
        echo "Você não está logado!";
        die();
    }


if (isset($_GET['id'])) {
    // Apagar
    require_once('classes/Produto.class.php');
    $prod = new Produto();

    $prod->id = $_GET['id'];
    if ($prod->Apagar() == 1) {
        // Redirecionar de volta ao index
        header('Location: ../painel.php?sucesso=1');
    } else {
        header('Location: ../painel.php?falha=1');
    }

} else {
    echo "Error! Informe o id a ser apagado!";
}
