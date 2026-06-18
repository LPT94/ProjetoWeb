<?php
    
    session_start();
    if(!isset($_SESSION['login'])){
        header("location: /ProjetoWeb/VIEW/index.php");
        exit;
    }

    include_once $_SERVER['DOCUMENT_ROOT'] . "/ProjetoWeb/VIEW/menu.php";

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Categoria</title>

    <link rel="stylesheet" href="/ProjetoWeb/assets/css/style.css">

</head>
<body>

<div class="container">

    <h1>Cadastro de Categoria</h1>

    <form action="opCadastroCategoria.php" method="POST" onsubmit="return validarFormulario()">

        <div class="grupo-form">

            <label for="id">
                ID
            </label>

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

            <label for="descricao">
                Descrição
            </label>

            <input
                class="input-maior"
                type="text"
                id="descricao"
                name="descricao"
                maxlength="100"
                required
            >
            <small id="contador">
                     0 / 100 caracteres
            </small>
        </div>

        <div class="botoes">
            <button type="submit" class="btn">
                Salvar
            </button>
    
            <a  href="listaCategoria.php" class="btn-cancelar">
                Voltar
            </a>
        </div>


    </form>

</div>
<script> <!-- script para não permitir inserir espaços vazios -->
    function validarFormulario() {

        let descricao = document.getElementById("descricao").value.trim();

        if (descricao == "") {
            alert("Informe a descrição da categoria.");
            return false;
        }

        return true;
    }


       <!-- script para contar elementos inseridos no formulario no campo id='descricao' -->

document.addEventListener("DOMContentLoaded", function(){

    const descricao = document.getElementById("descricao");
    const contador = document.getElementById("contador");

    descricao.addEventListener("input", function(){

        contador.textContent =
            descricao.value.length + " / 100 caracteres";

    });

});

</script>
</body>
</html>

