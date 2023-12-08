<?php
include_once "conexao.php";

// Selecionar todos os professores
$sql = "SELECT * FROM professores";
$result = $conn->query($sql);


?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>CRUD de Professores</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Sistema de Professores</h1>
    </header>
    
    <div class="container">
        <h2>Lista de Professores</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Idade</th>
                <th>Especialidade</th>
                <th>Graduação</th>
                <th>Ações</th>
            </tr>
            <?php
            // Verificar se $result está definida antes de usá-la
            if (isset($result) && $result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>".$row["id"]."</td>";
                    echo "<td>".$row["nome"]."</td>";
                    echo "<td>".$row["idade"]."</td>";
                    echo "<td>".$row["especialidade"]."</td>";
                    echo "<td>".$row["graduacao"]."</td>";
                    echo '<td><a href="editar.php?id='.$row["id"].'">Editar</a> | <a href="excluir.php?id='.$row["id"].'" onclick="return confirm(\'Tem certeza que deseja excluir este professor?\')">Excluir</a></td>';
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='6'>Nenhum professor encontrado.</td></tr>";
            }
            ?>
        </table>
        <a href="adicionar.php" class="btn">Adicionar Novo Professor</a>
        <a href="dashboard.php" class="btn">Dashboard</a>
    </div>
        


    <footer>
        <p>&copy; 2023 Sistema de Professores</p>
    </footer>
</body>
</html>
