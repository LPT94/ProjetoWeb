<?php

    session_start();
    if(!isset($_SESSION['login'])){
        header("location: /ProjetoWeb/VIEW/index.php");
        exit;
    }
    
    include_once $_SERVER['DOCUMENT_ROOT'] . "/ProjetoWeb/DAL/produto.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/ProjetoWeb/MODEL/produto.php";

    //---------validações
    if($_SERVER['REQUEST_METHOD'] != 'POST'){
        header("location: listaProduto.php");
        exit;
    }
    //validação id
    $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
    if($id === false || $id == null){
        header("location: erroGenerico.html");
        exit;
    }
    //validação id_categoria
    $id_categoria = filter_input(INPUT_POST, 'id_categoria', FILTER_VALIDATE_INT);
    if($id_categoria === false || $id_categoria == null){
        header("location: erroGenerico.html");
        exit;
    }
    //validação preco
    $preco = filter_input(INPUT_POST, 'preco', FILTER_VALIDATE_FLOAT);
    if($preco === false || $preco <= 0){
        header("location: erroGenerico.html");
        exit;
    }
    //validação estoque
    $qtde_estoque = filter_input(INPUT_POST, 'qtde_estoque', FILTER_VALIDATE_FLOAT);
    if($qtde_estoque == false || $qtde_estoque <= 0){
        header("location: erroGenerico.html");
        exit;
    }
    //validação strings
    $nome = trim($_POST['nome']);
    $descricao = trim($_POST['descricao']);
    $fabricante = trim($_POST['fabricante']);
    if(empty($nome) || empty($descricao) || empty($fabricante)){
        header("location: erroGenerico.html");
        exit;
    }
    
    $modelProduto = new \MODEL\Produto();

    $modelProduto->setId($id);
    $modelProduto->setId_categoria($id_categoria);
    $modelProduto->setNome($nome);
    $modelProduto->setDescricao($descricao);
    $modelProduto->setPreco($preco);
    $modelProduto->setQtde_estoque($qtde_estoque);
    $modelProduto->setFabricante($fabricante);

    $dalProduto = new \DAL\Produto();
    $resultado = $dalProduto->update($modelProduto);

    switch($resultado){
        case "fk_nao_encontrada":
            header("location: erroFk.html");
            exit;
        case "sucesso":
            header("location: listaProduto.php");
            exit;
        default:
            header("location: erroGenerico.html");
            exit;
    }
?>