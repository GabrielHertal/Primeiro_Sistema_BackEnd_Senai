<?php
    // Validação
    $usuario = isset($_POST['usuario']) ? $_POST['usuario'] : '';
    $senha = isset($_POST['senha']) ? $_POST['senha'] : '';
    if (empty($usuario) || empty($senha)) 
    {
        echo "Por favor preencha todos os campos!";
        exit;
    }

    // Banco de Dados
    try
    {
        include './class/BancoDeDados.php';
        $banco = new BancoDeDados; // Não é necessário '()' pois não é passado nenhum parametro
        
        // Definir o SQL e os parâmetros
        $sql = "SELECT id_usuario, nome
                FROM usuarios 
                WHERE usuario = ? AND senha = ?";
        $parametros = [ $usuario, $senha ];
        
        //Consultar os dados 
        $dados_usuario = $banco -> Consultar($sql,$parametros,true); // Se quiser FETCH normal, só deixa FALSE no lugar do TRUE.

        // Login
        if ($dados_usuario) {
            // Sessão
            session_start();
            $_SESSION['logado'] = true;
            $_SESSION['id_usuario'] = $dados_usuario['id_usuario'];
            $_SESSION['nome_usuario'] = $dados_usuario['nome'];

            // Redirecionar
            header('LOCATION: ../sistema.php');
        } else {
            echo "Usuário ou senha incorretos! Verifique!";
        }
    }
    catch(PDOException $erro)
    {
        $msg = $erro->getMessage();
        echo 'Houve uma exceção no banco de dados: ' . $msg;
    }