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
                type="text"
                id="id"
                name="id"
                maxlength="5"
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

</body>
</html>

<script> <!-- script para não permitir inserir espaços vazios -->
    function validarFormulario() {

        let id = document.getElementById("id").value.trim();
        let descricao = document.getElementById("descricao").value.trim();

        if(id == ""){
            alert("Informe o id da categoria.");
            return false
        }

        if (descricao === "") {
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