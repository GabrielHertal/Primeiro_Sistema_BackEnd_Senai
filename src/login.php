<?php
    // Validação
    $usuario = isset($_POST['txt_usuario']) ? $_POST['txt_usuario'] : '';
    $senha = isset($_POST['txt_senha']) ? $_POST['txt_senha'] : '';
    if (empty($usuario) || empty($senha)) {
        echo "<script>
            alert('Por favor preencha todos os campos!');
            window.location = '../index.php';
        </script>";
        exit;
    }

    // Banco de Dados
    // 1)  Conectar ao banco
    $banco = new PDO('mysql:host=localhost;dbname=db_exemplo;charset=utf8mb4', 'root', '');
    
    // 2) Definir o SQL e os parâmetros
    $sql = "SELECT id_usuario, nome
            FROM usuarios 
            WHERE usuario = ? AND senha = ?";
    $parametros = [ $usuario, $senha ];
    
    // 3) Troca de parâmetros e executar o SQL
    $stmt = $banco->prepare($sql);
    $stmt->execute($parametros);

    // 4) Pegar o resultado e atribuir em uma variável (array)
    $dados_usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    // Login
    if ($dados_usuario) {
        // Sessão
        session_start();
        $_SESSION['logado'] = true;
        $_SESSION['id_usuario'] = $dados_usuario['id_usuario'];
        $_SESSION['nome_usuario'] = $dados_usuario['nome'];

        // Cookies
        // ...

        // Redirecionar
        header('LOCATION: ../sistema.php');
    } else {
        echo "<script>
            alert('Usuário ou senha incorretos! Verifique.');
            window.location = '../index.php';
        </script>";
    }