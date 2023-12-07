<?php
include 'conexao.php';

// Selecionar todos os professores
$sql = "SELECT * FROM professores";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>CRUD de Professores</title>
</head>
<body>
    <h2>Lista de Professores</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Idade</th>
            <th>Especialidade</th>
            <th>Graduação</th>
            <th>Ações</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>".$row["id"]."</td>";
                echo "<td>".$row["nome"]."</td>";
                echo "<td>".$row["idade"]."</td>";
                echo "<td>".$row["especialidade"]."</td>";
                echo "<td>".$row["graduacao"]."</td>";
                echo '<td><a href="editar.php?id='.$row["id"].'">Editar</a> | <a href="excluir.php?id='.$row["id"].'">Excluir</a></td>';
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='6'>Nenhum professor encontrado.</td></tr>";
        }
        ?>
    </table>
    <br>
    <a href="adicionar.php">Adicionar Novo Professor</a>
</body>
</html>
