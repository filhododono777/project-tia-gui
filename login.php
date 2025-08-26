<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="login.css">
    <link rel="shortcut icon" type="imagex/png" href="img/ico.png">
</head>
<body>
    <div class="page"> 
        <form action="#" method="POST" class="formLogin">
            <h1>Login</h1>
            <p>Digite os seus dados de acesso no campo abaixo.</p>
            <label for="email">E-mail</label>
            <input type="email" placeholder="Digite seu e-mail" autofocus="true" name="email" required maxlength="80">
            <label for="password">Senha</label>
            <input type="password" placeholder="Digite sua senha" name="senha" required maxlength="20">
            <a href="cadastro.php">Não tenho conta</a>
            <input type="submit" name="botao" value="Acessar" class="btn">

</body>
</html>

<?php
    $botao = filter_input(INPUT_POST, 'botao');
    $email = filter_input(INPUT_POST, 'email');
    $senha = filter_input(INPUT_POST, 'senha');
    $login = "cadastros.txt";
    $arquivo = strtolower(file_get_contents('cadastros.txt'));
    
    if ($botao == "Acessar")
        {
        $emailbuscar = strtolower($email);
        $senhabuscar = strtolower($senha);

            if(isset($_POST))
            {
                if ((strpos($arquivo, $emailbuscar) !== FALSE) and (strpos($arquivo, $senhabuscar) !== FALSE))
                {
                    echo "<meta HTTP-EQUIV='refresh' CONTENT='.0;URL=indexx.slogin.php'>";
                } 
                else 
                {
                    echo '<h2>O Email ou a Senha está incorreto</h2>';
                }
            }
        }
        echo "</form></div>"
?>