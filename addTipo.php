<?php
require_once 'init.php';

$descricao = isset($_POST['descricao']) ? $_POST['descricao'] : null;
if (empty($descricao))
{
    echo "Volte e preencha todos os campos";
    exit;
}
$PDO = db_connect();
$sql = "INSERT INTO tipos(descricaoTipo) VALUES(:descricao)";
$stmt = $PDO->prepare($sql);
$stmt->bindParam(':descricao', $descricao);

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