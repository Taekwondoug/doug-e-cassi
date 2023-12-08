<?php
include 'conexao.php';


session_start();

// Verificar se o usuário está autenticado
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST["nome"];
    $idade = $_POST["idade"];
    $especialidade = $_POST["especialidade"];
    $graduacao = $_POST["graduacao"];

    // Inserir novo professor
    $sql = "INSERT INTO professores (nome, idade, especialidade, graduacao) VALUES ('$nome', $idade, '$especialidade', '$graduacao')";
    if ($conn->query($sql) === TRUE) {
        header("Location: capa.php");
        exit();
    } else {
        echo "Erro ao adicionar professor: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Adicionar Professor</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Sistema de Professores</h1>
    </header>
    
    <div class="container">
        <h2>Adicionar Professor</h2>
        <form method="post" action="">
            <label for="nome">Nome:</label>
            <input type="text" name="nome" required><br>
            
            <label for="idade">Idade:</label>
            <input type="number" name="idade" required><br>
            
            <label for="especialidade">Especialidade:</label>
            <input type="text" name="especialidade" required><br>
            
            <label for="graduacao">Graduação:</label>
            <select name="graduacao">
                <option value="doutorado">Doutorado</option>
                <option value="mestrado">Mestrado</option>
                <option value="graduado">Graduado</option>
            </select><br>
            
            <input type="submit" value="Adicionar Professor">
        </form>
        <br>
        <a href="index.php" class="btn">Voltar para a Lista de Professores</a>
    </div>

    <footer>
        <p>&copy; 2023 Sistema de Professores</p>
    </footer>
</body>
</html>