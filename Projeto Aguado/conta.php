<?php
session_start(); // Inicia a sessão
require_once 'db_conn.php'; // Inclui a conexão com o banco


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $senha = $_POST["senha"];

    
    // Preparar a query para evitar injeção SQL
    
    $stmt = $conn->prepare("INSERT INTO usuario (nome, email, senha) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $nome, $email, $senha);


    if ($stmt->execute()) {
        
        $_SESSION['message'] = "Conta criada com sucesso!";
        header("Location: index.html");
        exit(0);
    } else {
        echo "Erro ao inserir os dados: " . $stmt->error;
    }


    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crie sua Conta</title>
    <link rel="stylesheet" type="text/css" href="css/conta.css">
</head>
<body>
    <div class="conta-container">
        <div class="logo">
          <img src="img/logo.png" alt="Logo">
        </div>
        <h1>CRIE SUA CONTA</h1>
        
        <form action="" method="POST">
            <input type="text" name="nome" placeholder="Nome" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="senha" placeholder="Senha" required>
            <button type="submit">Criar conta</button>
        </form>
    </div>
</body>
</html>
