<?php

    session_start();
    if(!isset($_SESSION['login'])){
        header("location: /ProjetoWeb/VIEW/index.php");
        exit;
    }

    if($_SESSION['tipo'] != "admin"){
        header("location: /ProjetoWeb/VIEW/home.php");
        exit;
    }
    
    include_once $_SERVER['DOCUMENT_ROOT'] . "/ProjetoWeb/DAL/usuario.php";

    //---------validações
    if($_SERVER['REQUEST_METHOD'] != 'POST'){
        header("location: cadastroUsuario.php");
        exit;
    }
   //validação login
   $login = $_POST['login'];
   if (isset($login) && $login == '') {
        header("location: cadastroUsuario.php");
        exit;
    }
    //validação tipo
    $tipo = $_POST['tipo'];
    if (isset($tipo) && $tipo == '') {
        header("location: cadastroUsuario.php");
        exit;
    }

    $dalUsuario = new \DAL\Usuario();
    $resultado = $dalUsuario->updateTipo($login, $tipo);

    switch($resultado){
        case "sucesso":
            header("location: operacaoSucesso.html");
            break;
        case "erro":
            header("location: erroGenerico2.html");
            break;
    }
?>