

<nav class="menu">
    <a href="/ProjetoWeb/VIEW/home.php">Home</a>

    <a href="/ProjetoWeb/VIEW/categoria/listaCategoria.php">
        Categorias
    </a>

    <a href="/ProjetoWeb/VIEW/produto/listaProduto.php">
        Produtos
    </a>

    <a href="/ProjetoWeb/VIEW/venda/listaVenda.php">
        Vendas
    </a>

    <?php if($_SESSION['tipo'] == "admin"){ ?>
        <a href="/ProjetoWeb/VIEW/usuario/listaUsuario.php">
            Usuarios
        </a>
    <?php } ?>
    

    <a href="/ProjetoWeb/VIEW/logout.php">
        Logout
    </a>
</nav>