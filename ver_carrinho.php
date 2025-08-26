<?php
function limparCarrinho() {
    file_put_contents('carrinho.txt', '');
}

function atualizarQuantidade($produto_nome, $nova_quantidade) {
    $itens_carrinho = [];
    
    if (file_exists('carrinho.txt')) {
        $arquivo = fopen('carrinho.txt', 'r');
        
        while (($linha = fgets($arquivo)) !== false) {
            $dados_produto = explode("|", trim($linha));
            if ($dados_produto[0] == $produto_nome) {
                $dados_produto[2] = $nova_quantidade;
            }
            $itens_carrinho[] = $dados_produto;
        }
        fclose($arquivo);
        
        $arquivo = fopen('carrinho.txt', 'w');
        foreach ($itens_carrinho as $item) {
            $linha = implode("|", $item) . "\n";
            fwrite($arquivo, $linha);
        }
        fclose($arquivo);
    }
}

function removerProduto($produto_nome) {
    $itens_carrinho = [];

    if (file_exists('carrinho.txt')) {
        $arquivo = fopen('carrinho.txt', 'r');

        while (($linha = fgets($arquivo)) !== false) {
            $dados_produto = explode("|", trim($linha));

            if ($dados_produto[0] != $produto_nome) {
                $itens_carrinho[] = $dados_produto;
            }
        }
        fclose($arquivo);

        $arquivo = fopen('carrinho.txt', 'w');
        foreach ($itens_carrinho as $item) {
            $linha = implode("|", $item) . "\n";
            fwrite($arquivo, $linha);
        }
        fclose($arquivo);
    }
}

if (isset($_POST['limpar_carrinho'])) {
    limparCarrinho();
}

if (isset($_POST['atualizar_quantidade'])) {
    $produto_nome = $_POST['produto_nome'];
    $nova_quantidade = $_POST['quantidade'];
    atualizarQuantidade($produto_nome, $nova_quantidade);
}

if (isset($_POST['remover_produto'])) {
    $produto_nome = $_POST['produto_nome'];
    removerProduto($produto_nome);
}

$itens_carrinho = [];
if (file_exists('carrinho.txt')) {
    $arquivo = fopen('carrinho.txt', 'r');
    while (($linha = fgets($arquivo)) !== false) {
        $dados_produto = explode("|", trim($linha));
        $itens_carrinho[] = [
            'nome' => $dados_produto[0],
            'preco' => $dados_produto[1],
            'quantidade' => $dados_produto[2]
        ];
    }
    fclose($arquivo);
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seu Carrinho</title>
    <link rel="stylesheet" href="carrinho.css">
    <link rel="shortcut icon" type="imagex/png" href="img/ico.png">
</head>
<body>

<div class="container">
    <h1 class="titulo">Seu Carrinho</h1>
    <hr>
    <?php if (!empty($itens_carrinho)) { ?>
        <form method="POST" action="ver_carrinho.php">
            <table>
                <thead>
                    <tr>
                        <th class="produto-nome">Produto</th>
                        <th class="produto-preco">Preço (R$)</th>
                        <th class="produto-quantidade">Quantidade</th>
                        <th class="produto-total">Total (R$)</th>
                        <th class="produto-remover"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $total_carrinho = 0;
                    foreach ($itens_carrinho as $item) {
                        $total_produto = $item['preco'] * $item['quantidade'];
                        $total_carrinho += $total_produto;
                        ?>
                        <tr>
                            <td class="produto-nome"><?php echo $item['nome']; ?></td>
                            <td class="produto-preco"><?php echo number_format($item['preco'], 2, ',', '.'); ?></td>
                            <td class="produto-quantidade">
                                <form method="POST" action="ver_carrinho.php" style="display:inline;">
                                    <input type="hidden" name="produto_nome" value="<?php echo $item['nome']; ?>">
                                    <input type="number" name="quantidade" value="<?php echo $item['quantidade']; ?>" min="1" onchange="this.form.submit()">
                                    <input type="hidden" name="atualizar_quantidade" value="1">
                                </form>
                            </td>
                            <td class="produto-total"><?php echo number_format($total_produto, 2, ',', '.'); ?></td>
                            <!-- Botão "Remover" -->
                            <td class="produto-remover">
                                <form method="POST" action="ver_carrinho.php" style="display:inline;">
                                    <input type="hidden" name="produto_nome" value="<?php echo $item['nome']; ?>">
                                    <button type="submit" name="remover_produto" value="1" class="botao-remover"><img src="img/trash.png" width="30"></button>
                                </form>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <div class="total-carrinho">
                Total do Carrinho: R$<?php echo number_format($total_carrinho, 2, ',', '.'); ?>
            </div>

            <!-- Botão para limpar o carrinho -->
            <div class="botao-limpar-container">
            <form method="POST" action="ver_carrinho.php">
                <input type="hidden" name="limpar_carrinho" value="1">
                <button class="botao-limpar" type="submit">Limpar Carrinho</button>
            </form>
            </div>
        </form>
        <div class="botao-comprar-container">
            <form method="POST" action="compra.php">
                <button class="botao-comprar" type="submit">COMPRAR</button>
            </form>
        </div>
    <?php } else { ?>
        <p><h1>O carrinho está vazio.</p>
    <?php } ?>
    <p>
    <div class="botao-voltar-container">
    <form method="POST" action="cardapio.slogin.php">
    <button class="botao-voltar" type="submit">Voltar para o Cardápio</button>
    </form>
    </div>
            <!-- Botão "COMPRAR" alinhado à direita -->
</div>
</body>
</html>
