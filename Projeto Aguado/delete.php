<?php
session_start(); 
require_once 'db_conn.php'; 


if ($_SERVER["REQUEST_METHOD"] === "POST") { 
    $email = $_POST["email"]; 
    $nome= $_POST["nome"]; 
    $sql = "Delete from usuario where email = '$email'";
    if ($conn->query($sql) === TRUE) { 
        $_SESSION['message'] = "Pessoa excluida com sucesso!"; 
        header("Location: usuarios.php"); 
        exit(0);
    } else {
        echo "Erro: " . $sql . "<br>" . $conn->error;
    }
    $conn->close(); //Fecha a conexão com o banco
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--Vamos usar o BootStrap para pegar alguns estilos prontos? -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Inserindo gente!</title>
</head>
<body>
<!-- Essas classes do CSS são todas do bootstrap!-->
<div class="container mt-5">
        <!-- O bootstrap organiza o layout em linhas (row) e colunas (col)-->
                <div class="card">
                    <div class="card-header">
                        <h4>Deletar pessoa
                            <a href="usuarios.php" class="btn btn-danger float-end">VOLTAR</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <!-- Vamos omitir o  action porque queremos que o formulário chame ele mesmo!-->
                        <form method="POST">
                            <div class="mb-3">
                                <label>email</label>
                                <input type="text" name="email" value=<?=$_GET['email']?> class="form-control" readonly>
                            </div>
                            
                            <div class="mb-3">
                                <button type="submit" name="atualizar_pessoa" class="btn btn-primary">Remover pessoa</button>
                            </div>
                        </form>
                    </div>
                </div>
    </div>
    
</body>
</html>