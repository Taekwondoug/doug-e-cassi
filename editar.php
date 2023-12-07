<?php
include 'conexao.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $id = $_GET['id'];

    // Selecionar professor pelo ID
    $sql = "SELECT * FROM professores WHERE id = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $nome = $row["nome"];
        $idade = $row["idade"];
        $especialidade = $row["especialidade"];
        $graduacao = $row["graduacao"];
    } else {
        echo "Professor não encontrado.";
        exit();
    }
} elseif ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $nome = $_POST["nome"];
    $idade = $_POST["idade"];
    $especialidade = $_POST["especialidade"];
    $graduacao = $_POST["graduacao"];

    // Atualizar professor
    $sql = "UPDATE professores SET nome='$nome', idade=$idade, especialidade='$especialidade', graduacao='$graduacao' WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
        exit();
    } else {
        echo "Erro ao editar professor: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Professor</title>
</head>
<body>
    <h2>Editar Professor</h2>
    <form method="post" action="">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        Nome: <input type="text" name="nome" value="<?php echo $nome; ?>" required><br>
        Idade: <input type="number" name="idade" value="<?php echo $idade; ?>" required><br>
        Especialidade: <input type="text" name="especialidade" value="<?php echo $especialidade; ?>" required><br>
        Graduação:
        <select name="graduacao">
            <option value="doutorado" <?php echo ($graduacao == 'doutorado') ? 'selected' : ''; ?>>Doutorado</option>
            <option value="mestrado" <?php echo ($graduacao == 'mestrado') ? 'selected' : ''; ?>>Mestrado</option>
            <option value="graduado" <?php echo ($graduacao == 'graduado') ? 'selected' : ''; ?>>Graduado</option>
        </select><br>
        <input type="submit" value="Salvar Alterações">
    </form>
    <br>
    <a href="index.php">Voltar para a Lista de Professores</a>
</body>
</html>
