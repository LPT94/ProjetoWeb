<?php

    include_once $_SERVER['DOCUMENT_ROOT'] . "/ProjetoWeb/DAL/categoria.php";

    //---------validações
    if($_SERVER['REQUEST_METHOD'] != 'POST'){
        header("location: listaCategoria.php");
        exit;
    }

    $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);

    if($id === false || $id == null){
        header("location: erroGenerico.html");
        exit;
    }

    $dalCategoria = new DAL\Categoria();

    $resultado = $dalCategoria->delete($id);

    switch($resultado){
        case "sucesso":
            header("location: listaCategoria.php");
            exit;
        case "erro_fk_uso":
            header("location: erroFkUso.html");
            exit;
        default:
            header("location: erroGenerico.html");
            exit;
    }
?>