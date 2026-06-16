<?php

    namespace DAL;

    include_once $_SERVER['DOCUMENT_ROOT'] . "/ProjetoWeb/DAL/conexao.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/ProjetoWeb/MODEL/categoria.php";

    class Categoria{

        public function select(){
            $sql = "Select * from categoria;";
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

        public function insert(\MODEL\Categoria $categoria){

            try{
                $sql = "INSERT INTO categoria (id, descricao)
                VALUES ('{$categoria->getId()}', '{$categoria->getDescricao()}')";

                $con = Conexao::conectar();
                $resultado = $con->query($sql);
                Conexao::desconectar();

                return "Ok";
            }
            
            catch(\PDOException $e){
                if($e->getCode() == 23000){
                    return "id_duplicado";
                }
                return "erro";
            }
        }
        
    }

?>
