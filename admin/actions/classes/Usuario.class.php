<?php

require_once('Banco.class.php');

class Usuario
{
    // Atributos da classe
    public $id;
    public $nome;
    public $email;
    public $senha;

    public function Cadastrar()
    {
        $sql = "INSERT INTO usuarios(nome, email, senha) VALUES (?, ?, ?)";
        $banco = Banco::conectar();
        $comando = $banco->prepare($sql);

        // hash da senha:
        $hash = hash("sha256", $this->senha);

        try{
            $comando->execute([$this->nome, $this->email, $hash]);
            banco::desconectar();
            return $comando->rowCount();
        } catch (PDOException $e) {
            Banco::desconectar();
            return 0;
        }
    }

    public function Logar()
    {
        $sql = "SELECT * FROM usuarios WHERE email = ? AND senha = ?";
        $banco = Banco::conectar();
        $comando = $banco->prepare($sql);

        // tirar hash da senha para comparar
        $hash = hash("sha256", $this->senha);
        $comando->execute([$this->email, $hash]);

        $arr_resultado = $comando->fetchAll(PDO::FETCH_ASSOC);
        Banco::desconectar();
        return $arr_resultado;
    }
}
