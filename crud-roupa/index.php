<?php
// config.php - Configuração do Banco de Dados
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "roupas";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>CRUD de Roupas</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
        }

        header {
            background-color: #333;
            color: #fff;
            padding: 15px;
            text-align: center;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        form {
            margin-top: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input, select {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            box-sizing: border-box;
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            text-decoration: none;
            background-color: #333;
            color: #fff;
            border-radius: 5px;
            cursor: pointer;
        }

        .btn:hover {
            background-color: #555;
        }
    </style>
</head>
<body>
    <header>
        <h1>CRUD de Roupas</h1>
    </header>

    <div class="container">
        <!-- Formulário de Cadastro -->
        <h2>Cadastrar Nova Roupa</h2>
        <form method="post" action="cadastrar.php">
            <label for="cor">Cor:</label>
            <input type="text" name="cor" required>

            <label for="preco">Preço:</label>
            <input type="text" name="preco" required>

            <label for="tamanho">Tamanho:</label>
            <select name="tamanho" required>
                <option value="P">P</option>
                <option value="M">M</option>
                <option value="G">G</option>
                <option value="GG">GG</option>
            </select>

            <label for="marca">Marca:</label>
            <input type="text" name="marca" required>

            <input type="submit" value="Cadastrar" class="btn">
        </form>

        <!-- Tabela de Roupas -->
        <h2>Roupas Cadastradas</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Cor</th>
                    <th>Preço</th>
                    <th>Tamanho</th>
                    <th>Marca</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM roupas";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["id"] . "</td>";
                        echo "<td>" . $row["cor"] . "</td>";
                        echo "<td>" . $row["preco"] . "</td>";
                        echo "<td>" . $row["tamanho"] . "</td>";
                        echo "<td>" . $row["marca"] . "</td>";
                        echo "<td><a href='editar.php?id=" . $row["id"] . "'>Editar</a> | <a href='excluir.php?id=" . $row["id"] . "'>Excluir</a></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>Nenhuma roupa cadastrada.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
