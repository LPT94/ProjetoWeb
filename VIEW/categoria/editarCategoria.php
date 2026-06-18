<?php

    session_start();
    if (!isset($_SESSION['login'])) {
        header("location: /ProjetoWeb/VIEW/index.php");
        exit;
    }

    include_once $_SERVER['DOCUMENT_ROOT'] . "/ProjetoWeb/VIEW/menu.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/ProjetoWeb/DAL/categoria.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/ProjetoWeb/MODEL/categoria.php";

    //validação id
    $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
    if ($id === false || $id === null) {
        header("location: listaVenda.php");
        exit;
    }

    use DAL\Categoria;

    $dalCategoria = new Categoria();

    $categoria = $dalCategoria->selectById($id);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Editar Categoria</title>

    <link rel="stylesheet" href="/ProjetoWeb/assets/css/style.css">

</head>

<body>

    <div class="container">

        <h1>Editar Categoria</h1>

        <form
            action="opEditarCategoria.php"
            method="POST"
            onsubmit="return validarFormulario()">

            <div class="grupo-form">

                <label>ID</label>

                <input
                    class="input-reduzido"
                    type="number"
                    name="id"
                    value="<?php echo $categoria->getId(); ?>"
                    readonly>

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
                    value="<?php echo $categoria->getDescricao(); ?>"
                    required>

                <small id="contador">
                    <?php echo strlen($categoria->getDescricao()); ?> / 100 caracteres
                </small>

            </div>

            <div class="botoes">

                <button
                    type="submit"
                    class="btn-salvar">Salvar Alterações
                </button>

                <a
                    href="listaCategoria.php"
                    class="btn-cancelar">
                    Voltar
                </a>

            </div>

        </form>

    </div>

    <script>
        <!-- script para não permitir inserir espaços vazios -->
        function validarFormulario(){

            let descricao =
                document.getElementById("descricao").value.trim();

            if(descricao === ""){
                alert("Informe a descrição da categoria.");
                return false;
            }
            return true;
        }

        const descricao =  document.getElementById("descricao");
        const contador = document.getElementById("contador");

        descricao.addEventListener("input", function(){

            contador.textContent =
                descricao.value.length + " / 100 caracteres";
        });

    </script>

</body>

</html>