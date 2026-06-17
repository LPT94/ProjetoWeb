<?php
    include_once $_SERVER['DOCUMENT_ROOT'] . "/ProjetoWeb/DAL/produto.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/ProjetoWeb/MODEL/produto.php";

    $modelProduto = new \MODEL\Produto();

    $modelProduto->setId($_POST['id']);
    $modelProduto->setId_categoria($_POST['id_categoria']);
    $modelProduto->setNome($_POST['nome']);
    $modelProduto->setDescricao($_POST['descricao']);
    $modelProduto->setPreco($_POST['preco']);
    $modelProduto->setQtde_estoque($_POST['qtde_estoque']);
    $modelProduto->setFabricante($_POST['fabricante']);

    $dalProduto = new \DAL\Produto();
    $resultado = $dalProduto->update($modelProduto);

    switch($resultado){

        case "fk_nao_encontrada":
            header("location: erroFk.html");
            break;
        
        case "sucesso":
            header("location: listaProduto.php");
            break;
        
        default:
            echo $resultado;
            die();
            header("location: erroGenerico.html");
    }
?>