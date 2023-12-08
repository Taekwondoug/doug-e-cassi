<?php
// Inclua a configuração do banco de dados (config.php) no início do arquivo
include_once("index.php");
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {
    $id = $_GET["id"];

    $sql = "SELECT * FROM roupas WHERE id = $id";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
    } else {
        echo "Roupa não encontrada.";
        exit();
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $cor = $_POST["cor"];
    $preco = $_POST["preco"];
    $tamanho = $_POST["tamanho"];
    $marca = $_POST["marca"];

    $sql = "UPDATE roupas SET cor='$cor', preco='$preco', tamanho='$tamanho', marca='$marca' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        header("Location: index.php"); // Redireciona para a página principal após a edição
        exit();
    } else {
        echo "Erro ao editar: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Roupa</title>
    <style>
        /* Adicione estilos de edição, se necessário */
    </style>
</head>
<body>
    <div class="container">
        <h2>Editar Roupa</h2>
        <form method="post" action="">
            <input type="hidden" name="id" value="<?php echo $row["id"]; ?>">

            <label for="cor">Cor:</label>
            <input type="text" name="cor" value="<?php echo $row["cor"]; ?>" required>

            <label for="preco">Preço:</label>
            <input type="text" name="preco" value="<?php echo $row["preco"]; ?>" required>

            <label for="tamanho">Tamanho:</label>
            <select name="tamanho" required>
                <option value="P" <?php echo ($row["tamanho"] == "P") ? "selected" : ""; ?>>P</option>
                <option value="M" <?php echo ($row["tamanho"] == "M") ? "selected" : ""; ?>>M</option>
                <option value="G" <?php echo ($row["tamanho"] == "G") ? "selected" : ""; ?>>G</option>
                <option value="GG" <?php echo ($row["tamanho"] == "GG") ? "selected" : ""; ?>>GG</option>
            </select>

            <label for="marca">Marca:</label>
            <input type="text" name="marca" value="<?php echo $row["marca"]; ?>" required>

            <input type="submit" value="Salvar Alterações" class="btn">
        </form>
    </div>
</body>
</html>
