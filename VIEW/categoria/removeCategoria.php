<?php

    include_once $_SERVER['DOCUMENT_ROOT'] . "/ProjetoWeb/DAL/categoria.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/ProjetoWeb/MODEL/categoria.php";

    //validação id
    $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
    if ($id === false || $id === null) {
        header("location: listaVenda.php");
        exit;
    }

    use DAL\Categoria;

    $dalCategoria = new Categoria();

    $categoria = $dalCategoria->selectById($id);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Remover Categoria</title>
    <link rel="stylesheet" href="/ProjetoWeb/assets/css/style.css">
</head>
<body>
    <div class=container>

        <h1>Remover Categoria</h1>
        
        <form action="opRemoveCategoria.php" method="POST" onsubmit="return confirmarFormulario()">
            
            <div class="grupo-form">
                
                <label>ID</label>

                    <input class="input-reduzido"
                        type="number"
                        name="id"
                        value="<?php echo $categoria->getId(); ?>"
                        readonly
                        >
            </div>

            <div class="grupo-form">

                <label>Descricao</label>
                    <input class="input-maior"
                            type="text"
                            value="<?php echo $categoria->getDescricao(); ?>"
                            readonly
                            >
            </div>

            <div class="botoes">
                <button type="submit"
                class="btn-salvar">
                Excluir
                </button>
                <a href="listaCategoria.php" class="btn-cancelar">
                Cancelar
                </a>

            </div>

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

