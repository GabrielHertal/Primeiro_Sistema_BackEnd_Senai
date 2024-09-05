<?php
    // Controle de sessão
    // Se NÃO existir uma sessão, redireciona o usuário para o index.php
    // Não permitindo que seja exibido o conteúdo da página, 
    // sem que exista uma sessão (login autenticado)
    session_start();
    if (!isset($_SESSION['logado'])) {
        header('LOCATION: index.php');
        exit;
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema - EXEMPLO</title>
    <link href="assets/css/sistema.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <header class="navbar sticky-top bg-dark flex-md-nowrap p-0 shadow" data-bs-theme="dark">
        <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 fs-6 text-white" href="#">TEItech</a>
        <ul class="navbar-nav flex-row d-md-none">
            <li class="nav-item text-nowrap">
                <button class="nav-link px-3 text-white" type="button" data-bs-toggle="offcanvas"
                    data-bs-target="#sidebarMenu">
                    <svg class="bi">
                        <use xlink:href="#list">
                    </svg>
                </button>
            </li>
        </ul>
    </header>
    <div class="container-fluid">
        <div class="row">
            <div class="sidebar border border-right col-md-3 col-lg-2 p-0 bg-body-tertiary">
                <div class="offcanvas-md offcanvas-end bg-body-tertiary" tabindex="-1" id="sidebarMenu">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title" id="">TEItech</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" data-bs-target="#sidebarMenu"></button>
                    </div>
                    <div class="offcanvas-body d-md-flex flex-column p-0 pt-lg-3 overflow-y-auto">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link d-flex align-items-center gap-2 active" href="sistema.php?tela=clientes">Clientes</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link d-flex align-items-center gap-2" href="#">Produtos</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link d-flex align-items-center gap-2" href="#">Vendas</a>
                            </li>
                        </ul>
                        <hr class="my-3">
                        <ul class="nav flex-column mb-auto">
                            <li class="nav-item">
                                <a class="nav-link d-flex align-items-center gap-2" href="#" onclick="sair()">Sair</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <!-- Script para importar as telas do sistema -->
                <?php
                    $tela = isset($_GET['tela']) ? $_GET['tela'] : '';
                    switch ($tela) {
                        case 'clientes':
                            include 'telas/clientes.php';
                            break;
                        case 'produtos':
                            include 'telas/produtos.php';
                            break;
                        case 'vendas':
                            include 'telas/vendas.php';
                            break;
                        default:
                            echo '<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                                <h1 class="h2">Bem-vindo <strong>' . $_SESSION['nome_usuario'] . '</strong>!</h1>
                            </div>';
                            break;
                    }
                ?>
            </main>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
        function sair() {
            var confirmou = confirm('Deseja realmente sair do sistema?');
            if (confirmou) {
                window.location = 'src/logout.php';
            }
        }

        // A função 'excluir' do Javascript recebe um valor via parâmetro
        // Esse valor é o id do cliente, que se deseja excluir
        // Esse valor foi impresso via php, na chamada da função excluir() na tabela de clientes
        function excluir(idCliente) {
            var confirmou = confirm('Tem certeza que quer excluir este cliente?');
            if (confirmou) {
                window.location = 'src/excluir-cliente.php?idCliente=' + idCliente;
            }
        }
    </script>
    <?php
        // Carregando os dados do cliente, se for requisitado
        if (isset($_GET['idCliente'])) {
            $id_cliente = $_GET['idCliente'];
            try {
                include 'src/class/BancoDeDados.php';  
                $banco = new BancoDeDados;
                $sql = 'SELECT * FROM clientes WHERE id_cliente = ?';
                $parametros = [ $id_cliente ];
                $dados = $banco -> Consultar($sql,$parametros);
                // Se houver dados dentro da variável $dados, 
                // imprime um script javascript para passar esses valores para o formulário
                if ($dados) {
                    echo "<script>
                        document.getElementById('txt_id').value = '{$dados['id_cliente']}';
                        document.getElementById('txt_nome').value = '{$dados['nome']}';
                        document.getElementById('txt_cpf').value = '{$dados['CPF']}';
                        document.getElementById('txt_cidade').value = '{$dados['cidade']}';
                        document.getElementById('list_uf').value = '{$dados['uf']}';
                    </script>";
                }
            } catch(PDOException $erro) {
                $msg = $erro->getMessage();
                echo "<script>
                    alert(\"$msg\");
                </script>";
            }
        }
    ?>
</body>
</html>