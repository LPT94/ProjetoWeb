<?php
    include_once $_SERVER['DOCUMENT_ROOT'] . "/ProjetoWeb/DAL/categoria.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/ProjetoWeb/MODEL/categoria.php";

    use DAL\Categoria;

    $dalCategoria = new DAL\Categoria();

    $listaCategoria = $dalCategoria->select();

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Categorias</title>
</head>
<body>
    <div class="center">
        <h1>Lista de Categorias</h1>
        <?php if (!$listaCategoria) {
                echo "<tr><td colspan='2'>Lista vazia!</td></tr>";
        } else {
                foreach ($listaCategoria as $categoria) {
        ?>
            <tr>
                <td><?php echo $categoria->getId(); ?></td>
                <td><?php echo $categoria->getDescricao(); ?></td>
            </tr>
    <?php
                }   
            }
    ?>
</table>

    </div>    

</body>
</html>