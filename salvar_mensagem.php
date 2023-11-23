<?php
session_start();
include_once 'connection.php';

// Obter dados do formulário
$mensagem = $_POST['mensagem'];

try {
    // Inserir mensagem no banco de dados
    $stmt = $pdo->prepare("INSERT INTO mensagens (mensagem) VALUES (:mensagem)");
    $stmt->bindParam(':mensagem', $mensagem);
    $stmt->execute();

    echo "Mensagem enviada com sucesso!";
} catch (PDOException $e) {
    echo "Erro ao enviar a mensagem: " . $e->getMessage();
}

// Fechar a conexão
$pdo = null;
?>