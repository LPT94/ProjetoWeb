<?php

    session_start();
    if(!isset($_SESSION['login'])){
        header("location: /ProjetoWeb/VIEW/index.php");
        exit;
    }
    
    include_once $_SERVER['DOCUMENT_ROOT'] . "/ProjetoWeb/DAL/categoria.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/ProjetoWeb/MODEL/categoria.php";

    //---------validações
    if($_SERVER['REQUEST_METHOD'] != 'POST'){
        header("location: cadastroCategoria.php");
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

    $modelCategoria = new MODEL\Categoria();

    $modelCategoria->setId($id);
    $modelCategoria->setDescricao($descricao);

    $dalCategoria = new DAL\Categoria();
    
    $resultado = $dalCategoria->insert($modelCategoria);

    switch($resultado){

        case "id_duplicado":
            header("location: erroIdDuplicado.html");
            exit;
        
        case "sucesso":
            header("location: listaCategoria.php");
            exit;
        
        default:
            header("location: erroGenerico.html");
            exit;
    }
?>