<?php

require_once('Banco.class.php');

class Produto
{
    // Atributos da classe
    public $id;
    public $foto;
    public $nome;
    public $preco;
    public $estoque;
    public $id_categoria;
    public $id_usuario_resp;
    public $descricao;

    // metodos
    public function CadastrarSemFoto(){
        $sql = "INSERT INTO produtos(nome, preco, estoque, id_categoria, id_usuario_resp, descricao) 
        VALUES (?, ?, ?, ?, ?, ?)";
        $banco = Banco::conectar();
        $comando = $banco->prepare($sql);
        
        try{
        $comando->execute([$this->nome,$this->preco,$this->estoque,$this->id_categoria, $this->id_usuario_resp, $this->descricao]);
        Banco::desconectar();
        return $comando->rowCount();
    } catch(PDOException $e){
        Banco::desconectar();
        return 0;
    }
    }

    public function CadastrarComFoto(){
        $sql = "INSERT INTO produtos(nome, preco, estoque, id_categoria, id_usuario_resp, descricao, foto) 
        VALUES (?, ?, ?, ?, ?, ?, ?)";
        $banco = Banco::conectar();
        $comando = $banco->prepare($sql);
        try{
        $comando->execute([$this->nome,$this->preco,$this->estoque,$this->id_categoria, $this->id_usuario_resp, $this->descricao, $this->foto]);
        Banco::desconectar();
        return $comando->rowCount();
    } catch(PDOException $e){
        Banco::desconectar();
        return 0;
    }
    }

    public function ListarTudo(){
        $sql = "SELECT * FROM produtos";
        $banco = Banco::conectar();
        $comando = $banco->prepare($sql);
        $comando->execute();
        $arr_resultado = $comando->fetchAll(PDO::FETCH_ASSOC);
        Banco::desconectar();
        return $arr_resultado;
    }
    public function ListarPorId(){
        $sql = "SELECT * FROM produtos WHERE id = ?";
        $banco = Banco::conectar();
        $comando = $banco->prepare($sql);
        $comando->execute([$this->id]);
        $arr_resultado = $comando->fetchAll(PDO::FETCH_ASSOC);
        Banco::desconectar();
        return $arr_resultado;
    }
    public function Editar(){
        $sql = "UPDATE produtos SET nome=?, descricao=?, id_categoria=?, estoque=?, preco=? 
        WHERE id=?";
         $banco = Banco::conectar();
         $comando = $banco->prepare($sql);
         try{
         $comando->execute([$this->nome, $this->descricao, $this->id_categoria, $this->estoque, $this->preco, $this->id]);
         banco::desconectar();
         return $comando->rowCount();
         } catch(PDOException $e) {
            Banco::desconectar();
            return 0;
         }
    }

    public function Apagar(){
        $sql = "DELETE FROM produtos WHERE id = ?";
        $banco = Banco::conectar();
        $comando = $banco->prepare($sql);
        $comando->execute([$this->id]);
        banco::desconectar();
        return $comando->rowCount();
    }

}

?>