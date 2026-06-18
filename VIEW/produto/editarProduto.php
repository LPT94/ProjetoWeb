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

    //validação id
    $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
    if ($id === false || $id === null) {
        header("location: listaVenda.php");
        exit;
    }

    $dalProduto = new \DAL\Produto();
    $dalCategoria = new \DAL\Categoria();

    $produto = $dalProduto->selectById($id);
    $listaCategoria = $dalCategoria->select();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Editar Produto</title>

    <link rel="stylesheet" href="/ProjetoWeb/assets/css/style.css">

</head>

<body>

<div class="container">

    <h1>Editar Produto</h1>

    <form
        action="opEditarProduto.php"
        method="POST"
        onsubmit="return validarFormulario()"
    >

        <div class="grupo-form">

            <label>ID</label>

            <input
                class = "input-reduzido"
                type="number"
                name="id"
                value="<?php echo $produto->getId(); ?>"
                readonly
            >

        </div>

        <div class="grupo-form">

            <label>Categoria</label>

            <select
                class="input-maior"
                id="id_categoria"
                name="id_categoria"
                required
            >
            <?php foreach($listaCategoria as $categoria){ ?>
            <option
                value="<?php echo $categoria->getId(); ?>"
                <?php if($categoria->getId() == $produto->getId_categoria()){
                        echo "selected";
                      }?>>
                        <?php echo $categoria->getDescricao(); ?>
            </option>
            <?php } ?>

            </select>

        </div>

        <div class="grupo-form">

            <label>Nome</label>

            <input
                class="input-maior"
                type="text"
                id="nome"
                name="nome"
                maxlength="50"
                value="<?php echo $produto->getNome(); ?>"
                required
            >
            <small id="contador0">
                <?php echo strlen($produto->getNome()); ?> / 50 caracteres
            </small>
        </div>

        <div class="grupo-form">

            <label>Descrição</label>

            <input
                class="input-maior"
                type="text"
                id="descricao"
                name="descricao"
                maxlength="100"
                value="<?php echo $produto->getDescricao(); ?>"
                required
            >

            <small id="contador1">
                <?php echo strlen($produto->getDescricao()); ?> / 100 caracteres
            </small>

        </div>

        <div class="grupo-form">

            <label>Preço</label>

            <input
                class="input-reduzido"
                type="number"
                id="preco"
                name="preco"
                step="0.01"
                min="0.5"
                value="<?php echo $produto->getPreco(); ?>"
                required
            >

        </div>

        <div class="grupo-form">

            <label>Quantidade em Estoque</label>

            <input
                class="input-reduzido"
                type="number"
                id="qtde_estoque"
                name="qtde_estoque"
                min="0"
                value="<?php echo $produto->getQtde_estoque(); ?>"
                required
            >

        </div>

        <div class="grupo-form">

            <label>Fabricante</label>

            <input
                class="input-maior"
                type="text"
                id="fabricante"
                name="fabricante"
                maxlength="50"
                value="<?php echo $produto->getFabricante(); ?>"
                required
            >
            <small id="contador2">
                <?php echo strlen($produto->getFabricante()); ?> / 50 caracteres
            </small>
        </div>

        <div class="botoes">

            <button
                type="submit"
                class="btn-salvar"
            >
                Salvar Alterações
            </button>

            <a
                href="listaProduto.php"
                class="btn-cancelar"
            >
                Cancelar
            </a>

        </div>

    </form>

</div>
<script>

function validarFormulario(){

    let descricao = document.getElementById("descricao").value.trim();
    let nome = document.getElementById("nome").value.trim();
    let fabricante = document.getElementById("fabricante").value.trim();

    let preco = document.getElementById("preco").value();

    if(nome == ""){
        alert("informe um nome válido");
        return false;
    }

    if(descricao == ""){
        alert("Informe uma descrição válida.");
        return false;
    }

     if(fabricante == ""){
        alert("Informe um fabricante válido.");
        return false;
    }

    return true;
}

      <!-- script para contar elementos inseridos no formulario no campo id='descricao' -->

document.addEventListener("DOMContentLoaded", function(){

    const nome = document.getElementById("nome");
    const descricao = document.getElementById("descricao");
    const fabricante = document.getElementById("fabricante");

    const contador0 = document.getElementById("contador0");
    const contador1 = document.getElementById("contador1");
    const contador2 = document.getElementById("contador2");
    
    nome.addEventListener("input", function(){
        contador0.textContent =
            nome.value.length + " / 50 caracteres";
    });

    descricao.addEventListener("input", function(){
        contador1.textContent =
            descricao.value.length + " / 100 caracteres";
    });

    fabricante.addEventListener("input", function(){
        contador2.textContent =
            fabricante.value.length + " / 50 caracteres";
    });

});

</script>
</body>
</html>

