<?php
    session_start();
    require_once 'db_conn.php';

?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--Vamos usar o BootStrap para pegar alguns estilos prontos? -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Página Inicial</title>
</head>
<body>
<div class="container mt-4">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Detalhes da pessoa
                            <a href="conta.php" class="btn btn-primary float-end">Adicionar gente</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>email</th>
                                    <th>nome</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $query = "SELECT * FROM usuario";
                                    $query_run = mysqli_query($conn, $query);
                                    if(mysqli_num_rows($query_run) > 0)
                                    {
                                        foreach($query_run as $usuario)
                                        {
                                            ?>
                                            <tr>
                                                <td><?= $usuario['email']; ?></td>
                                                <td><?= $usuario['nome']; ?></td>
                                                <td>
                                                    <a href="update.php?email=<?= $usuario['email']; ?> &nome= <?= $usuario['nome']; ?>" class="btn btn-success btn-sm">Editar</a>
                                                    <a href="delete.php?email=<?= $usuario['email']; ?> &senha= <?= $usuario['nome']; ?>" class="btn btn-success btn-sm">Deletar</a>   
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                    else
                                    {
                                        echo "<h5> Nenhuma gente cadastrada </h5>";
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>