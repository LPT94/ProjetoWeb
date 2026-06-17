<?php

    include_once $_SERVER['DOCUMENT_ROOT'] . "/ProjetoWeb/DAL/produto.php";

    $id = $_POST['id'];

    $dalProduto = new DAL\Produto();

    $resultado = $dalProduto->delete($id);

    switch($resultado){
        case "sucesso":
            header("location: listaProduto.php");
            break;
        case "erro_fk_uso":
            header("location: erroFkUso.html");
            break;
        default:
            header("location: erroGenerico.html");
            break;
    }
?>