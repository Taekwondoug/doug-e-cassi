<?php
include 'conexao.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST["nome"];
    $idade = $_POST["idade"];
    $especialidade = $_POST["especialidade"];
    $graduacao = $_POST["graduacao"];

    // Inserir novo professor
    $sql = "INSERT INTO professores (nome, idade, especialidade, graduacao) VALUES ('$nome', $idade, '$especialidade', '$graduacao')";
    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
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
</head>
<body>
    <h2>Adicionar Novo Professor</h2>
    <form method="post" action="">
        Nome: <input type="text" name="nome" required><br>
        Idade: <input type="number" name="idade" required><br>
        Especialidade: <input type="text" name="especialidade" required><br>
        Graduação:
        <select name="graduacao">
            <option value="doutorado">Doutorado</option>
            <option value="mestrado">Mestrado</option>
            <option value="graduado">Graduado</option>
        </select><br>
        <input type="submit" value="Adicionar Professor">
    </form>
    <br>
    <a href="index.php">Voltar para a Lista de Professores</a>
</body>
</html>
