<?php

    namespace DAL;

    include_once $_SERVER['DOCUMENT_ROOT'] . "/ProjetoWeb/DAL/conexao.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/ProjetoWeb/MODEL/produto.php";

    class Produto{
        
        public function select(){
            $sql = "Select * from produto";
            $con = Conexao::conectar();
            $registros = $con->query($sql);
            Conexao::desconectar();

            $listaProduto = [];
            foreach($registros as $linha){
                $produto = new \MODEL\Produto();
                $produto->setId($linha['id']);
                $produto->setId_categoria($linha['id_categoria']);
                $produto->setNome($linha['nome']);
                $produto->setDescricao($linha['descricao']);
                $produto->setPreco($linha['preco']);
                $produto->setQtde_estoque($linha['qtde_estoque']);
                $produto->setFabricante($linha['fabricante']);
            
                $listaProduto[] = $produto;
            }
            return $listaProduto;
        }

        public function selectById(int $id){

            $sql = "SELECT * FROM produto where id=?";
            $con = Conexao::conectar();
            $query = $con->prepare($sql);
            $query->execute(array($id));
            $resultado = $query->fetch(\PDO::FETCH_ASSOC);
            Conexao::desconectar();

            $produto = new \MODEL\Produto();
            $produto->setId($resultado['id']);
            $produto->setId_categoria($resultado['id_categoria']);
            $produto->setNome($resultado['nome']);
            $produto->setDescricao($resultado['descricao']);
            $produto->setPreco($resultado['preco']);
            $produto->setQtde_estoque($resultado['qtde_estoque']);
            $produto->setFabricante($resultado['fabricante']);

            return $produto;

        }

        public function insert(\MODEL\Produto $produto){
            try{
                $sql = "INSERT INTO produto(id, id_categoria, nome, descricao, preco, qtde_estoque, fabricante)
                VALUES(?, ?, ?, ?, ?, ?, ?)";
                $con = Conexao::conectar();
                $query = $con->prepare($sql);
                $query->execute(array($produto->getId(), $produto->getId_categoria(), $produto->getNome(),
                                $produto->getDescricao(), $produto->getPreco(), $produto->getQtde_estoque(),
                                $produto->getFabricante()));

                return "sucesso";
            }
            catch(\PDOException $e){

                $erro = $e->errorInfo[1];

                switch($erro){
                    case 1062:
                        return "id_duplicado";
                    case 1452:
                        return "fk_nao_encontrada";
                    default:
                        return "erro_generico";
                }
            }
        }

        public function update(\MODEL\Produto $produto){
            try{
                $sql = "UPDATE produto SET id_categoria=?, nome=?, descricao=?,
                                           preco=?, qtde_estoque=?, fabricante=? where id=?";
                $con = Conexao::conectar();
                $query = $con->prepare($sql);
                $query->execute(array($produto->getId_categoria(), $produto->getNome(), $produto->getDescricao(),
                                       $produto->getPreco(), $produto->getQtde_estoque(), $produto->getFabricante(),
                                       $produto->getId()));
                Conexao::desconectar();
                return "sucesso";
            }
            catch(\PDOException $e){
                $erro = $e->errorInfo[1];
                switch($erro){
                    case 1452:
                        return "fk_nao_encontrada";
                    default:
                        return "erro_generico";
                }
            }
        }

        public function delete(int $id){
            
            try{
                $sql = "DELETE from produto where id=?";
                $con = Conexao::conectar();
                $query = $con->prepare($sql);
                $query->execute(array($id));
                Conexao::desconectar();

                return "sucesso";
            }
            catch(\PDOException $e){
                $erro = $e->errorInfo[1];
                switch($erro){
                    case 1451:
                        return "erro_fk_uso";
                    default:
                        return "erro_generico";
                }
            }
        }
    }

?>