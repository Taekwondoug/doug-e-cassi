<?php
session_start();

// Verificar se o usuário está autenticado
if (!isset($_SESSION["id"])) {
    header("Location: index.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST["nome"];

    // Conectar ao banco de dados (ajuste as configurações conforme necessário)
    $conn = new mysqli("localhost", "root", "", "escola");

    // Verificar a conexão
    if ($conn->connect_error) {
        die("Conexão falhou: " . $conn->connect_error);
    }

    // Atualizar o nome do usuário no banco de dados
    $id_usuario = $_SESSION["id"];
    $sql_atualizar_usuario = "UPDATE usuarios SET nome = '$nome' WHERE id = $id_usuario";
    $result_atualizar_usuario = $conn->query($sql_atualizar_usuario);

    if ($result_atualizar_usuario === TRUE) {
        // Atualização bem-sucedida, redirecionar para a página de dashboard
        header("Location: index.php");
        exit();
    } else {
        $erro = "Erro na atualização: " . $conn->error;
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Perfil</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Sistema de Professores</h1>
    </header>

    <div class="container">
        <h2>Editar Perfil</h2>

        <?php if (isset($erro)) : ?>
            <p class="error"><?php echo $erro; ?></p>
        <?php endif; ?>

        <form method="post" action="">
            <label for="nome">Novo Nome:</label>
            <input type="text" name="nome" value="<?php echo $_SESSION["nome"]; ?>" required><br>

            <input type="submit" value="Salvar Alterações" class="btn">
        </form>

        <p><a href="dashboard.php" class="btn">Voltar para o Dashboard</a></p>
    </div>

    <footer>
        <p>&copy; 2023 Sistema de Professores</p>
    </footer>
</body>
</html>
