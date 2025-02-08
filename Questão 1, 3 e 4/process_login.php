<?php
session_start();

$mysqli = new mysqli("localhost", "root", "", "moradores_db");
if ($mysqli->connect_error) {
    die("Falha na conexão: " . $mysqli->connect_error);
}

$cpf = $_POST['cpf'];
$senha = $_POST['senha'];

$sql = "SELECT id, nome_completo, senha FROM moradores WHERE cpf = ?";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("s", $cpf);
$stmt->execute();
$result = $stmt->get_result();

if ($row = $result->fetch_assoc()) {
    if (password_verify($senha, $row['senha'])) { 
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['nome'] = $row['nome_completo'];
        header("Location: dashboard.php"); // Redireciona para o painel
        exit();
    } else {
        echo "Senha incorreta.";
    }
} else {
    echo "Usuario nao encontrado.";
}
$stmt->close();
$mysqli->close();
?>
