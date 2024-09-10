<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Cadastro de <strong>Clientes</strong></h1>
</div>

<form action="src/cadastrar-cliente.php" method="post">
    <div class="row g-3">
        <div class="col-sm-3">
            <label for="txt_id" class="form-label">#</label>
            <input type="text" class="form-control" name="txt_id" id="txt_id" value="NOVO" required readonly>
        </div>

        <div class="col-sm-5">
            <label for="txt_nome" class="form-label">Nome</label>
            <input type="text" class="form-control" name="txt_nome" id="txt_nome" maxlength="255">
        </div>

        <div class="col-sm-4">
            <label for="txt_cpf" class="form-label">CPF</label>
            <input type="text" class="form-control" name="txt_cpf" id="txt_cpf" maxlength="20" required>
        </div>

        <div class="col-sm-7">
            <label for="txt_cidade" class="form-label">Cidade</label>
            <input type="text" class="form-control aguardando" name="txt_cidade" id="txt_cidade" maxlength="255" required>
        </div>

        <div class="col-sm-5">
            <label for="list_uf" class="form-label">UF</label>
            <select class="form-select" name="list_uf" id="list_uf" required>
                <option value="">Escolha...</option>
                <option value="AC">AC</option>
                <option value="AL">AL</option>
                <option value="AP">AP</option>
                <option value="AM">AM</option>
                <option value="BA">BA</option>
                <option value="CE">CE</option>
                <option value="DF">DF</option>
                <option value="ES">ES</option>
                <option value="GO">GO</option>
                <option value="MA">MA</option>
                <option value="MT">MT</option>
                <option value="MS">MS</option>
                <option value="MG">MG</option>
                <option value="PA">PA</option>
                <option value="PB">PB</option>
                <option value="PR">PR</option>
                <option value="PE">PE</option>
                <option value="PI">PI</option>
                <option value="RJ">RJ</option>
                <option value="RN">RN</option>
                <option value="RS">RS</option>
                <option value="RO">RO</option>
                <option value="RR">RR</option>
                <option value="SC">SC</option>
                <option value="SP">SP</option>
                <option value="SE">SE</option>
                <option value="TO">TO</option>
            </select>
        </div>
        <div class="col-sm-6">
            <button class="w-100 btn btn-secondary btn-lg" type="reset">Cancelar</button>
        </div>
        <div class="col-sm-6">
            <button class="w-100 btn btn-primary btn-lg" type="submit">Salvar</button>
        </div>
    </div>
</form>

<hr class="my-4">

<div class="table-responsive">
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nome</th>
                <th scope="col">CPF</th>
                <th scope="col">Cidade</th>
                <th scope="col">UF</th>
                <th scope="col">Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php
                // Banco de dados para seleionar os clientes
                try {
                    include '../../src/class/BancoDeDados.php'; 
                    // Em caso de erro usar 'include_once'src/class/BancoDeDados.php';'
                    $banco = new BancoDeDados;
                    $sql = 'SELECT * FROM clientes';
                    $dados = $banco -> Consultar($sql,[],true); //Quando não tiver parametros, pode só definir o array vazio '[]'

                    // Verificando se a variável $dados possui valor
                    if ($dados) {
                        // Imprimindo os dados na tabela    
                        foreach ($dados as $linha) {
                            echo "<tr>
                                <td>{$linha['id_cliente']}</td>
                                <td>{$linha['nome']}</td>
                                <td>{$linha['CPF']}</td>
                                <td>{$linha['cidade']}</td>
                                <td>{$linha['uf']}</td>
                                <td>
                                    <a href='sistema.php?tela=clientes&idCliente={$linha['id_cliente']}'>Alterar</a>
                                    <a href='#' onclick='excluir({$linha['id_cliente']})'>Excluir</a>
                                </td>
                            </tr>";
                        }
                    } else {
                        echo "<tr>
                            <td colspan='6' class='text-center'>Nenhum cliente cadastrado...</td>
                        </tr>";
                    }
                } catch (PDOException $erro) {
                    $msg = $erro->getMessage();
                    echo "<script>
                        alert(\"$msg\");
                    </script>";
                }
            ?>
        </tbody>                                                                                                                            
    </table>
</div>