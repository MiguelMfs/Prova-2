<?php
session_start();
if (!isset($_SESSION['user_id'])) { // Verifica se o usuário está logado
    header("Location: login.php");
    exit();
}

// Conexão com o banco de dados
$mysqli = new mysqli("localhost", "root", "", "moradores_db");
if ($mysqli->connect_error) {
    die("Falha na conexao: " . $mysqli->connect_error);
}

// Obtém os dados do usuário logado
$user_id = $_SESSION['user_id'];
$sql = "SELECT nome_completo, idade, cpf, numero_apartamento FROM moradores WHERE id = ?";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$usuario = $result->fetch_assoc();
$stmt->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Alterar ou Excluir Cadastro</title>
</head>
<body>
    <h2>Alterar ou Excluir Cadastro</h2>
    <form action="process_edit_delete.php" method="POST">
        Nome Completo: <input type="text" name="nome_completo" value="<?php echo htmlspecialchars($usuario['nome_completo']); ?>" required><br>
        Idade: <input type="number" name="idade" value="<?php echo $usuario['idade']; ?>" required><br>
        CPF: <input type="text" name="cpf" value="<?php echo $usuario['cpf']; ?>" readonly><br>
        Número do Apartamento: <input type="number" name="numero_apartamento" value="<?php echo $usuario['numero_apartamento']; ?>" required><br>
        Senha Atual (para confirmar): <input type="password" name="senha" required><br>
        <input type="submit" name="acao" value="Alterar">
        <input type="submit" name="acao" value="Excluir" onclick="return confirm('Tem certeza que deseja excluir sua conta? Esta acao nao pode ser desfeita.')">
    </form>
    <br>
    <a href="logout.php">Sair</a>
</body>
</html>
