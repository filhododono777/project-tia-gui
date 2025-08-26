<?php
// Função para limpar o carrinho
function limparCarrinho() {
    file_put_contents('carrinho.txt', ''); // Escreve um arquivo vazio, limpando-o
}

// Limpar o carrinho após a compra
limparCarrinho();

// Exibir a página de sucesso e redirecionar para o indexx.slogin.php após alguns segundos
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Compra Realizada</title>
    <link rel="shortcut icon" type="imagex/png" href="img/ico.png">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            font-family: Arial, sans-serif;
        }
        .mensagem {
            text-align: center;
        }

        h1 {
    font-size: 6rem;
    color: #44190e;
}
    </style>
</head>
<body>
    <div class="mensagem">
        <h1>Obrigado por comprar!</h1>
        <p>Redirecionando para a página inicial...</p>
    </div>
</body>
</html>

<?php
	echo "<meta HTTP-EQUIV='refresh' CONTENT='1;URL=indexx.slogin.php'>";
?>