<?php
include 'conexao.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $idExcluir = $_GET['id'];

    // Excluir professor
    $sqlExcluir = "DELETE FROM professores WHERE id = $idExcluir";
    if ($conn->query($sqlExcluir) === TRUE) {
        header("Location: index.php");
        exit();
    } else {
        echo "Erro ao excluir professor: " . $conn->error;
    }
} else {
    echo "ID do professor não especificado.";
}
?>
