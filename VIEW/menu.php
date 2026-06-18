<nav class="menu">

    <div class="logo-menu">
        <img src="/ProjetoWeb/IMAGES/logoAutomotiva.png" alt="Sistema Automotiva">
    </div>
    &nbsp
    <a href="/ProjetoWeb/VIEW/home.php">Home</a>
    &nbsp
    <a href="/ProjetoWeb/VIEW/categoria/listaCategoria.php">
        Categorias
    </a>
    &nbsp
    <a href="/ProjetoWeb/VIEW/produto/listaProduto.php">
        Produtos
    </a>
    &nbsp
    <a href="/ProjetoWeb/VIEW/venda/listaVenda.php">
        Vendas
    </a>
    &nbsp
    <?php if ($_SESSION['tipo'] == "admin") { ?>
        <a href="/ProjetoWeb/VIEW/usuario/listaUsuario.php">
            Usuarios
        </a>
    <?php } ?>
    &nbsp

    <a href="/ProjetoWeb/VIEW/logout.php">
        Logout
    </a>
</nav>