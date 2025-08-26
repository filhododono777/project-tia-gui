<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <link rel="stylesheet" href="login.css">
    <link rel="shortcut icon" type="imagex/png" href="img/ico.png">
</head>
<body>
    <div class="page"> 
        <form action="#" method="POST" class="formLogin">
            <h1>Cadastrar-se</h1>
            <p>Digite os seus dados de acesso no campo abaixo.</p>
            <label for="email">E-mail</label>
            <input type="email" placeholder="Digite seu e-mail" autofocus="true" name="email" required maxlength="80">
            <label for="password">Senha</label>
            <input type="password" placeholder="Digite sua senha" name="senha" required maxlength="20">
            <label for="password">Confirmar senha</label>
            <input type="password" placeholder="Digite sua senha novamente" name="senha2" required maxlength="20">
            <a href="login.php">Já tenho login</a>
            <input type="submit" name="botao" value="Cadastrar" class="btn">
</body>
</html>

<?php

$botao = filter_input(INPUT_POST, 'botao');
$email = filter_input(INPUT_POST, 'email');
$senha = filter_input(INPUT_POST, 'senha');
$senha2 = filter_input(INPUT_POST, 'senha2');
$cadastro = "cadastros.txt";
$cadastroab = fopen($cadastro, 'a');

    if ($botao == "Cadastrar")
    {
        if ($senha == $senha2){
                if ($cadastroab){
                    fwrite($cadastroab, "" . PHP_EOL);
                    fwrite($cadastroab, "$email" . PHP_EOL);
                    fwrite($cadastroab, "$senha" . PHP_EOL);
                    fclose($cadastroab);

                    echo "<meta HTTP-EQUIV='refresh' CONTENT='.5;URL=login.php'>";
                }
            }
            else {
                echo "<h2><center>Você deve repetir a senha!</center></h2></form></div>";
            }
    }


?>