<?php
    
    session_start();
    if(!isset($_SESSION['login'])){
        header("location: /ProjetoWeb/VIEW/index.php");
        exit;
    }
    
    include_once $_SERVER['DOCUMENT_ROOT'] . "/ProjetoWeb/DAL/venda.php";

    //---------validações
    if($_SERVER['REQUEST_METHOD'] != 'POST'){
        header("location: listaVenda.php");
        exit;
    }
    //validação id
    $id = filter_input(INPUT_POST, 'id_venda', FILTER_VALIDATE_INT);
    if($id === false || $id == null){
        header("location: erroGenerico.html");
        exit;
    }

    $dalVenda = new \DAL\Venda();
    $resultado = $dalVenda->delete($id);

    switch($resultado){
        case "sucesso":
            header("location: listaVenda.php");
            exit;
        default:
            header("location: erroGenerico.html");
            exit;
    }
?>