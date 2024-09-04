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
        $banco = new PDO('mysql:host=localhost;dbname=db_exemplo;charset=utf8mb4', 'root', '');
        $sql = 'DELETE FROM clientes WHERE id_cliente = ?';
        $parametros = [ $id_cliente ];
        $stmt = $banco->prepare($sql);
        $stmt->execute($parametros);
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
