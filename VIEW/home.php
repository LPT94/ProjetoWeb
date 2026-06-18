<?php
    include_once $_SERVER['DOCUMENT_ROOT'] . "/ProjetoWeb/VIEW/menu.php";
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Sistema Automotiva</title>

    <link rel="stylesheet" href="/ProjetoWeb/assets/css/style.css">
</head>

<body>

<div class="container">

    <h1 style="text-align:center">Sistema de Gestão Automotiva</h1>
    <br>
    <div class="menu-home">

        <a href="/ProjetoWeb/VIEW/categoria/listaCategoria.php" class="card-menu">
            <h2>Categorias</h2>
            <p>Gerenciar categorias de produtos</p>
        </a>

        <a href="/ProjetoWeb/VIEW/produto/listaProduto.php" class="card-menu">
            <h2>Produtos</h2>
            <p>Consultar e controlar estoque</p>
        </a>

        <a href="/ProjetoWeb/VIEW/venda/listaVenda.php" class="card-menu">
            <h2>Vendas</h2>
            <p>Registrar e acompanhar vendas</p>
        </a>
        <a href="/ProjetoWeb/VIEW/usuario/listaUsuario.php" class="card-menu">
            <h2>Usuários</h2>
            <p>Administrar acessos ao sistema</p>
        </a>
    </div>

</div>

</body>
</html>