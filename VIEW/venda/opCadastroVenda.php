<?php

    include_once $_SERVER['DOCUMENT_ROOT'] . "/ProjetoWeb/DAL/venda.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/ProjetoWeb/MODEL/venda.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/ProjetoWeb/DAL/produto.php";

    //---------validações
    if($_SERVER['REQUEST_METHOD'] != 'POST'){
        header("location: cadastroVenda.php");
        exit;
    }
    //valida se há valores nos vetores
    if (!isset($_POST['id_produto'], $_POST['qtde'], $_POST['valor'])) {
        header("Location: cadastroVenda.php");
        exit;
    }

    $data_venda = $_POST['data_venda'];            //data da venda
    $produtos = $_POST['id_produto'];             //array com os ids dos produtos
    $quantidades = $_POST['qtde'];                //array com as respectivas quantidades
    $valores = $_POST['valor'];                   //valor de cada item na venda  
    $valorVenda = 0;

    //valida estoque
    $dalProduto = new \DAL\Produto();
    for ($i = 0; $i < count($produtos); $i++) {

        $produto = $dalProduto->selectById($produtos[$i]);

        if ($produto->getQtde_estoque() < $quantidades[$i]) {
            header("location: erroEstoque.php?id=<?php echo $produto->getId(); ?>");
            exit;
        }
    }


    for ($i = 0; $i < count($produtos); $i++) {
        $valorVenda += $quantidades[$i] * $valores[$i];
    }

    $modelVenda = new \MODEL\Venda();
    $modelVenda->setId(1);
    $modelVenda->setValor($valorVenda);
    $modelVenda->setData_venda($data_venda);

    $dalVenda = new \DAL\Venda();
    
    $resultado = $dalVenda->insert($modelVenda, $produtos, $quantidades, $valores);

    switch($resultado){
        case "sucesso":
            header("location: listaVenda.php");
            exit;
        default:
            header("location: erroGenerico.php");
            exit;
    }
    
?>