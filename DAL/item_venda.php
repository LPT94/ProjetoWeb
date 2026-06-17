<?php

    namespace DAL;

    include_once $_SERVER['DOCUMENT_ROOT'] . "/ProjetoWeb/DAL/conexao.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/ProjetoWeb/MODEL/item_venda.php";
    

    class ItemVenda{

        public function selectVendas(int $id_venda){
            $sql = "Select * from item_venda where id_venda=?";
  
            $con = Conexao::conectar();
            $query = $con->prepare($sql);
            $query->execute(array($id_venda));
            $resultado = $query->fetchAll(\PDO::FETCH_ASSOC);
            Conexao::desconectar();

            $listaItens = [];
            foreach($resultado as $linha){
                $item = new \MODEL\ItemVenda();
                $item->setId_venda($linha['id_venda']);
                $item->setId_produto($linha['id_produto']);
                $item->setQtde($linha['qtde']);
                $item->setValor($linha['valor']);
                $listaItens[] = $item;
            }
            return $listaItens;
        }
    }

?>