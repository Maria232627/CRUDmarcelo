<?php
    require 'init.php';
    $id = isset($_GET['id']) ? (int) $_GET['id'] : null;
    if (empty($id))
    {
        echo "ID para alteração não definido";
        exit;
    }
    $PDO = db_connect();
    $sqlTarefa = "SELECT id, descricaoTarefa, status, tipo_id FROM tarefas WHERE id = :id";
    $stmtTarefa = $PDO->prepare($sqlTarefa);
    $stmtTarefa->bindParam(':id', $id, PDO::PARAM_INT);
    $stmtTarefa->execute();
    $tarefa = $stmtTarefa->fetch(PDO::FETCH_ASSOC);
    if (!is_array($tarefa))
    {
        echo "Nenhum cadastro encontrado";
        exit;
    }
    $sqlTipo = "SELECT id, descricaoTipo FROM tipos ORDER BY descricaoTipo ASC";
    $stmtTipo = $PDO->prepare($sqlTipo);
    $stmtTipo->execute();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tarefas</title>
    <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href="estilo.css" rel="stylesheet">
    <script src="bootstrap/js/popper.min.js"></script>
    <script src="bootstrap/js/bootstrap.js"></script>
    <script src="bootstrap/js/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $(function(){
                $("#menu").load("navbar.html");
            });
        });
    </script>
</head>
<body>
    <div class="container">
        <div id="menu"></div>
    </div>
    <div class="container">
        <div class="jumbotron">
            <p class="h3 text-center">Editar tarefa</p>
        </div>
        <form action="editTarefa.php" method="post">
            <div class="form-group">
                <label for="descricao">Descrição: </label>
                <input type="text" class="form-control" name="descricao" id="descricao" value="<?php echo $tarefa['descricaoTarefa'] ?>">
            </div>
            <div class="form-group">
                <label for="selectTipo">Selecione o tipo da tarefa</label>
                <select class="form-control" name="selectTipo" id="selectTipo">

                  <?php while($dados = $stmtTipo->fetch(PDO::FETCH_ASSOC)): ?>

                        <option value=" <?php echo $dados['id'] ?> "> <?php echo $dados['descricaoTipo'] ?> </option>
                      
                  <?php endwhile; ?>

                </select>
              </div>
              <div class="form-group">
                <label for="selectStatus">Selecione o status da tarefa</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="selectStatus" id="selectStatus" value="S" <?php if($tarefa['status'] == 'S') echo "checked"; ?>>
                    <label class="form-check-label" for="selectStatus">
                      Concluída
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="selectStatus" id="selectStatus" value="N" <?php if($tarefa['status'] == 'N') echo "checked"; ?>>
                    <label class="form-check-label" for="selectStatus">
                      Pendente
                    </label>
                  </div>
              </div>
              <div class="form-group">
                <input type="hidden" name="id" value="<?php echo $id ?>">
                <button type="submit" class="btn btn-primary">Enviar</button>
                <a class="btn btn-danger" href="index.html">Cancelar</a>
              </div>
          </form>  
    </div>
    <div class="container">
        <div class="card-footer">
            <p>Todos os direitos reservados a &copy;Copyright</p>
        </div>
    </div>
</body>
</html>