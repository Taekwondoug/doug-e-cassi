<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $senha = $_POST["senha"];
    $matricula = $_POST["matricula"];

    // Aqui você deve validar os dados (ex: verificar se o e-mail já existe, validar senha, etc.)
    
    // Simplesmente armazenando os dados na sessão (isso é um exemplo, não seguro)
    $_SESSION['nome'] = $nome;
    $_SESSION['email'] = $email;
    $_SESSION['matricula'] = $matricula;
    header("Location: dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastro</title>
</head>
<body>
    <h2>Cadastro</h2>
    <form method="post" action="">
        Nome: <input type="text" name="nome" required><br>
        Email: <input type="text" name="email" required><br>
        Senha: <input type="password" name="senha" required><br>
        Matrícula ultra hiper secreta: <input type="text" name="matricula" required><br>
        <input type="submit" value="Cadastrar">
    </form>
</body>
