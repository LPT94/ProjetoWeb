<?php

    include_once $_SERVER['DOCUMENT_ROOT'] . "/ProjetoWeb/VIEW/menu.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/ProjetoWeb/DAL/venda.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/ProjetoWeb/MODEL/venda.php";

    use DAL\Venda;

    $dalVenda = new Venda();

    $listaVenda = $dalVenda->select();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Vendas</title>

    <link rel="stylesheet" href="/ProjetoWeb/assets/css/style.css">
</head>
<body>

<div class="container">

    <div class="cabecalho">

        <h1>Vendas</h1>

        <a href="cadastroVenda.php" class="btn">
            Nova Venda
        </a>

    </div>

    <table>

        <thead>
            <tr>
                <th>ID</th>
                <th>Data</th>
                <th>Total</th>
                <th>Ações</th>
            </tr>
        </thead>

        <tbody>

        <?php

        if(count($listaVenda) == 0){

            echo "<tr>
                    <td colspan='3'>Nenhuma Venda cadastrada.</td>
                </tr>";

        }else{

            foreach($listaVenda as $venda){
        ?>

                <tr>
                    <td><?php echo $venda->getId(); ?></td>
                    <td><?php echo $venda->getData_venda(); ?></td>
                    <td><?php echo $venda->getValor(); ?></td>
                    <td>
                        <a href="editarVenda.php?id=<?php echo $venda->getId(); ?>" class="btn-editar">
                            Editar
                        </a>

                        <a href="removeVenda.php?id=<?php echo $venda->getId(); ?>" class="btn-excluir">
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