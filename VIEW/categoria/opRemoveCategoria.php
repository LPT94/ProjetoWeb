<?php

    include_once $_SERVER['DOCUMENT_ROOT'] . "/ProjetoWeb/DAL/categoria.php";

    $id = $_POST['id'];

    $dalCategoria = new DAL\Categoria();

    $resultado = $dalCategoria->delete($id);

    if(!$resultado){
        header("location: erroGenerico.html");
    }
    else{
        header("location: listaCategoria.php");
    }

?>