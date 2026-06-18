<?php

    include_once $_SERVER['DOCUMENT_ROOT'] . "/ProjetoWeb/DAL/usuario.php";

   //---------validações
    if($_SERVER['REQUEST_METHOD'] != 'POST'){
        header("location: removeUsuario.php");
        exit;
    }
   //validação login
   $login = $_POST['login'];
   if (isset($login) && $login == '') {
        header("location: removeUsuario.php");
        exit;
    }

    $dalUsuario = new \DAL\Usuario();
    $resultado = $dalUsuario->delete($login);

    switch($resultado){
        case "sucesso":
            header("location: operacaoSucesso.html");
            break;
        case "erro":
            header("location: erroGenerico2.html");
            break;
    }

?>