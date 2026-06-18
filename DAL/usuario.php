<?php

    namespace DAL;

    include_once $_SERVER['DOCUMENT_ROOT'] . "/ProjetoWeb/DAL/conexao.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/ProjetoWeb/MODEL/usuario.php";

    class Usuario{

        public function select(){
            $sql = "SELECT * FROM usuario";
            $con = Conexao::conectar();
            $resultado = $con->query($sql);
            Conexao::desconectar();

            $listaUsuarios = [];
            foreach($resultado as $linha){
                $usuario = new \MODEL\Usuario();
                $usuario->setLogin($linha['login']);
                $usuario->setSenha($linha['senha']);
                $usuario->setTipo($linha['tipo']);
                
                $listaUsuarios[] = $usuario;
            }
            return $listaUsuarios;
        }

        public function selectById(string $login){
            $sql = "SELECT * FROM usuario WHERE login=?";
            $con = Conexao::conectar();
            $query = $con->prepare($sql);
            $query->execute(array($login));
            $resultado = $query->fetch(\PDO::FETCH_ASSOC);
            Conexao::desconectar();

            $usuario = new \MODEL\Usuario();
            $usuario->setLogin($resultado['login']);
            $usuario->setSenha($resultado['senha']);
            $usuario->setTipo($resultado['tipo']);

            return $usuario;
        }

        public function insert(\MODEL\Usuario $usuario){
            try{
                $sql = "INSERT INTO usuario (login, senha, tipo)
                    VALUES(?, ?, ?)";
                $con = Conexao::conectar();
                $query = $con->prepare($sql);
                $resultado = $query->execute(array($usuario->getLogin(), $usuario->getSenha(), $usuario->getTipo()));
                Conexao::desconectar();
                return "sucesso"; 
            }
            catch(\PDOException $e){

                $erro = $e->errorInfo[1];
                switch($erro){
                    case 1062:
                        return "id_duplicado";
                    default:
                        return "erro_generico";
                }
            }
        }

        public function updateSenha(string $login, string $senha){
            try{
                $sql = "UPDATE usuario SET senha=? WHERE login=?";
                $con = Conexao::conectar();
                $query = $con->prepare($sql);
                $query->execute(array($senha, $login));
                Conexao::desconectar();
                return "sucesso";
            }   
            catch(\PDOException $e){
                return "erro";
            }
        }

        public function updateTipo(string $login, string $tipo){
            try{
                $sql = "UPDATE usuario SET tipo=? WHERE login=?";
                $con = Conexao::conectar();
                $query = $con->prepare($sql);
                $query->execute(array($tipo, $login));
                Conexao::desconectar();
                return "sucesso";
            }
            catch(\PDOException $e){
                return "erro";
            }
        }

        public function delete(string $login){
            try{
                $sql = "DELETE FROM usuario WHERE login=?";
                $con = Conexao::conectar();
                $query = $con->prepare($sql);
                $query->execute(array($login));
                Conexao::desconectar();
                return "sucesso";
            }
            catch(\PDOException $e){
                return "erro";
            }
        }
    }
?>