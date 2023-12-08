<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $senha = $_POST["senha"];

    // Conectar ao banco de dados (ajuste as configurações conforme necessário)
    $conn = new mysqli("localhost", "root", "", "escola");

    // Verificar a conexão
    if ($conn->connect_error) {
        die("Conexão falhou: " . $conn->connect_error);
    }

    // Verificar se o e-mail já está registrado
    $sql_verificar_email = "SELECT * FROM usuarios WHERE email = '$email'";
    $result_verificar_email = $conn->query($sql_verificar_email);

    if ($result_verificar_email->num_rows > 0) {
        $erro = "Este e-mail já está registrado. Por favor, escolha outro.";
    } else {
        // Hash da senha antes de armazenar no banco de dados
        $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

        // Inserir o novo usuário no banco de dados
        $sql_inserir_usuario = "INSERT INTO usuarios (nome, email, senha) VALUES ('$nome', '$email', '$senha_hash')";
        $result_inserir_usuario = $conn->query($sql_inserir_usuario);

        if ($result_inserir_usuario === TRUE) {
            // Registro bem-sucedido, redirecionar para a página de login
            header("Location: index.php");
            exit();
        } else {
            $erro = "Erro no registro: " . $conn->error;
        }
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastro</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Sistema de Professor</h1>
    </header>
    
    <div class="container">
        <h2>Cadastro de Usuário</h2>
        <form method="post" action="">
            Nome: <input type="text" name="nome" required><br>
            Email: <input type="text" name="email" required><br>
            Senha: <input type="password" name="senha" required><br>
            <input type="submit" value="Cadastrar">
        </form>
        <br>
        <p>Já tem uma conta? <a href="index.php">Faça login</a></p>
    </div>

    <footer>
        <p>&copy; 2023 Sistema de Professores</p>
    </footer>
</body>
</html>