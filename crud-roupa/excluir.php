<?php



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Processar o formulário de exclusão
    $id = $_POST["id"];

    // Conexão com o banco de dados (ajuste as configurações conforme necessário)
    $conn = new mysqli("localhost", "root", "", "roupas");

    // Verificar a conexão
    if ($conn->connect_error) {
        die("Conexão falhou: " . $conn->connect_error);
    }

    // Excluir a roupa do banco de dados
    $sql = "DELETE FROM roupas WHERE id = $id";
    $conn->query($sql);

    // Fechar a conexão
    $conn->close();

    // Redirecionar para a página principal após a exclusão
    header("Location: index.php");
    exit();
}

// Se o ID não estiver definido, redirecionar para a página principal
if (!isset($_GET["id"])) {
    header("Location: index.php");
    exit();
}

// Obter informações da roupa para confirmar a exclusão
$id = $_GET["id"];

// Conexão com o banco de dados (ajuste as configurações conforme necessário)
$conn = new mysqli("localhost", "root", "", "roupas");

// Verificar a conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Consultar a roupa específica
$sql = "SELECT * FROM roupas WHERE id = $id";
$result = $conn->query($sql);

// Fechar a conexão
$conn->close();

// Se a roupa não for encontrada, redirecionar para a página principal
if ($result->num_rows === 0) {
    header("Location: index.php");
    exit();
}

$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Excluir Roupa</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Excluir Roupa</h2>

        <p>Tem certeza de que deseja excluir a seguinte roupa?</p>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Cor</th>
                    <th>Preço</th>
                    <th>Tamanho</th>
                    <th>Marca</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?php echo $row["id"]; ?></td>
                    <td><?php echo $row["cor"]; ?></td>
                    <td>R$ <?php echo number_format($row["preco"], 2, ",", "."); ?></td>
                    <td><?php echo $row["tamanho"]; ?></td>
                    <td><?php echo $row["marca"]; ?></td>
                </tr>
            </tbody>
        </table>

        <form method="post" action="">
            <input type="hidden" name="id" value="<?php echo $row["id"]; ?>">
            <input type="submit" value="Sim, Excluir Roupa" class="btn">
        </form>

        <p><a href="index.php" class="btn">Cancelar</a></p>
    </div>
</body>
</html>
