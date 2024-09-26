<?php
    // Controle de sessão
    // Se existir uma sessão, redireciona o usuário para o sistema.php
    // Para que não exista a possibilidade dele fazer outro login/login duplicado
    session_start();
    if (isset($_SESSION['logado'])) {
        header('LOCATION: sistema.php');
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - EXEMPLO</title>
    <link href="assets/css/index.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .logo {
            height: 75px;
        }
    </style>
</head>
<body class="d-flex align-items-center py-4 bg-body-tertiary">
    <main class="form-signin w-100 m-auto">
        <form>
            <div class="text-center">
                <img class="mb-4 logo" src="assets/img/logo.png">
            </div>
            <h1 class="h3 mb-3 fw-normal">Faça o login</h1>
            <div class="form-floating">
                <input type="text" class="form-control" id="txt_usuario">
                <label for="txt_usuario">Usuário</label>
            </div>
            <div class="form-floating">
                <input type="password" class="form-control" id="txt_senha">
                <label for="txt_senha">Senha</label>
            </div>
            <div class="form-check text-start my-3">
                <input class="form-check-input" type="checkbox" value="true" id="check_lembrar">
                <label class="form-check-label" for="check_lembrar">Manter-me conectado</label>
            </div>
            <button class="btn btn-primary w-100 py-2" type="submit" onclick="Entrar()">Entrar</button>
            <p class="mt-5 mb-3 text-body-secondary text-center">&copy; 2024</p>
        </form>
    </main>
    <!--Jquery-->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <!--Bootstrap-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
        function Entrar(){
            var usuario = document.getElementById('txt_usuario').value;
            var senha = document.getElementById('txt_senha').value;
            $.ajax
            ({
                type: 'post',
                dataType: 'json',
                url: 'src/login.php',
                data: 
                {
                    'usuario': usuario,
                    'senha': senha
                },
                success: function(retorno) 
                {
                    alert(retorno);
                },
                error: function(erro) 
                {
                    alert('Ocorreu um erro na requisição: ' + erro);
                }
            });
        }
    </script>
</body>
</html>