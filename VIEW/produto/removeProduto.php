<?php

    include_once $_SERVER['DOCUMENT_ROOT'] . "/ProjetoWeb/DAL/categoria.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/ProjetoWeb/DAL/produto.php";

    //validação id
    $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
    if ($id === false || $id === null) {
        header("location: listaVenda.php");
        exit;
    }

    $dalProduto = new \DAL\Produto();
    $dalCategoria = new \DAL\Categoria();

    $produto = $dalProduto->selectById($id);
    $categoria = $dalCategoria->selectById($produto->getId_categoria());
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Remover Produto</title>

    <link rel="stylesheet" href="/ProjetoWeb/assets/css/style.css">

</head>

<body>

<div class="container">

    <h1>Remover Produto</h1>

    <form
        action="opRemoveProduto.php"
        method="POST"
        onsubmit="return confirmarFormulario()"
    >

        <div class="grupo-form">

            <label>ID</label>

            <input
                class="input-reduzido"
                type="number"
                id="id"
                name="id"
                value="<?php echo $produto->getId(); ?>"
                readonly
            >

        </div>

        <div class="grupo-form">

            <label>Nome</label>

            <input
                class="input-maior"
                type="text"
                id="nome"
                name="nome"
                value="<?php echo $produto->getNome(); ?>"
                readonly
            >
        </div>

        <div class="grupo-form">

            <label>Descrição</label>

            <input
                class="input-maior"
                type="text"
                id="descricao"
                name="descricao"
                value="<?php echo $produto->getDescricao(); ?>"
                readonly
            >
        </div>

        <div class="grupo-form">

            <label>Categoria</label>

            <input
                class="input-maior"
                type="text"
                id="descricao"
                name="descricao"
                value="<?php echo $categoria->getDescricao(); ?>"
                readonly
            >
        </div>

        <div class="grupo-form">

            <label>Preço</label>

            <input
                class="input-reduzido"
                type="number"
                id="preco"
                name="preco"
                value="<?php echo $produto->getPreco(); ?>"
                readonly
            >

        </div>

        <div class="grupo-form">

            <label>Quantidade em Estoque</label>

            <input
                class="input-reduzido"
                type="number"
                id="qtde_estoque"
                name="qtde_estoque"
                value="<?php echo $produto->getQtde_estoque(); ?>"
                readonly
            >

        </div>

        <div class="grupo-form">

            <label>Fabricante</label>

            <input
                class="input-maior"
                type="text"
                id="fabricante"
                name="fabricante"
                value="<?php echo $produto->getFabricante(); ?>"
                readonly
            >
        </div>

        <div class="botoes">

            <button type="submit"
                class="btn-salvar">
                Excluir
            </button>

            <a href="listaProduto.php"
                class="btn-cancelar">
                Cancelar
            </a>

        </div>

    </form>

</div>
<script>
function confirmarFormulario(){

    return confirm(
        "Tem certeza que deseja excluir esta categoria?"
    );

}
</script>
</body>
</html>