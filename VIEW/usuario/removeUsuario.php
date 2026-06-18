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
    <title>Remover Usuario</title>

    <link rel="stylesheet" href="/ProjetoWeb/assets/css/style.css">

</head>
<body>

<div class="container" style="text-align:center">

    <h1>Remover Usuario</h1>

    <form action="opRemoveUsuario.php" method="POST" onsubmit="return confirmarFormulario()">

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

            <label for="login" >
                Tipo
            </label>

            <input
                class="input-medio"
                type="text"
                id="tipo"
                name="tipo"
                value="<?php echo $usuario->getTipo(); ?>"
                readonly
            >
        </div>

        <div class="botoes">
            <button type="submit" class="btn">
                Remover
            </button>
    
            <a  href="listaUsuario.php" class="btn-cancelar">
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