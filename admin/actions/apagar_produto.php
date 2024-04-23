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
        header('Location: ../painel.php?sucesso=removerproduto');
    } else {
        header('Location: ../painel.php?falha=removerproduto');
    }

} else {
    echo "Error! Informe o id a ser apagado!";
}
