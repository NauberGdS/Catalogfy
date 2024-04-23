<?php

if($_SERVER['REQUEST_METHOD'] === 'POST'){

    require_once('classes/usuario.class.php');

    $u = new Usuario();
    $u-> nome = strip_tags($_POST['nome']);
    $u-> email = strip_tags($_POST['email']);
    $u-> senha = strip_tags($_POST['senha']);

if($u->Cadastrar() == 1) {
//   redirecionar de olta ao index.php
header('Location: ../index.php?sucesso=cadastrousuario');

}else{
    echo('Location: ../index.php?falha=cadastrousuario');
} 

}else{
    echo 'Erro. A página deve ser carregada por POST';
}

?>