<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <title>Página Inicial</title>
</head>

<body>
        <div class="container">
          <div class="jumbotron">
            <div class="row">
                <h2>Cadastro Equipamento</h2>
            </div>
          </div>
            </br>
            <div class="row">
                <p>
                    <a href="create_equip.php" class="btn btn-success">Adicionar</a>
                    <a href="index.php" class="btn btn-primary">Voltar para Agendamento</a>
                </p>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Nome</th>
                            <th scope="col">Tipo</th>
                            <th scope="col">Serial</th>
                            <th scope="col">Descrição</th>
                            <th scope="col">Ação</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        header("Cache-Control: no-store, no-cache, must-revalidate"); // HTTP/1.1
                        header("Cache-Control: post-check=0, pre-check=0", false);
                        header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past
                        header("Pragma: no-cache"); // HTTP/1.0
                        header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");

                        include 'banco.php';
                        $pdo = Banco::conectar();
                        $sql = 'SELECT * FROM equipamento ORDER BY id DESC';

                        foreach($pdo->query($sql)as $row)
                        {
                            echo '<tr>';
                            echo '<th scope="row">'. $row['id'] . '</th>';
                            echo '<td>'. $row['nome'] . '</td>';
                            echo '<td>'. $row['tipo'] . '</td>';
                            echo '<td>'. $row['serial'] . '</td>';
                            echo '<td>'. $row['descricao'] . '</td>';
                            echo '<td width=250>';
                            echo '<a class="btn btn-primary" href="read_equip.php?id='.$row['id'].'">Info</a>';
                            echo ' ';
                            echo '<a class="btn btn-warning" href="update_equip.php?id='.$row['id'].'">Atualizar</a>';
                            echo ' ';
                            echo '<a class="btn btn-danger" href="delete_equip.php?id='.$row['id'].'">Excluir</a>';
                            echo '</td>';
                            echo '</tr>';
                        }
                        Banco::desconectar();
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <!-- Latest compiled and minified JavaScript -->
    <script src="assets/js/bootstrap.min.js"></script>
</body>

</html>
