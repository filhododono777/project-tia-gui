<?php
// Captura os dados do formulário
if (isset($_POST['produto_nome']) && isset($_POST['produto_preco']) && isset($_POST['quantidade'])) {
    $produto_nome = $_POST['produto_nome'];
    $produto_preco = $_POST['produto_preco'];
    $quantidade = $_POST['quantidade'];

    // Abrir o arquivo "carrinho.txt" para adicionar os dados (modo "a" para append)
    $arquivo = fopen('carrinho.txt', 'a');

    // Escreve os dados do produto no arquivo. Formato: produto_nome|preco|quantidade
    $linha = $produto_nome . "|" . $produto_preco . "|" . $quantidade . "\n";
    fwrite($arquivo, $linha);

    // Fecha o arquivo
    fclose($arquivo);

    // Redireciona o usuário de volta para a página de produtos
    header('Location: pratos.php');
    exit();
}
?>
