<?php

    session_start();

    include_once $_SERVER['DOCUMENT_ROOT'] . "/ProjetoWeb/DAL/usuario.php";

    //-------validações
    if($_SERVER['REQUEST_METHOD'] != 'POST'){
        header("location: index.php");
        exit;
    }

    $login = trim($_POST['login']);

    if($login == ""){
        header("location: index.php");
        exit;
    }

    $senha = trim($_POST['senha']);
    $md5 = md5($senha);

    $dalUsuario = new \DAL\Usuario();
    $usuario = $dalUsuario->login($login, $md5);

    if($usuario == null){
        header("location: index.php");
        exit;
    }

    $_SESSION['login'] = $usuario->getLogin();
    $_SESSION['tipo'] = $usuario->getTipo();

    header("location: home.php");
    exit;
?>