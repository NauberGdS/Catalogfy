<?php

require_once('Banco.class.php');


class Contato
{
    // Atributos da classe
    public $id;
    public $nome;

    // metodos
    public function Listar(){
        $sql = "SELECT * FROM categorias";
        $banco = Banco::conectar();
        $comando = $banco->prepare($sql);
        $comando->execute();

        $arr_resultado = $comando->fetchAll(PDO::FETCH_ASSOC);

        Banco::desconectar();
        return $arr_resultado;
    }

    public function Cadastrar(){
        $sql = "INSERT INTO categorias(nome) VALUES (?)";
        $banco = Banco::conectar();
        $comando = $banco->prepare($sql);
        $comando->execute([$this->nome]);
        banco::desconectar();
        return $comando->rowCount();
    }

    public function Modificar(){
        $sql = "UPDATE categorias SET nome=? WHERE id=?";
         $banco = Banco::conectar();
         $comando = $banco->prepare($sql);
         $comando->execute([$this->nome]);
         banco::desconectar();
         return $comando->rowCount();
    }

    public function Remover(){
        $sql = "DELETE FROM categorias WHERE id = ?";
        $banco = Banco::conectar();
        $comando = $banco->prepare($sql);
        $comando->execute([$this->id]);
        banco::desconectar();
        return $comando->rowCount();
    }


}

?>