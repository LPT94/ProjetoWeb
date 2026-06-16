<?php

    include_once $_SERVER['DOCUMENT_ROOT'] . "/ProjetoWeb/DAL/categoria.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/ProjetoWeb/MODEL/categoria.php";

    $modelCategoria = new MODEL\Categoria();
    

    $modelCategoria->setId($_POST['id']);
    $modelCategoria->setDescricao($_POST['descricao']);

    $dalCategoria = new DAL\Categoria();
    
    $resultado = $dalCategoria->update($modelCategoria);

    if($resultado){
        header("location: listaCategoria.php");
    }
    else{
        header("location: erroGenerico.html");
    }

?>