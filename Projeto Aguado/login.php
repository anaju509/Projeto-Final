<?php
session_start(); 
require_once 'db_conn.php'; 

if ($conn->connect_error) {
    die("Falha de conexão: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $email = trim($_POST['email']);
    $senha = trim($_POST['senha']);

    
    if (empty($email) || empty($senha)) {
        echo "<script>alert('Por favor, preencha todos os campos!');</script>";
    } else {
        
        $stmt = $conn->prepare("SELECT * FROM usuario WHERE email = ? AND senha = ?");
        $stmt->bind_param("ss", $email, $senha);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            
            $_SESSION['email'] = $email;
            header('Location: index.html');
            exit();
        } else {
        
            unset($_SESSION['email']);
            echo "<script>alert('Email ou senha incorretos!');</script>";
        }

        $stmt->close();
    }
}

$conn->close();
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
    <div class="login-container">
        <div class="logo">
            <img src="img/logo.png" alt="Logo">
        </div>
        <h1>LOGIN</h1>

        <form action="" method="POST">
            <input type="text" name="email" placeholder="Email" required>
            <input type="password" name="senha" placeholder="Senha" required>
            <button type="submit">Entrar</button>
        </form>
    </div>
</body>
</html>
