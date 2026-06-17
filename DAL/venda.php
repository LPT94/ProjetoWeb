<?php

    namespace DAL;

    include_once $_SERVER['DOCUMENT_ROOT'] . "/ProjetoWeb/DAL/conexao.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/ProjetoWeb/MODEL/venda.php";

    class Venda{

        public function select(){
            $sql = "Select * from venda";
            $con = Conexao::conectar();
            $registros = $con->query($sql);
            Conexao::desconectar();

            $listaVenda = [];
            foreach($registros as $linha){
                $venda = new \MODEL\Venda();
                $venda->setId($linha['id']);
                $venda->setValor($linha['valor']);
                $venda->setData_venda($linha['data_venda']);
            
                $listaVenda[] = $venda;
            }
            return $listaVenda;
        }
    }

?>
