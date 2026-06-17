<?php

    namespace DAL;

    include_once $_SERVER['DOCUMENT_ROOT'] . "/ProjetoWeb/DAL/conexao.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/ProjetoWeb/MODEL/venda.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/ProjetoWeb/DAL/item_venda.php";

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

        public function selectById(int $id){

            $sql = "Select * from venda where id=?";
            $con = Conexao::conectar();
            $query = $con->prepare($sql);
            $query->execute(array($id));
            $linha = $query->fetch(\PDO::FETCH_ASSOC);
            Conexao::desconectar();

            $venda = new \MODEL\Venda();
            $venda->setId($linha['id']);
            $venda->setValor($linha['valor']);
            $venda->setData_venda($linha['data_venda']);

            return $venda;
        }

        public function insert(\MODEL\Venda $venda,  array $produtos, array $quantidades, array $valores){
            try{
                $sqlVenda = "INSERT INTO venda (valor, data_venda)
                    VALUES(?, ?)";
                $con = Conexao::conectar();
                $con->beginTransaction();
                
                $query = $con->prepare($sqlVenda);
                $query->execute(array($venda->getValor(), $venda->getData_venda()));

                $idVenda = $con->lastInsertId();

                for($i=0; $i < count($produtos); $i++){
                    $sqlItemVenda = "INSERT INTO item_venda (id_venda, id_produto, qtde, valor)
                                VALUES (?, ?, ?, ?)";
                    
                    $query = $con->prepare($sqlItemVenda);
                    $query->execute(array($idVenda, $produtos[$i], $quantidades[$i], $quantidades[$i]*$valores[$i]));

                    $sqlEstoque = "UPDATE produto SET qtde_estoque = qtde_estoque - ? WHERE id=?";
                    $query = $con->prepare($sqlEstoque);
                    $query->execute(array($quantidades[$i], $produtos[$i]));
                }
                 $con->commit();
                 Conexao::desconectar();
                return "sucesso";
            }
            catch (\PDOException $e) {
                $con->rollBack();
                return "erro_generico";
            }
        }

        public function editInsert(\MODEL\Venda $venda,  array $produtos, array $quantidades, array $valores){
            try{
                $con = Conexao::conectar();
                $con->beginTransaction();

                $dalItensVenda = new \DAL\ItemVenda();
                $itensAntigos = $dalItensVenda->selectVendas($venda->getId());

                foreach($itensAntigos as $item){
                    $sqlRetornaEstoque = "UPDATE produto SET qtde_estoque = qtde_estoque + ? WHERE id=?";
                    $query = $con->prepare($sqlRetornaEstoque);
                    $query->execute(array($item->getQtde(), $item->getId_produto()));
                }

                $sqlDeletaItemVenda = "DELETE FROM item_venda WHERE id_venda=?";
                $query = $con->prepare($sqlDeletaItemVenda);
                $query->execute(array($venda->getId()));

                $sqlUpdateVenda = "UPDATE venda SET valor=?, data_venda=? WHERE id=?";
                $query = $con->prepare($sqlUpdateVenda);
                $query->execute(array($venda->getValor(), $venda->getData_venda(), $venda->getId()));

                for($i=0; $i < count($produtos); $i++){
                    $sqlItemVenda = "INSERT INTO item_venda (id_venda, id_produto, qtde, valor)
                                VALUES (?, ?, ?, ?)";
                    
                    $query = $con->prepare($sqlItemVenda);
                    $query->execute(array($venda->getId(), $produtos[$i], $quantidades[$i], $quantidades[$i]*$valores[$i]));

                    $sqlEstoque = "UPDATE produto SET qtde_estoque = qtde_estoque - ? WHERE id=?";
                    $query = $con->prepare($sqlEstoque);
                    $query->execute(array($quantidades[$i], $produtos[$i]));
                }
                $con->commit();
                Conexao::desconectar();
                return "sucesso";
            }
            catch (\PDOException $e) {
                $con->rollBack();
                return "erro_generico";
            }
        }

        public function delete(int $id){
            try{
                $con = Conexao::conectar();
                $con->beginTransaction();

                $dalItensVenda = new \DAL\ItemVenda();
                $itensVenda = $dalItensVenda->selectVendas($id);

                if(count($itensVenda) == 0){
                    return "itens_nao_encotrados";
                }

                foreach($itensVenda as $item){
                    $sqlRetornaEstoque = "UPDATE produto SET qtde_estoque = qtde_estoque + ? WHERE id=?";
                    $query = $con->prepare($sqlRetornaEstoque);
                    $query->execute(array($item->getQtde(), $item->getId_produto()));
                }
                
                $sqlDeletaItens = "DELETE FROM item_venda WHERE id_venda=?";
                $query = $con->prepare($sqlDeletaItens);
                $query->execute(array($id));

                $sqlDeletaVenda = "DELETE FROM venda WHERE id=?";
                $query = $con->prepare($sqlDeletaVenda);
                $query->execute(array($id));

                $con->commit();
                Conexao::desconectar();
                return "sucesso";
            }

            catch (\PDOException $e) {
                $con->rollBack();
                return "erro_generico";
            }
        }
    }

?>
