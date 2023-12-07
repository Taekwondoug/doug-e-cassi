<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $senha = $_POST["senha"];

    // Verifica as credenciais (isso é um exemplo simples, não seguro)
    if ($email === 'usuario@exemplo.com' && $senha === 'senhasecreta') {
        $_SESSION['nome'] = 'Nome do Usuário';
        $_SESSION['email'] = $email;
        $_SESSION['matricula'] = '12345'; // Matrícula ultra hiper secreta
        header("Location: dashboard.php");
        exit();
    } else {
        $erro = "Credenciais inválidas.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>
    <?php if (isset($erro)) echo "<p>$erro</p>"; ?>
    <form method="post" action="">
        Email: <input type="text" name="email" required><br>
        Senha: <input type="password" name="senha" required><br>
        <input type="submit" value="Login">
    </form>
</body>
</html>
