<?php

    namespace DAL;

    include_once $_SERVER['DOCUMENT_ROOT'] . "/ProjetoWeb/DAL/conexao.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/ProjetoWeb/MODEL/categoria.php";

    class Categoria{

        public function select(){
            $sql = "Select * from categoria;";
            $con = Conexao::conectar();
            $registros = $con->query($sql);
            $con = Conexao::desconectar();

            $listaCategoria = [];
            foreach($registros as $linha){
                $categoria = new \MODEL\Categoria();
                $categoria->setId($linha['id']);
                $categoria->setDescricao($linha['descricao']);
            
                $listaCategoria[] = $categoria;
            }

            return $listaCategoria;
        }

    }

?>
