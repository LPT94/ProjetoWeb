<?php

    include_once $_SERVER['DOCUMENT_ROOT'] . "/ProjetoWeb/DAL/categoria.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/ProjetoWeb/MODEL/categoria.php";

    $modelCategoria = new MODEL\Categoria();

    $modelCategoria->setId($_POST['id']);
    $modelCategoria->setDescricao($_POST['descricao']);

    $dalCategoria = new DAL\Categoria();
    
    $resultado = $dalCategoria->insert($modelCategoria);

    switch($resultado){

        case "id_duplicado":
            header("location: erroIdDuplicado.html");
            break;
        
        case "sucesso":
            header("location: listaCategoria.php");
            break;
        
        default:
            header("location: erroGenerico.html");
    }
?>