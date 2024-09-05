<?php
    // Validação
    $id_cliente = isset($_GET['idCliente']) ? $_GET['idCliente'] : '';
    if (empty($id_cliente)) {
        header('LOCATION: ../sistema.php?tela=clientes');
        // Não é necessário usar 'exit' após o header()
    }

    // Continuando

    // Banco de dados
    try {
        include 'class/BancoDeDados.php';
        $banco = new BancoDeDados;
        $sql = 'DELETE FROM clientes WHERE id_cliente = ?';
        $parametros = [ $id_cliente ];
        $banco -> ExecutarComando($sql,$parametros);
        echo "<script>
            alert('Cliente removido com sucesso!');
            window.location = '../sistema.php?tela=clientes';
        </script>";
    } catch(PDOException $erro) {
        $msg = $erro->getMessage();
        echo "<script>
            alert(\"$msg\");
            window.location = '../sistema.php?tela=clientes';
        </script>";
    }
