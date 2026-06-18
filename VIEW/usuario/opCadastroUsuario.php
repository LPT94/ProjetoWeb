<?php
    session_start();
    if (!isset($_SESSION['login'])) {
        header("location: /ProjetoWeb/VIEW/index.php");
        exit;
    }

    if ($_SESSION['tipo'] != "admin") {
        header("location: /ProjetoWeb/VIEW/home.php");
        exit;
    }

    include_once $_SERVER['DOCUMENT_ROOT'] . "/ProjetoWeb/DAL/usuario.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/ProjetoWeb/MODEL/usuario.php";

    //---------validações
    if ($_SERVER['REQUEST_METHOD'] != 'POST') {
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

    $modelUsuario = new \MODEL\Usuario();
    $modelUsuario->setLogin($login);
    $modelUsuario->setSenha($md5);
    $modelUsuario->setTipo("comum");

    $dalUsuario = new \DAL\Usuario();
    $resultado = $dalUsuario->insert($modelUsuario);

    switch ($resultado) {
        case "sucesso":
            header("location: listaUsuario.php");
            exit;
        case "id_duplicado":
            header("location: erroIdDuplicado.html");
            exit;
        default:
            header("location: erroGenerico.html");
            exit;
    }
?>