<?php
session_start(); 
require_once 'db_conn.php';


if (isset($_GET['email'])) {
    $_SESSION['email_veio'] = $_GET['email'];
}


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST["email"]; 
    $nome = $_POST["nome"];   
    $email_veio = $_SESSION['email_veio'] ?? ''; 

    if (!empty($email_veio)) {

        $stmt = $conn->prepare("UPDATE usuario SET email = ?, nome = ? WHERE email = ?");
        $stmt->bind_param("sss", $email, $nome, $email_veio);

        if ($stmt->execute()) { 
            $_SESSION['message'] = "Pessoa atualizada com sucesso!"; 
            header("Location: usuarios.php"); 
            exit(0);
        } else {
            echo "Erro: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Erro: email original não encontrado.";
    }
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Atualizar Pessoa</title>
</head>
<body>
<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <h4>Atualizar Pessoa
                <a href="usuarios.php" class="btn btn-danger float-end">VOLTAR</a>
            </h4>
        </div>
        <div class="card-body">
            <!-- Formulário de atualização -->
            <form method="POST">
                <div class="mb-3">
                    <label>Email</label>
                    <input type="text" name="email" value="<?= htmlspecialchars($_GET['email'] ?? '', ENT_QUOTES) ?>" class="form-control">
                </div>
                <div class="mb-3">
                    <label>Nome</label>
                    <input type="text" name="nome" value="<?= htmlspecialchars($_GET['nome'] ?? '', ENT_QUOTES) ?>" class="form-control">
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Atualizar Pessoa</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
