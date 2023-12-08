<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $senha = $_POST["senha"];

    // Conectar ao banco de dados (ajuste as configurações conforme necessário)
    $conn = new mysqli("localhost", "root", "", "escola");

    // Verificar a conexão
    if ($conn->connect_error) {
        die("Conexão falhou: " . $conn->connect_error);
    }

    // Consultar o banco de dados para encontrar o usuário
    $sql = "SELECT * FROM usuarios WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();

        // Verificar a senha
        if (password_verify($senha, $row["senha"])) {
            // Senha correta, criar uma sessão de usuário
            $_SESSION["id"] = $row["id"];
            $_SESSION["nome"] = $row["nome"];
            $_SESSION["email"] = $row["email"];

            // Redirecionar para a página de dashboard (ou qualquer outra página desejada)
            header("Location: dashboard.php");
            exit();
        } else {
            $erro = "Senha incorreta";
        }
    } else {
        $erro = "Usuário não encontrado";
    }

    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Sistema de Professores</h1>
    </header>
    
    <div class="container">
        <h2>Login</h2>
        <?php if (isset($erro)) echo "<p class='erro'>$erro</p>"; ?>
        <form method="post" action="">
            Email: <input type="text" name="email" required><br>
            Senha: <input type="password" name="senha" required><br>
            <input type="submit" value="Login">
        </form>
        <br>
        <p>Não tem uma conta? <a href="cadastro.php">Cadastrar-se</a></p>
    </div>

    <footer>
        <p>&copy; 2023 Sistema de Professores</p>
    </footer>
</body>
</html>
