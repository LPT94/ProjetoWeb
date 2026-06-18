<?php

    session_start();
    if(!isset($_SESSION['login'])){
        header("location: /ProjetoWeb/VIEW/index.php");
        exit;
    }
    
    include_once $_SERVER['DOCUMENT_ROOT'] . "/ProjetoWeb/DAL/categoria.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/ProjetoWeb/MODEL/categoria.php";

    $modelCategoria = new MODEL\Categoria();
    
    //---------validações
    if($_SERVER['REQUEST_METHOD'] != 'POST'){
        header("location: listaCategoria.php");
        exit;
    }
    //validação id
    $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
    if($id === false || $id == null){
        header("location: erroGenerico.html");
        exit;
    }
    //validação string
    $descricao = trim($_POST['descricao']);
    if(empty($descricao)){
        header("location: erroGenerico.html");
        exit;
    }
    
    $modelCategoria->setId($id);
    $modelCategoria->setDescricao($descricao);

    $dalCategoria = new DAL\Categoria();
    
    $resultado = $dalCategoria->update($modelCategoria);

    if($resultado){
        header("location: listaCategoria.php");
        exit;
    }
    else{
        header("location: erroGenerico.html");
        exit;
    }

?>