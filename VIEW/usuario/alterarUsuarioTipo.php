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

    $tipo0 = $usuario->getTipo();
    if($tipo0 == "comum"){
        $tipo1 = "admin";
    }
    else{
        $tipo1 = "comum";
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alterar tipo</title>

    <link rel="stylesheet" href="/ProjetoWeb/assets/css/style.css">

</head>
<body>

<div class="container" style="text-align:center">

    <h1>Alterar tipo</h1>

    <form action="opAlterarUsuarioTipo.php" method="POST" onsubmit="return validarFormulario()">

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
            <select
                    class="input-medio"
                    id="tipo"
                    name="tipo"
                >
                    <option value="<?php echo $tipo0 ?>">
                        <?php echo $tipo0; ?>
                    </option>
                        <option value="<?php echo $tipo1 ?>">
                            <?php echo $tipo1;  ?>
                        </option>
            </select>
        </div>
        <div class="botoes">
            <button type="submit" class="btn">
                Alterar Tipo
            </button>
    
            <a  href="listaUsuario.php" class="btn-cancelar">
                Cancelar
            </a>
        </div>


    </form>

</div>

</body>
</html>