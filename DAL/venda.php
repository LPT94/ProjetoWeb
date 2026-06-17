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
    }

?>
