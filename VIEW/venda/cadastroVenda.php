<?php

    include_once $_SERVER['DOCUMENT_ROOT'] . "/ProjetoWeb/VIEW/menu.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/ProjetoWeb/DAL/produto.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/ProjetoWeb/MODEL/produto.php";
    
    $dalProduto = new \DAL\Produto();

    $listaProduto = $dalProduto->select();

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de vendas</title>
    <link rel="stylesheet" href="/ProjetoWeb/assets/css/style.css">
</head>
<body>
    <div class="container">
        <h1>Cadastro de Vendas</h1>

        <form
        action="opCadastroVenda.php"
        method="POST"
        onsubmit="return validarFormulario()"
        >
            <div class="grupo-form"> 
                <label>Data da Venda</label> 
                <input type="date" 
                    name="data_venda" 
                    id="data_venda"
                    value="<?php echo date('Y-m-d'); ?>" 
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
                        Salvar Venda
                </button>
                <a  href="listaVenda.php" class="btn-cancelar">
                    Cancelar Venda
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

                </tbody>

            </table>
            <div id="hiddenItens"></div>
        
            <h2 id="totalVenda">Total: R$ 0,00</h2>
        </form>
    <tbody>

    </tbody>
    
    
    </div>

<script>

    let total = 0;
    let produtosInseridos = [];

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

