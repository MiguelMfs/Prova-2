<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Conexão com o banco de dados
$mysqli = new mysqli("localhost", "root", "", "moradores_db");
if ($mysqli->connect_error) {
    die("Falha na conexão: " . $mysqli->connect_error);
}

// Captura os dados do formulário
$user_id = $_SESSION['user_id'];
$nome = $_POST['nome_completo'];
$idade = $_POST['idade'];
$numero_apartamento = $_POST['numero_apartamento'];
$senha = $_POST['senha'];
$acao = $_POST['acao'];

// Busca a senha criptografada do usuário no banco
$sql = "SELECT senha FROM moradores WHERE id = ?";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$usuario = $result->fetch_assoc();
$stmt->close();

// Se a senha estiver errada, bloqueia a operação
if (!$usuario || !password_verify($senha, $usuario['senha'])) {
    die("Senha incorreta. <a href='edit_delete.php'>Tente novamente</a>");
}

// Se o usuário escolheu ALTERAR os dados
if ($acao === "Alterar") {
    $sql = "UPDATE moradores SET nome_completo = ?, idade = ?, numero_apartamento = ? WHERE id = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("siii", $nome, $idade, $numero_apartamento, $user_id);
    
    if ($stmt->execute()) {
        echo "Cadastro atualizado com sucesso! <a href='edit_delete.php'>Voltar</a>";
    } else {
        echo "Erro ao atualizar cadastro.";
    }
    $stmt->close();
}

// Se o usuário escolheu EXCLUIR o cadastro
elseif ($acao === "Excluir") {
    $sql = "DELETE FROM moradores WHERE id = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("i", $user_id);

    if ($stmt->execute()) {
        session_destroy();
        echo "Conta excluida com sucesso. <a href='register.php'>Cadastrar novamente</a>";
    } else {
        echo "Erro ao excluir conta.";
    }
    $stmt->close();
}

$mysqli->close();
?>
