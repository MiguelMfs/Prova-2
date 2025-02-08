<?php
$mysqli = new mysqli("localhost", "root", "", "moradores_db");
if ($mysqli->connect_error) {
    die("Falha na conexão: " . $mysqli->connect_error);
}

$nome = $_POST['nome_completo'];
$idade = $_POST['idade'];
$cpf = $_POST['cpf'];
$numero_apartamento = $_POST['numero_apartamento'];
$senha = password_hash($_POST['senha'], PASSWORD_BCRYPT); // Criptografa a senha

$sql = "INSERT INTO moradores (nome_completo, idade, cpf, numero_apartamento, senha) VALUES (?, ?, ?, ?, ?)";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("sisss", $nome, $idade, $cpf, $numero_apartamento, $senha);

if ($stmt->execute()) {
    echo "Cadastro realizado com sucesso! <a href='login.php'>Login</a>";
} else {
    echo "Erro ao cadastrar.";
}
$stmt->close();
$mysqli->close();
?>
