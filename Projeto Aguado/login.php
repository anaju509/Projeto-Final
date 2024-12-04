<?php
require 'conexao.php'; // Inclui o arquivo de conexão com o banco de dados

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Preparar a consulta para buscar o usuário pelo email
    $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE email = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    // Recupera o usuário do banco de dados
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Verifica se o usuário existe e se a senha está correta
    if ($user && password_verify($senha, $user['senha'])) {
        // Inicia a sessão
        session_start();
        $_SESSION['email'] = $user['email'];  // Armazena o email na sessão
        $_SESSION['user_id'] = $user['id'];   // Armazena o ID do usuário na sessão (opcional)

        // Redireciona para uma página restrita ou área inicial
        header("Location: index.php");  // Redireciona para a página restrita ou área inicial
        exit(); // Encerra o script para garantir que o redirecionamento ocorra imediatamente
    } else {
        // Se o usuário ou senha estiverem incorretos
        echo "Usuário ou senha incorretos.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="css/login.css">
</head>
<body>
    <div class="conta-container">
        <div class="logo">
          <img src="img/logo.png" alt="Logo">
        </div>
        <h1>Login</h1>

        <!-- Formulário de login -->
        <form action="" method="POST">
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="senha" placeholder="Senha" required>
            <button type="submit">Entrar</button>
        </form>
    </div>
</body>
</html>
