<?php
session_start();

// Conexão com o banco de dados
$mysqli = new mysqli("localhost", "root", "", "moradores_db");
if ($mysqli->connect_error) {
    die("Falha na conexão: " . $mysqli->connect_error);
}

// Captura os dados do formulário
$cpf = $_POST['cpf'];
$senha = $_POST['senha'];

// Busca o usuário no banco de dados
$sql = "SELECT id, nome_completo, senha FROM moradores WHERE cpf = ?";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("s", $cpf);
$stmt->execute();
$result = $stmt->get_result();

if ($row = $result->fetch_assoc()) {
    if (password_verify($senha, $row['senha'])) { // Verifica a senha
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['nome'] = $row['nome_completo'];
        header("Location: dashboard.php"); // Redireciona para o painel
        exit();
    } else {
        echo "Senha incorreta.";
    }
} else {
    echo "Usuário não encontrado.";
}
$stmt->close();
$mysqli->close();
?>
