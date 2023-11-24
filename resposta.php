<?php 
session_start();
include_once 'validateToken.php'; 
include_once 'connection.php';


if (!validateToken()) {
    $_SESSION['msg'] = "Error: Incorrect email or password";

    header('Location: login.php');
    exit();
} 

echo "Welcome " . getName();


// Se o parâmetro 'id' estiver presente na URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT id, mensagem, data_publicacao, use_name
            FROM mensagens 
            JOIN user ON user_id = use_id 
            WHERE id = :id";

    try {
        // Preparar e executar a consulta com um parâmetro
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        // Exibir a mensagem específica
        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            echo "<p><strong>" . $row['use_name'] . "</strong></p>";
            echo "<p>" . $row['mensagem'] . "</p>";
            echo "<p>Data de Publicação: " . $row['data_publicacao'] . "</p>";
            echo "<hr>";
        } else {
            echo "Nenhuma mensagem encontrada com o ID fornecido.";
        }
    } catch (PDOException $e) {
        die("Erro na execução da consulta: " . $e->getMessage());
    }
} else {
    echo "ID da mensagem não fornecido.";
}

$pdo = null;



?>