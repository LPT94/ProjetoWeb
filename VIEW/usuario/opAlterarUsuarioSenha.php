<?php

    include_once $_SERVER['DOCUMENT_ROOT'] . "/ProjetoWeb/DAL/usuario.php";

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
    //validação senha
    $senha = $_POST['senha'];
    if (isset($senha) && $senha == '') {
        header("location: cadastroUsuario.php");
        exit;
    }

    $md5 = md5($senha);
    $dalUsuario = new \DAL\Usuario();
    $resultado = $dalUsuario->updateSenha($login, $md5);

    switch($resultado){
        case "sucesso":
            header("location: operacaoSucesso.html");
            break;
        case "erro":
            header("location: erroGenerico2.html");
            break;
    }

?>