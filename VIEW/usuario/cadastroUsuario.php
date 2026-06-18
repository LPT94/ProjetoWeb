<?php

    session_start();
    if (!isset($_SESSION['login'])) {
        header("location: /ProjetoWeb/VIEW/index.php");
        exit;
    }

    if ($_SESSION['tipo'] != "admin") {
        header("location: /ProjetoWeb/VIEW/home.php");
        exit;
    }

    include_once $_SERVER['DOCUMENT_ROOT'] . "/ProjetoWeb/VIEW/menu.php";
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro usuário</title>

    <link rel="stylesheet" href="/ProjetoWeb/assets/css/style.css">

</head>

<body>

    <div class="container" style="text-align:center">

        <h1>Cadastro usuário</h1>
        <br>
        <form action="opCadastroUsuario.php" method="POST" onsubmit="return validarFormulario()">

            <div class="grupo-form">

                <label for="login">
                    Login
                </label>

                <input
                    class="input-medio"
                    type="text"
                    id="login"
                    name="login"
                    min="1"
                    maxlength="20"
                    required>
            </div>

            <div class="grupo-form">

                <label for="senha">
                    Senha
                </label>

                <input
                    class="input-medio"
                    type="password"
                    id="senha"
                    name="senha"
                    maxlength="32"
                    required>
            </div>

            <div class="botoes">
                <button type="submit" class="btn">
                    Cadastrar
                </button>

                <a href="listaUsuario.php" class="btn-cancelar">
                    Cancelar
                </a>
            </div>


        </form>

    </div>
    <script>
        <!-- script para não permitir inserir espaços vazios -->
        function validarFormulario() {
            let senha =  document.getElementById("senha").value.trim();
            if(senha == ""){
                alert("Informe uma senha válida.");
                return false;
            }
            return true;
        }

    </script>
</body>

</html>