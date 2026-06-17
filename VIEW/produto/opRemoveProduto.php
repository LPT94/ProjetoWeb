<?php

    include_once $_SERVER['DOCUMENT_ROOT'] . "/ProjetoWeb/DAL/produto.php";

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

    $dalProduto = new DAL\Produto();

    $resultado = $dalProduto->delete($id);

    switch($resultado){
        case "sucesso":
            header("location: listaProduto.php");
            exit;
        case "erro_fk_uso":
            header("location: erroFkUso.html");
            exit;
        default:
            header("location: erroGenerico.html");
            exit;
    }
?>