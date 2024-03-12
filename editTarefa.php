<?php
    require_once 'init.php';
    $id = isset($_POST['id']) ? $_POST['id'] : null;
    $descricao = isset($_POST['descricao']) ? $_POST['descricao'] : null;
    $tipo_id = isset($_POST['selectTipo']) ? $_POST['selectTipo'] : null;
    $status = isset($_POST['selectStatus']) ? $_POST['selectStatus'] : null;

    // validação (bem simples, só pra evitar dados vazios)
    if (empty($descricao) || empty($tipo_id) || empty($status))
    {
        echo "Volte e preencha todos os campos";
        exit;
    }
    $PDO = db_connect();
    $sql = "UPDATE tarefas SET descricaoTarefa = :descricao, status = :status, tipo_id = :tipo_id WHERE id = :id";
    $stmt = $PDO->prepare($sql);
    $stmt->bindParam(':descricao', $descricao);
    $stmt->bindParam(':status', $status);
    $stmt->bindParam(':tipo_id', $tipo_id);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    if ($stmt->execute())
    {
        header('Location: msgSucesso.html');
    }
    else
    {
        echo "Erro ao alterar!";
        print_r($stmt->errorInfo());
    }
?>