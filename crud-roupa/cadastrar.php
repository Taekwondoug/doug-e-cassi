<?php
// Inclua a configuração do banco de dados (config.php) no início do arquivo

include_once("index.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cor = $_POST["cor"];
    $preco = $_POST["preco"];
    $tamanho = $_POST["tamanho"];
    $marca = $_POST["marca"];

    $sql = "INSERT INTO roupas (cor, preco, tamanho, marca) VALUES ('$cor', '$preco', '$tamanho', '$marca')";

    if ($conn->query($sql) === TRUE) {
        header("Location: index.php"); // Redireciona para a página principal após o cadastro
        exit();
    } else {
        echo "Erro ao cadastrar: " . $conn->error;
    }
}

$conn->close();
?>
