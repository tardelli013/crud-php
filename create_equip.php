<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  <title>Adicionar Equipamento</title>
</head>

<body>
    <div class="container">
        <div clas="span10 offset1">
          <div class="card">
            <div class="card-header">
                <h3 class="well"> Adicionar Equipamento </h3>
            </div>
            <div class="card-body">
            <form class="form-horizontal" action="create_equip.php" method="post">

                <div class="control-group <?php echo !empty($nomeErro)?'error ' : '';?>">
                    <label class="control-label">Nome</label>
                    <div class="controls">
                        <input size="50" class="form-control" name="nome" type="text" placeholder="Nome" required="" value="<?php echo !empty($nome)?$nome: '';?>">
                        <?php if(!empty($nomeErro)): ?>
                            <span class="help-inline"><?php echo $nomeErro;?></span>
                            <?php endif;?>
                    </div>
                </div>

                <div class="control-group <?php echo !empty($tipoErro)?'error ': '';?>">
                    <label class="control-label">Tipo</label>
                    <div class="controls">
                        <input size="80" class="form-control" name="tipo" type="text" placeholder="Tipo" required="" value="<?php echo !empty($tipo)?$tipo: '';?>">
                        <?php if(!empty($tipoErro)): ?>
                            <span class="help-inline"><?php echo $tipoErro;?></span>
                            <?php endif;?>
                    </div>
                </div>

                <div class="control-group <?php echo !empty($serialErro)?'error ': '';?>">
                    <label class="control-label">Serial</label>
                    <div class="controls">
                        <input size="35" class="form-control" name="serial" type="text" placeholder="serial" required="" value="<?php echo !empty($serial)?$serial: '';?>">
                        <?php if(!empty($serialErro)): ?>
                            <span class="help-inline"><?php echo $serialErro;?></span>
                            <?php endif;?>
                    </div>
                </div>

                <div class="control-group <?php echo !empty($descricaoErro)?'error ': '';?>">
                    <label class="control-label">Descrição</label>
                    <div class="controls">
                        <input size="40" class="form-control" name="descricao" type="text" placeholder="descricao" required="" value="<?php echo !empty($descricao)?$descricao: '';?>">
                        <?php if(!empty($descricaoErro)): ?>
                            <span class="help-inline"><?php echo $descricaoErro;?></span>
                            <?php endif;?>
                    </div>
                </div>

                <div class="form-actions">
                    <br/>

                    <button type="submit" class="btn btn-success">Adicionar</button>
                    <a href="./index_equip.php" type="btn" class="btn btn-default">Voltar</a>

                </div>
            </form>
          </div>
        </div>
        </div>
    </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <!-- Latest compiled and minified JavaScript -->
    <script src="assets/js/bootstrap.min.js"></script>
</body>

</html>

<?php
    require 'banco.php';

    if(!empty($_POST))
    {
        //Acompanha os erros de validação
        $nomeErro = null;
        $tipoErro = null;
        $serialErro = null;
        $descricaoErro = null;

        $nome = $_POST['nome'];
        $tipo = $_POST['tipo'];
        $serial = $_POST['serial'];
        $descricao = $_POST['descricao'];

        //Validaçao dos campos:
        $validacao = true;
        if(empty($nome))
        {
            $nomeErro = 'Por favor digite o seu nome!';
            $validacao = false;
        }

        if(empty($tipo))
        {
            $tipoErro = 'Por favor digite o seu endereço!';
            $validacao = false;
        }

        if(empty($serial))
        {
            $serialErro = 'Por favor digite o número do serial!';
            $validacao = false;
        }

        if(empty($descricao))
        {
            $serialErro = 'Por favor digite o endereço de descricao';
            $validacao = false;
        }

        //Inserindo no Banco:
        if($validacao)
        {
            $pdo = Banco::conectar();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO equipamento (nome, tipo, serial, descricao) VALUES(?,?,?,?)";
            $q = $pdo->prepare($sql);
            $q->execute(array($nome,$tipo,$serial,$descricao));
            Banco::desconectar();
            header("Location: http://agendamentos.pgcopy.com.br/crud-php/index_equip.php");
        }
    }
?>
