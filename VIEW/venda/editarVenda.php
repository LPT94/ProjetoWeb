<?php

    include_once $_SERVER['DOCUMENT_ROOT'] . "/ProjetoWeb/VIEW/menu.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/ProjetoWeb/DAL/venda.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/ProjetoWeb/MODEL/venda.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/ProjetoWeb/DAL/item_venda.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/ProjetoWeb/MODEL/item_venda.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/ProjetoWeb/DAL/produto.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/ProjetoWeb/MODEL/produto.php";

    //validação id
    $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
    if ($id === false || $id === null) {
        header("location: listaVenda.php");
        exit;
    }

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

        <form action="opEditarVenda.php"
               method="POST"
        >
            <div class="grupo-form"> 
                <label>Data da Venda</label> 
                <input type="date" 
                    name="data_venda" 
                    id="data_venda"
                    value="<?php echo $venda->getData_venda(); ?>" 
                    required > 
            </div> 
            <div class="grupo-form"> 
                <label>Produto</label> 
                <select id="produto"> 
                    <option value=""> Selecione um produto </option> 
                        <?php foreach($listaProduto as $produto){ 
                            if($produto->getQtde_estoque() > 0){?> 
                        <option value="<?php echo $produto->getId(); ?>" 
                                data-preco="<?php echo $produto->getPreco(); ?>" 
                                data-estoque="<?php echo $produto->getQtde_estoque(); ?>"> 
                            <?php echo $produto->getNome(); ?> </option> 
                            <?php }
                            }?>
                        
                </select> 
            </div> 
            <div class="grupo-form"> 
                <label>Quantidade</label> 
                <input type="number" 
                    id="qtde"
                    min="1" 
                    value="1" > 
            </div>

            <div class="button-venda">

                <button type="button" 
                        class="button-item" 
                        onclick="adicionarItem()" > 
                        Adicionar Item 
                </button>

                <button type="submit"
                        class="btn-salvar">
                        Editar Venda
                </button>
                <a  href="listaVenda.php" class="btn-cancelar">
                    Voltar
                </a>
            </div>

            <table id="tabelaItens">
                <thead>
                    <tr>
                        <th>Produto</th>
                        <th>Quantidade</th>
                        <th>Valor Unitário</th>
                        <th>Subtotal</th>
                        <th>Ação</th>
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

                            $subtotal = $item->getQtde() * $produto->getPreco();
                            $total += $subtotal;
                        ?>
                        <tr>
                            <td><?= $produto->getNome() ?></td>
                            <td><?= $item->getQtde() ?></td>
                            <td>R$ <?= number_format($produto->getPreco(), 2) ?></td>
                            <td>R$ <?= number_format($subtotal, 2) ?></td>
                            <td>
                                <button type="button"
                                        class="btn-cancelar"
                                        onclick="removerItem(this, '<?= $item->getId_produto() ?>', <?= $subtotal ?>)">
                                    Remover
                                </button>
                            </td>
                        </tr>
                     <?php } ?>
                </tbody>

            </table>
            <div id="hiddenItens">
                <?php foreach($itensVenda as $item){
                    $produto = null;

                    foreach($listaProduto as $p){
                        if($p->getId() == $item->getId_produto()){
                            $produto = $p;
                            break;
                        }
                    }
                ?>
                    <input
                        type="hidden"
                        name="id_venda"
                        value="<?= $venda->getId() ?>"
                        id="id_venda"
                    >

                    <input
                        type="hidden"
                        name="id_produto[]"
                        value="<?= $item->getId_produto() ?>"
                        id="produto_<?= $item->getId_produto() ?>"
                    >

                    <input
                        type="hidden"
                        name="qtde[]"
                        value="<?= $item->getQtde() ?>"
                        id="qtde_<?= $item->getId_produto() ?>"
                    >

                    <input
                        type="hidden"
                        name="valor[]"
                        value="<?= $produto->getPreco() ?>"
                        id="valor_<?= $item->getId_produto() ?>"
                    >

                <?php } ?>
            </div>
        
            <h2 id="totalVenda">Total: R$ 0,00</h2>
        
    </form>
    </div>

<script>

    let total = <?= $total ?>;
    
    document.getElementById("totalVenda").textContent = "Total: R$ " + total.toFixed(2);
    let produtosInseridos = [<?php foreach ($itensVenda as $item) {
                                        echo "'" . $item->getId_produto() . "',";
                                    } 
                            ?>];

    function adicionarItem(){

        let select = document.getElementById("produto");
        let produtoId = select.value;
        
        if(produtoId === ""){
            alert("Selecione um produto.");
            return;
        }
        if(produtosInseridos.includes(produtoId)){
            alert("Este produto já foi adicionado.");
            return;
        }
        
        let produtoNome = select.options[select.selectedIndex].text;
        let preco = parseFloat(select.options[select.selectedIndex].dataset.preco);
        let estoque = parseFloat(select.options[select.selectedIndex].dataset.estoque);
        let qtde = parseFloat(document.getElementById("qtde").value);

        if(qtde > estoque){
            alert( "Quantidade maior que o estoque disponível.\n" + "Estoque atual: " + estoque);
            return;
        }

        let subtotal = preco * qtde;
        let tabela = document.getElementById("corpoTabela");

        tabela.innerHTML += `
            <tr>
                <td>${produtoNome}</td>
                <td>${qtde}</td>
                <td>R$ ${preco.toFixed(2)}</td>
                <td>R$ ${subtotal.toFixed(2)}</td>
                <td>
                    <button type="button"
                            onclick="removerItem(this, '${produtoId}', ${subtotal})"
                            class="btn-cancelar">
                        Remover
                    </button>
                </td>
            </tr>
        `;

        produtosInseridos.push(produtoId);

        let hiddenContainer = document.getElementById("hiddenItens");

        hiddenContainer.innerHTML += `
            <input
                type="hidden"
                name="id_produto[]"
                value="${produtoId}"
                id="produto_${produtoId}"
            >

            <input
                type="hidden"
                name="qtde[]"
                value="${qtde}"
                id="qtde_${produtoId}"
            >

            <input
                type="hidden"
                name="valor[]"
                value="${preco}"
                id="valor_${produtoId}"
            >
        `;

        total += subtotal;
        document.getElementById("totalVenda").textContent = "Total: R$ " + total.toFixed(2);
    }

    function removerItem(botao, produtoId, subtotal){

        let linha = botao.parentNode.parentNode;
        linha.remove();

        total -= subtotal;

        document.getElementById("totalVenda").textContent = "Total: R$ " + total.toFixed(2);

        let indice = produtosInseridos.indexOf(produtoId);
        if(indice !== -1){
            produtosInseridos.splice(indice, 1);
        }

        let hProduto = document.getElementById("produto_" + produtoId);
        if(hProduto){
            hProduto.remove();
        }

        let hQtde = document.getElementById("qtde_" + produtoId);
        if(hQtde){
            hQtde.remove();
        }

        let hValor = document.getElementById("valor_" + produtoId);
        if(hValor){
            hValor.remove();
        }

    }

</script>

</body>
</html>
