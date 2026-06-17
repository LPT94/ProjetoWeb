<?php

include_once $_SERVER['DOCUMENT_ROOT'] . "/ProjetoWeb/DAL/categoria.php";

use DAL\Categoria;

$dalCategoria = new Categoria();

$listaCategoria = $dalCategoria->select();

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Cadastro de Produt</title>

    <link rel="stylesheet" href="/ProjetoWeb/assets/css/style.css">
</head>

<body>

<div class="container">

    <h1>Cadastro de Produto</h1>

    <form
        action="opCadastroProduto.php"
        method="POST"
        onsubmit="return validarFormulario()"
    >

        <div class="grupo-form">

            <label>ID</label>

            <input
                class="input-reduzido"
                type="number"
                id="id"
                name="id"
                min="1"
                max="99999"
                required
            >

        </div>

        <div class="grupo-form">

            <label>Nome</label>

            <input
                class="input-maior"
                type="text"
                id="nome"
                name="nome"
                maxlength="50"
                required
            >
            <small id="contador0">
                0 / 50 caracteres
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
                required
            >

            <small id="contador1">
                0 / 100 caracteres
            </small>

        </div>

        <div class="grupo-form">

            <label>Categoria</label>

            <select
                class="input-maior"
                id="id_categoria"
                name="id_categoria"
                required
            >

                <option value="">
                    Selecione uma categoria
                </option>

                <?php foreach($listaCategoria as $categoria){ ?>

                    <option value="<?php echo $categoria->getId(); ?>">

                        <?php echo $categoria->getDescricao(); ?>

                    </option>

                <?php } ?>

            </select>

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
                required
            >
            <small id="contador2">
                0 / 50 caracteres
            </small>
        </div>

        <div class="botoes">

            <button
                type="submit"
                class="btn-salvar"
            >
                Salvar
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

