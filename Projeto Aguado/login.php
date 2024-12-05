<?php
session_start(); 
require_once 'db_conn.php'; 

// Se o usuário já está logado, redireciona para a página principal

$erro = ""; // Inicializa a variável de erro

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email']; 
    $senha = $_POST['senha'];  

    // Prepara a consulta SQL
    $sql = "SELECT email, senha FROM usuario WHERE email = ?";
    $stmt = $conn->prepare($sql);
    
    if ($stmt === false) {
        die('Erro ao preparar a consulta: ' . $conn->error);
    }

    $stmt->bind_param("s", $email); 
    
    // Executa a consulta
    if (!$stmt->execute()) {
        die('Erro ao executar a consulta: ' . $stmt->error);
    }

    // Obtém o resultado
    $result = $stmt->get_result();

    // Verifica se encontrou o usuário
    if ($result->num_rows > 0) {
        $usuario = $result->fetch_assoc();

        // Verifica se a senha está correta (com password_verify)
        if (password_verify($senha, $email['senha'])) {
            // Se a senha estiver correta, cria a sessão
            $_SESSION['usuario_email'] = $usuario['email'];
            header("Location: index.html"); // Redireciona para a página principal
            exit();
        } else {
            $erro = "Senha incorreta!";
        }
    } else {
        $erro = "Email não encontrado!";
    }

    // Fecha a consulta e a conexão
    $stmt->close();
    $conn->close();
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
    <div class="login-container">
        <div class="logo">
            <img src="img/logo.png" alt="Logo">
        </div>
        <h1>LOGIN</h1>

        <!-- Exibe o erro se houver -->
        <?php if ($erro): ?>
            <div class="error"><?php echo $erro; ?></div>
        <?php endif; ?>

        <form action="" method="POST">
            <input type="text" name="email" placeholder="Email" required>
            <input type="password" name="senha" placeholder="Senha" required>
            <button type="submit">Entrar</button>
        </form>
    </div>
</body>
</html>
