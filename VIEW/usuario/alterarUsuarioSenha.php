<?php

    include_once $_SERVER['DOCUMENT_ROOT'] . "/ProjetoWeb/VIEW/menu.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/ProjetoWeb/DAL/usuario.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/ProjetoWeb/MODEL/usuario.php";

   //validação login
   $login = $_GET['login'];
   if (isset($login) && $login == '') {
        header("location: listaUsuario.php");
        exit;
    }

    $dalUsuario = new \DAL\Usuario();
    $usuario = $dalUsuario->selectById($login);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alterar Senha</title>

    <link rel="stylesheet" href="/ProjetoWeb/assets/css/style.css">

</head>
<body>

<div class="container" style="text-align:center">

    <h1>Alterar Senha</h1>

    <form action="opAlterarUsuarioSenha.php" method="POST" onsubmit="return validarFormulario()">

        <div class="grupo-form">

            <label for="login" >
                Login
            </label>

            <input
                class="input-medio"
                type="text"
                id="login"
                name="login"
                value="<?php echo $usuario->getLogin(); ?>"
                readonly
            >
        </div>
    
        <div class="grupo-form">

            <label for="senha">
                Senha
            </label>

            <input
                class="input-medio"
                type="text"
                id="senha"
                name="senha"
                maxlength="32"
                required
            >
        </div>

        <div class="botoes">
            <button type="submit" class="btn">
                Alterar senha
            </button>
    
            <a  href="listaUsuario.php" class="btn-cancelar">
                Cancelar
            </a>
        </div>


    </form>

</div>
<script> <!-- script para não permitir inserir espaços vazios -->
    function validarFormulario() {

        let senha = document.getElementById("senha").value.trim();

        if (senha == "") {
            alert("Informe uma senha válida.");
            return false;
        }

        return true;
    }
</script>
</body>
</html>
