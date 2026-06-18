<?php

    session_start();
    if (!isset($_SESSION['login'])) {
        header("location: /ProjetoWeb/VIEW/index.php");
        exit;
    }

    include_once $_SERVER['DOCUMENT_ROOT'] . "/ProjetoWeb/DAL/produto.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/ProjetoWeb/MODEL/produto.php";

    //validação de id
    $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
    if ($id === false || $id === null) {
        die("ID inválido.");
    }


    $dalProduto = new \DAL\Produto();

    $produto = $dalProduto->selectById($id);
?>



<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ERRO Estoque!</title>

    <link rel="stylesheet" href="/ProjetoWeb/assets/css/style.css">
</head>

<body>
    <div class="container">
        <h1 text-align="center">Estoque insuficiente para o produto <?php echo $produto->getNome(); ?></h1>
        <br>
        <br>
        <center><a href="listaVenda.php" class="btn-cancelar">voltar</a></center>
    </div>

</body>

</html>