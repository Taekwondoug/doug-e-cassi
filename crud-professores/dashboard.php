<?php
session_start();

// Verificar se o usuário está autenticado
if (!isset($_SESSION['email'])) {
    header("Location: index.php");
    exit();
}
$conn = new mysqli("localhost", "root", "", "escola");


// Obter dados do usuário a partir da sessão (apenas para ilustração)
$nomeUsuario = $_SESSION['nome'];
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Sistema de Professores</h1>
    </header>
    
    <div class="container">
        <h2>Dashboard</h2>
        <p><?php echo $nomeUsuario; ?>!</p>
        
        <!-- Adicione aqui o conteúdo do dashboard -->
        <!-- ... -->

        <br>
        <a href="capa.php" class="btn">Ver Professores</a>
        <br>
        <br>
        <a href="logout.php" class="btn">Sair</a>
        <br>
        <br>
        <a href="editarusuario.php" class="btn">editar usuário</a>
        <br>
        <br>
        <a href="ExcluirUsuario.php" class="btn">Excluir Usuário</a>
    </div>

    <footer>
        <p>&copy; 2023 Sistema de Professores</p>
    </footer>
</body>
</html>