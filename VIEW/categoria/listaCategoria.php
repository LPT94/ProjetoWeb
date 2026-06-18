<?php

    session_start();
    if(!isset($_SESSION['login'])){
        header("location: /ProjetoWeb/VIEW/index.php");
        exit;
    }
    
    include_once $_SERVER['DOCUMENT_ROOT'] . "/ProjetoWeb/VIEW/menu.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/ProjetoWeb/DAL/categoria.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/ProjetoWeb/MODEL/categoria.php";

    use DAL\Categoria;

    $dalCategoria = new Categoria();

    $listaCategoria = $dalCategoria->select();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Categorias</title>

    <link rel="stylesheet" href="/ProjetoWeb/assets/css/style.css">
</head>
<body>

<div class="container">

    <div class="cabecalho">

        <h1>Categorias</h1>

        <a href="cadastroCategoria.php" class="btn">
            Nova Categoria
        </a>

    </div>

    <table>

        <thead>
            <tr>
                <th>ID</th>
                <th>Descrição</th>
                <th>Ações</th>
            </tr>
        </thead>

        <tbody>

        <?php

        if(count($listaCategoria) == 0){

            echo "
                <tr>
                    <td colspan='3'>Nenhuma categoria cadastrada.</td>
                </tr>
            ";

        }else{

            foreach($listaCategoria as $categoria){
        ?>

                <tr>

                    <td><?php echo $categoria->getId(); ?></td>

                    <td><?php echo $categoria->getDescricao(); ?></td>

                    <td>

                        <a href="editarCategoria.php?id=<?php echo $categoria->getId(); ?>" class="btn-editar">
                            Editar
                        </a>

                        <a href="removeCategoria.php?id=<?php echo $categoria->getId(); ?>" class="btn-excluir">
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