<?php

    include_once $_SERVER['DOCUMENT_ROOT'] . "/ProjetoWeb/DAL/venda.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/ProjetoWeb/MODEL/venda.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/ProjetoWeb/DAL/item_venda.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/ProjetoWeb/MODEL/item_venda.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/ProjetoWeb/DAL/produto.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/ProjetoWeb/MODEL/produto.php";

    $id = $_GET['id'];

    $dalProduto = new \DAL\Produto();
    $listaProduto = $dalProduto->select();

    $dalVenda = new \DAL\Venda();
    $dalItemVenda = new \DAL\ItemVenda();

    $venda = $dalVenda->selectById($id);

    $itensVenda = $dalItemVenda->selectVendas($id);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar venda</title>
    <link rel="stylesheet" href="/ProjetoWeb/assets/css/style.css">
</head>
<body>
    <div class="container">
        <h1>Editar Venda</h1>

        <form action="opRemoveVenda.php"
               method="POST"
               onsubmit="return confirmarFormulario()"
        >
            <div class="grupo-form"> 
                <label>Data da Venda</label> 
                <input type="date" 
                    name="data_venda" 
                    id="data_venda"
                    value="<?php echo $venda->getData_venda(); ?>" 
                    readonly >

                <input type="hidden"
                       name="id_venda"
                       value="<?= $venda->getId() ?>"
                       id="id_venda">
            </div> 

            <div class="button-venda">
                <button type="submit"
                        class="btn-salvar">
                        Excluir Venda
                </button>
                <a  href="listaVenda.php" class="btn-cancelar">
                    Cancelar
                </a>
            </div>

            <table id="tabelaItens">
                <thead>
                    <tr>
                        <th>Produto</th>
                        <th>Quantidade</th>
                        <th>Valor Unitário</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>

                <tbody id="corpoTabela">
                    <?php $total = 0;
                        foreach ($itensVenda as $item) {

                            $produto = null;
                            foreach ($listaProduto as $p) {
                                if ($p->getId() == $item->getId_produto()) {
                                    $produto = $p;
                                    break;
                                }
                            }

                            $subtotal = $item->getQtde() * $p->getPreco();
                            $total += $subtotal;
                        ?>
                        <tr>
                            <td><?= $produto->getNome() ?></td>
                            <td><?= $item->getQtde() ?></td>
                            <td>R$ <?= number_format($p->getPreco(), 2) ?></td>
                            <td>R$ <?= number_format($subtotal, 2) ?></td>
                        </tr>
                     <?php } ?>
                </tbody>

            </table>
        
            <h2 id="totalVenda">Total: R$<?php echo $venda->getValor(); ?></h2>
        
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