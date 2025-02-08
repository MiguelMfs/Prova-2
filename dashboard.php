<?php
session_start();
if (!isset($_SESSION['user_id'])) { // Verifica se o usuário está logado
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Área do Morador</title>
</head>
<body>
    <h2>Bem-vindo, <?php echo $_SESSION['nome']; ?>!</h2>
    <a href="logout.php">Sair</a>
</body>
</html>
