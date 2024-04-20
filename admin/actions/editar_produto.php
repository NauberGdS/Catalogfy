<?php

// Verificar se a sessão não existe:
    session_start();
    if(!isset($_SESSION['usuario'])){
        echo "Você não está logado!";
        die();
    }

if($_SERVER['REQUEST_METHOD'] === 'POST'){

    require_once('classes/Produto.class.php');

    $p = new Produto();
    $p->id = strip_tags($_POST['id']);
    $p->nome = strip_tags($_POST['nome']);
    $p->descricao = strip_tags($_POST['descricao']);
    $p->id_categoria = strip_tags($_POST['id_categoria']);
    $p->estoque = strip_tags($_POST['estoque']);
    $p->preco = strip_tags($_POST['preco']);
    $p->id_usuario_resp = $_SESSION['usuario']['id'];

if($p->Editar() == 1) {
    
//   redirecionar de olta ao index.php
header('Location: ../painel.php?');

}else{
    header('Location: ../painel.php?');
} 

}else{
    echo 'Erro. A página deve ser carregada por POST';
}

?>