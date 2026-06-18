<?php
    session_start();
    if (!isset($_SESSION['login'])) {
        header("location: /ProjetoWeb/VIEW/index.php");
        exit;
    }

    include_once $_SERVER['DOCUMENT_ROOT'] . "/ProjetoWeb/DAL/venda.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/ProjetoWeb/MODEL/venda.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/ProjetoWeb/DAL/produto.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/ProjetoWeb/DAL/item_venda.php";

    //---------validações
    if ($_SERVER['REQUEST_METHOD'] != 'POST') {
        header("location: listaVenda.php");
        exit;
    }
    //valida se há valores nos vetores
    if (!isset($_POST['id_produto'], $_POST['qtde'], $_POST['valor'])) {
        header("Location: listaVenda.php");
        exit;
    }
    //validação id
    $id = filter_input(INPUT_POST, 'id_venda', FILTER_VALIDATE_INT);
    if ($id === false || $id == null) {
        header("location: erroGenerico.html");
        exit;
    }


    $data_venda = $_POST['data_venda'];            //data da venda
    $produtos = $_POST['id_produto'];             //array com os ids dos produtos
    $quantidades = $_POST['qtde'];                //array com as respectivas quantidades
    $valores = $_POST['valor'];                   //valor de cada item na venda  
    $valorVenda = 0;

    //valida se os vetores são do mesmo tamanho
    if (count($produtos) != count($quantidades) || count($produtos) != count($valores)) {
        header("Location: listaVenda.php");
        exit;
    }

    //valida estoque
    $dalProduto = new \DAL\Produto();
    $dalItemVenda = new \DAL\ItemVenda();
    $itensVenda = $dalItemVenda->selectVendas($id);

    for ($i = 0; $i < count($produtos); $i++) {
        $produto = $dalProduto->selectById((int)$produtos[$i]);
        $estaNaVenda = false;

        foreach ($itensVenda as $item) {
            if ($produto->getId() == $item->getId_produto()) {
                $estaNaVenda = true;
                $copiaItem = $item;
                break;
            }
        }
        if ($estaNaVenda) {
            if ($quantidades[$i] > $copiaItem->getQtde()) {
                $diferenca = $quantidades[$i] - $copiaItem->getQtde();
                if ($diferenca > $produto->getQtde_estoque()) {
                    header("location: erroEstoque.php?id=" . $produto->getId());
                    exit;
                }
            }
        } elseif ($produto->getQtde_estoque() < $quantidades[$i]) {
            header("location: erroEstoque.php?id=" . $produto->getId());
            exit;
        }
    }

    for ($i = 0; $i < count($produtos); $i++) {
        $valorVenda += $quantidades[$i] * $valores[$i];
    }

    $modelVenda = new \MODEL\Venda();
    $modelVenda->setId($id);
    $modelVenda->setValor($valorVenda);
    $modelVenda->setData_venda($data_venda);

    $dalVenda = new \DAL\Venda();
    $resultado = $dalVenda->editInsert($modelVenda, $produtos, $quantidades, $valores);

    switch ($resultado) {
        case "sucesso":
            header("location: listaVenda.php");
            exit;
        default:
            header("location: erroGenerico.html");
            exit;
    }
?>