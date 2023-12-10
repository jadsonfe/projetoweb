<?php 
session_start();
include_once 'validateToken.php'; 
include_once 'connection.php';

if (!validateToken()) {
    $_SESSION['msg'] = "Error: Incorrect email or password";
    header('Location: login.php');
    exit();
} 

// Obtém o ID do usuário da URL
if (isset($_GET['user_id'])) {
    $userId = $_GET['user_id'];

    // Consulta SQL para obter informações do usuário
    $sql = "SELECT use_name FROM user WHERE use_id = :user_id";
    try {
        // Preparar e executar a consulta
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $stmt->execute();

        // Exibir informações do perfil do usuário
        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $userName = $row['use_name'];

            echo "<h1>Perfil de $userName</h1>";
        } else {
            echo "Usuário não encontrado.";
        }
    } catch (PDOException $e) {
        die("Erro na execução da consulta: " . $e->getMessage());
    }
} else {
    echo "ID do usuário não fornecido.";
}

// Fechar a conexão
$pdo = null;
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<a href="logout.php">Exit</a>
            <a href="#">Blog</a>
            <a href="#">Sobre</a>
            <a href="#">Linguagens</a>
            <a href="home.php">Home</a>
</body>
</html>