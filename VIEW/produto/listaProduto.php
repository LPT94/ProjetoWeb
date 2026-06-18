<?php

    session_start();
    if(!isset($_SESSION['login'])){
        header("location: /ProjetoWeb/VIEW/index.php");
        exit;
    }
    
    include_once $_SERVER['DOCUMENT_ROOT'] . "/ProjetoWeb/VIEW/menu.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/ProjetoWeb/DAL/categoria.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/ProjetoWeb/MODEL/categoria.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/ProjetoWeb/DAL/produto.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/ProjetoWeb/MODEL/produto.php";


    $dalProduto = new \DAL\Produto();
    $dalCategoria = new \DAL\Categoria();

    $listaProduto = $dalProduto->select();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Produtos</title>

    <link rel="stylesheet" href="/ProjetoWeb/assets/css/style.css">
</head>
<body>

    <div class="container">

        <div class="cabecalho">

            <h1>Produtos</h1>

            <a href="cadastroProduto.php" class="btn">
                Novo Produto
            </a>

        </div>

        <?php if(count($listaProduto) == 0){

            echo "<p>Nenhum produto cadastrado.</p>";

        }else{

            foreach($listaProduto as $produto){

        ?>

            <div class="card-produto">

                <h2>
                    Produto #<?php echo $produto->getId(); ?>
                </h2>

                <p>
                    <strong>Nome:</strong>
                    <?php echo $produto->getNome(); ?>
                </p>

                <p>
                    <strong>Categoria:</strong>
                    <?php echo $produto->getId_categoria();?>
                    <strong>Descrição:</strong>
                    <?php echo $dalCategoria->selectById($produto->getId_categoria())->getDescricao(); ?>
                </p>

                <p>
                    <strong>Fabricante:</strong>
                    <?php echo $produto->getFabricante(); ?>
                </p>

                <p>
                    <strong>Preço:</strong>
                    R$ <?php echo number_format($produto->getPreco(),2,",","."); ?>
                </p>

                <p>
                    <strong>Estoque:</strong>
                    <?php echo $produto->getQtde_estoque(); ?>
                </p>

                <p>
                    <strong>Descrição Produto:</strong>
                    <?php echo $produto->getDescricao(); ?>
                </p>

                <div class="acoes">

                    <a
                        href="editarProduto.php?id=<?php echo $produto->getId(); ?>"
                        class="btn-editar">
                        Editar
                    </a>

                    <a
                        href="removeProduto.php?id=<?php echo $produto->getId(); ?>"
                        class="btn-excluir">
                        Excluir
                    </a>

                </div>

            </div>

        <?php

            }
        }

        ?>

    </div>
</body>
</html>