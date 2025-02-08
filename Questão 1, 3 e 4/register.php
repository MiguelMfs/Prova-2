<!DOCTYPE html>
<html>
<head>
    <title>Cadastro de Moradores</title>
</head>
<body>
    <h2>Cadastro de Moradores</h2>
    <form action="process_register.php" method="POST">
        Nome Completo: <input type="text" name="nome_completo" required><br>
        Idade: <input type="number" name="idade" required><br>
        CPF: <input type="text" name="cpf" required><br>
        Numero do Apartamento: <input type="number" name="numero_apartamento" required><br>
        Senha (4 digitos): <input type="password" name="senha" pattern="\d{4}" required><br>
        <input type="submit" value="Cadastrar">
    </form>
</body>
</html>
