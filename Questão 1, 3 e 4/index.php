<?php
// Conexão com o banco de dados
$mysqli = new mysqli("localhost", "root", "", "moradores_db");
if ($mysqli->connect_error) {
    die("Falha na conexão: " . $mysqli->connect_error);
}

// Verifica se há uma pesquisa
$busca = isset($_GET['busca']) ? $_GET['busca'] : '';

// Consulta ao banco de dados
$sql = "SELECT nome_completo, idade, numero_apartamento FROM moradores WHERE nome_completo LIKE ?";
$stmt = $mysqli->prepare($sql);
$busca_param = "%" . $busca . "%"; // Permite buscar qualquer parte do nome
$stmt->bind_param("s", $busca_param);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Lista de Moradores</title>
</head>
<body>
    <h2>Buscar Moradores</h2>
    <form method="GET" action="index.php">
        <input type="text" name="busca" placeholder="Digite o nome ou sobrenome" value="<?php echo htmlspecialchars($busca); ?>">
        <button type="submit">Buscar</button>
    </form>

    <h3>Resultado da Busca:</h3>
    <table border="1">
        <tr>
            <th>Nome Completo</th>
            <th>Idade</th>
            <th>Numero do Apartamento</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo htmlspecialchars($row['nome_completo']); ?></td>
                <td><?php echo $row['idade']; ?></td>
                <td><?php echo $row['numero_apartamento']; ?></td>
            </tr>
        <?php endwhile; ?>
    </table>

    <br>
    <a href="login.php">Fazer Login</a> | <a href="register.php">Cadastrar-se</a>
</body>
</html>

<?php
$stmt->close();
$mysqli->close();
?>
