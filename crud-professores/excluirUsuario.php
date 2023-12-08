<?php
session_start();

// Verificar se o usuário está autenticado
if (!isset($_SESSION["id"])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Conectar ao banco de dados (ajuste as configurações conforme necessário)
    $conn = new mysqli("localhost", "root", "", "escola");

    // Verificar a conexão
    if ($conn->connect_error) {
        die("Conexão falhou: " . $conn->connect_error);
    }

    // Excluir o usuário do banco de dados
    $id_usuario = $_SESSION["id"];
    $sql_excluir_usuario = "DELETE FROM usuarios WHERE id = $id_usuario";
    $result_excluir_usuario = $conn->query($sql_excluir_usuario);

    if ($result_excluir_usuario === TRUE) {
        // Exclusão bem-sucedida, destruir a sessão e redirecionar para a página de login
        session_unset();
        session_destroy();
        header("Location: index.php");
        exit();
    } else {
        $erro = "Erro na exclusão: " . $conn->error;
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Excluir Conta</title>
</head>
<body>
    <h2>Excluir Conta</h2>

    <?php if (isset($erro)) : ?>
        <p style="color: red;"><?php echo $erro; ?></p>
    <?php endif; ?>

    <p>Tem certeza de que deseja excluir sua conta?</p>

    <form method="post" action="">
        <input type="submit" value="Sim, Excluir Conta">
    </form>

    <p><a href="dashboard.php">Cancelar</a></p>
</body>
</html>
