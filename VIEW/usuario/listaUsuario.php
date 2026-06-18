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
    include_once $_SERVER['DOCUMENT_ROOT'] . "/ProjetoWeb/DAL/usuario.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/ProjetoWeb/MODEL/usuario.php";

    use DAL\Usuario;

    $dalUsuario = new Usuario();

    $listaUsuario = $dalUsuario->select();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Usuarios</title>

    <link rel="stylesheet" href="/ProjetoWeb/assets/css/style.css">
</head>

<body>

    <div class="container">

        <div class="cabecalho">

            <h1>Lista de Usuarios</h1>

            <a href="cadastroUsuario.php" class="btn">
                Cadastrar usuário
            </a>

        </div>

        <table>

            <thead>
                <tr>
                    <th>Login</th>
                    <th>Tipo</th>
                    <th style="text-align: center;">Ações</th>
                </tr>
            </thead>

            <tbody>

                <?php

                if (count($listaUsuario) == 0) {

                    echo "<tr>
                    <td colspan='3'>Nenhum usuário cadastrado.</td>
                </tr>";
                } else {

                    foreach ($listaUsuario as $usuario) {
                ?>

                        <tr>
                            <td><?php echo $usuario->getLogin(); ?></td>
                            <td><?php echo $usuario->getTipo(); ?></td>
                            <td style="text-align: center;">
                                <a href="alterarUsuarioSenha.php?login=<?php echo $usuario->getLogin(); ?>" class="btn-editar">
                                    Alterar senha
                                </a>
                                &nbsp
                                <a href="alterarUsuarioTipo.php?login=<?php echo $usuario->getLogin(); ?>" class="btn-editar">
                                    Alterar tipo
                                </a>
                                &nbsp
                                <a href="removeUsuario.php?login=<?php echo $usuario->getLogin(); ?>" class="btn-excluir">
                                    Excluir
                                </a>
                            </td>
                        </tr>

                <?php
                    }
                }
                ?>

            </tbody>

        </table>

    </div>

</body>

</html>