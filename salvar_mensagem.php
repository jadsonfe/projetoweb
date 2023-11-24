<?php
session_start();
include_once 'connection.php';

$token = $_COOKIE['token'];

if(!isset($token)) exit(); 

$arrayToken = explode('.', $token);
$payload = $arrayToken[1];
$userData = base64_decode($payload);
$userData = json_decode($userData);

// Obter dados do formulário
$mensagem = $_POST['mensagem'];

try {
    // Inserir mensagem no banco de dados
    $stmt = $pdo->prepare("INSERT INTO mensagens (mensagem, user_id) VALUES (:mensagem, :user_id)");
    $stmt->bindParam(':mensagem', $mensagem);
    $stmt->bindParam(':user_id', $userData->id);
    $stmt->execute();

    echo "Mensagem enviada com sucesso!";
} catch (PDOException $e) {
    echo "Erro ao enviar a mensagem: " . $e->getMessage();
}

// Fechar a conexão
$pdo = null;
