<?php

// Verificar se a pessoa está ou não logada:
    session_start();
    if(!isset($_SESSION['usuario'])){
        echo "Falha! Você precisa estar logado(a).";
        die();
    }

// Verificar se a página está sendo carregada por POST:
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        require_once('classes/Categoria.class.php');

        $c = new Categoria();
        $c->nome = $_POST['categoria'];
        
        if($c->Cadastrar() == 1){
            header('Location: ../painel.php');
        }else{
            echo "Falha ao cadastrar categoria.";
        }
    }else{
        echo "Essa página deve ser carregada por POST";
    }



?>