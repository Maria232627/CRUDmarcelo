<?php
require_once 'init.php';
// pega os dados do formuário
$descricao = isset($_POST['descricao']) ? $_POST['descricao'] : null;
$tipo_id = isset($_POST['selectTipo']) ? $_POST['selectTipo'] : null;
$status = isset($_POST['selectStatus']) ? $_POST['selectStatus'] : null;

// validação (bem simples, só pra evitar dados vazios)
if (empty($descricao) || empty($tipo_id) || empty($status))
{
    echo "Volte e preencha todos os campos";
    exit;
}
// insere no banco
$PDO = db_connect();
$sql = "INSERT INTO tarefas(descricaoTarefa, status, tipo_id) VALUES(:descricao, :status, :tipo_id)";
$stmt = $PDO->prepare($sql);
$stmt->bindParam(':descricao', $descricao);
$stmt->bindParam(':status', $status);
$stmt->bindParam(':tipo_id', $tipo_id);

if ($stmt->execute())
{
    header('Location: msgSucesso.html');
}
else
{
    echo "Erro ao cadastrar";
    print_r($stmt->errorInfo());
}
?>