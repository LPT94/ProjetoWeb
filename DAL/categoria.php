<?php

    namespace DAL;

    include_once $_SERVER['DOCUMENT_ROOT'] . "/ProjetoWeb/DAL/conexao.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/ProjetoWeb/MODEL/categoria.php";

    class Categoria{

        public function select(){
            $sql = "Select * from categoria";
            $con = Conexao::conectar();
            $registros = $con->query($sql);
            Conexao::desconectar();

            $listaCategoria = [];
            foreach($registros as $linha){
                $categoria = new \MODEL\Categoria();
                $categoria->setId($linha['id']);
                $categoria->setDescricao($linha['descricao']);
            
                $listaCategoria[] = $categoria;
            }

            return $listaCategoria;
        }

        public function selectById(int $id){

            $sql = "Select * from categoria where id=?";
            $con = Conexao::conectar();
            $query = $con->prepare($sql);
            $query->execute(array($id));
            $linha = $query->fetch(\PDO::FETCH_ASSOC);
            Conexao::desconectar();

            $categoria = new \MODEL\Categoria();
            $categoria->setId($linha['id']);
            $categoria->setDescricao($linha['descricao']);

            return $categoria;
        }

        public function insert(\MODEL\Categoria $categoria){

            try{
                $sql = "INSERT INTO categoria (id, descricao)
                VALUES ('{$categoria->getId()}', '{$categoria->getDescricao()}')";

                $con = Conexao::conectar();
                $resultado = $con->query($sql);
                Conexao::desconectar();

                return "sucesso";
            }
            
            catch(\PDOException $e){
                if($e->getCode() == 23000){
                    return "id_duplicado";
                }
                return "erro";
            }
        }

        public function update(\MODEL\Categoria $categoria){

            try{
                $sql = "UPDATE categoria SET descricao =? where id=?";
                $con = Conexao::conectar();
                $query = $con->prepare($sql);
                $query->execute(array($categoria->getDescricao(), $categoria->getId()));
                Conexao::desconectar();
                return true;
            }
            catch(\PDOException $e){
                return false;
            }
        }

        public function delete(int $id){
            
            try{
                $sql = "DELETE from categoria where id=?";
                $con = Conexao::conectar();
                $query = $con->prepare($sql);
                $query->execute(array($id));
                Conexao::desconectar();

                return true;
            }
            catch(\PODEXception $e){
                return false;
            }
        }
    }

?>
