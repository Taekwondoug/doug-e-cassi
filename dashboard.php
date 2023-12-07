<?php
session_start();

// Verifica se o usuário está autenticado
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
</head>
<body>
    <h2>Bem-vindo ao Dashboard</h2>
    <p>Nome: <?php echo $_SESSION['nome']; ?></p>
    <p>Email: <?php echo $_SESSION['email']; ?></p>
    <p>Matrícula ultra hiper secreta: <?php echo $_SESSION['matricula']; ?></p>
    <br>
    <a href="logout.php">Logout</a>
</body>
</html>
