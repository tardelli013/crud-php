<?php

	require 'banco.php';

	$id = null;
	if ( !empty($_GET['id']))
            {
		$id = $_REQUEST['id'];
            }

	if ( null==$id )
            {
		header("Location: index_equip.php");
            }

	if ( !empty($_POST))
            {

		$nomeErro = null;
		$tipoErro = null;
		$serialErro = null;
        $descricaoErro = null;

		$nome = $_POST['nome'];
		$tipo = $_POST['tipo'];
		$serial = $_POST['serial'];
        $descricao = $_POST['descricao'];

		//Validação
		$validacao = true;
		if (empty($nome))
                {
                    $nomeErro = 'Por favor digite o nome!';
                    $validacao = false;
        }

		if (empty($tipo))
                {
                    $tipoErro = 'Por favor digite o tipo!';
                    $validacao = false;
		}

		if (empty($serial))
                {
                    $serial = 'Por favor digite o serial!';
                    $validacao = false;
		}

        if (empty($descricao))
                {
                    $descricao = 'Por favor digite a descrição!';
                    $validacao = false;
		}

		// update data
		if ($validacao)
                {
                    $pdo = Banco::conectar();
                    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $sql = "UPDATE equipamento  set nome = ?, tipo = ?, serial = ?, descricao = ? WHERE id = ?";
                    $q = $pdo->prepare($sql);
                    $q->execute(array($nome,$tipo,$serial,$descricao,$id));
                    Banco::desconectar();
                    header("Location: index_equip.php");
		}
	}
        else
            {
                $pdo = Banco::conectar();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT * FROM equipamento where id = ?";
		$q = $pdo->prepare($sql);
		$q->execute(array($id));
		$data = $q->fetch(PDO::FETCH_ASSOC);
		$nome = $data['nome'];
        $tipo = $data['tipo'];
        $serial = $data['serial'];
		$descricao = $descricao['descricao'];
		Banco::desconectar();
	}
?>

    <!DOCTYPE html>
    <html lang="pt-br">

    <head>
        <meta charset="utf-8">
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="assets/css/bootstrap.min.css">
				<title>Atualizar Contato</title>
    </head>

    <body>
        <div class="container">

            <div class="span10 offset1">
							<div class="card">
								<div class="card-header">
                    <h3 class="well"> Atualizar Equipamento </h3>
                </div>
								<div class="card-body">
                <form class="form-horizontal" action="update_equip.php?id=<?php echo $id?>" method="post">

                    <div class="control-group <?php echo !empty($nomeErro)?'error':'';?>">
                        <label class="control-label">Nome</label>
                        <div class="controls">
                            <input name="nome" class="form-control" size="50" type="text" placeholder="Nome" value="<?php echo !empty($nome)?$nome:'';?>">
                            <?php if (!empty($nomeErro)): ?>
                                <span class="help-inline"><?php echo $nomeErro;?></span>
                                <?php endif; ?>
                        </div>
                    </div>

                    <div class="control-group <?php echo !empty($tipoErro)?'error':'';?>">
                        <label class="control-label">Tipo</label>
                        <div class="controls">
                            <input name="tipo" class="form-control" size="80" type="text" placeholder="Tipo" value="<?php echo !empty($tipo)?$tipo:'';?>">
                            <?php if (!empty($tipoErro)): ?>
                                <span class="help-inline"><?php echo $tipoErro;?></span>
                                <?php endif; ?>
                        </div>
                    </div>

                    <div class="control-group <?php echo !empty($serialErro)?'error':'';?>">
                        <label class="control-label">Serial</label>
                        <div class="controls">
                            <input name="serial" class="form-control" size="30" type="text" placeholder="serial" value="<?php echo !empty($serial)?$serial:'';?>">
                            <?php if (!empty($serialErro)): ?>
                                <span class="help-inline"><?php echo $serialErro;?></span>
                                <?php endif; ?>
                        </div>
                    </div>

                    <div class="control-group <?php echo !empty($descricao)?'error':'';?>">
                        <label class="control-label">Descrição</label>
                        <div class="controls">
                            <input name="descricao" class="form-control" size="40" type="text" placeholder="descricao" value="<?php echo !empty($descricao)?$descricao:'';?>">
                            <?php if (!empty($descricaoErro)): ?>
                                <span class="help-inline"><?php echo $descricaoErro;?></span>
                                <?php endif; ?>
                        </div>
                    </div>

                    <br/>
                    <div class="form-actions">
                        <button type="submit" class="btn btn-warning">Atualizar</button>
                        <a href="index_equip.php" type="btn" class="btn btn-default">Voltar</a>
                    </div>
                </form>
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
