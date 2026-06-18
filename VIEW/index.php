<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login</title>

    <link rel="stylesheet"
          href="/ProjetoWeb/assets/css/style.css">
</head>
<body>

<div class="container" style="text-align:center">

    <h1>Login</h1>
    <br>
    <form action="opLogin.php"
          method="POST">

        <div class="grupo-form">

            <label>Usuário</label>

            <input
                type="text"
                name="login"
                required
            >

        </div>

        <div class="grupo-form">

            <label>Senha</label>

            <input
                type="password"
                name="senha"
                required
            >

        </div>

        <button
            type="submit"
            class="btn-salvar"
        >
            Entrar
        </button>

    </form>

</div>

</body>
</html>