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




?>



<a href="logout.php">Exit</a>


<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="home.css">
    <title>studyConnect</title>
</head>
<body>
    <h1>StudyConnect</h1>

    <form method="POST" action="salvar_mensagem.php">
        <label for="mensagem">Escreva seu texto:</label>
        <textarea name="mensagem" id="mensagem" required></textarea><br>
        <input type="submit" value="Enviar">
    </form>

    <?php
    // Consulta SQL para obter posts e comentários associados
    $sql = "SELECT id, mensagem, data_publicacao, use_name
        FROM mensagens 
        JOIN user ON user_id = use_id 
        ORDER BY data_publicacao DESC";

    try {
        // Preparar e executar a consulta
        $stmt = $pdo->prepare($sql);
        $stmt->execute();

        // Exibir as mensagens e comentários
        if ($stmt->rowCount() > 0) {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<p><strong>" . $row['use_name'] . "</strong></p>";
                echo "<p>" . $row['mensagem'] . "</p>";
                echo "<p>Data de Publicação: " . $row['data_publicacao'] . "</p>";

                // Adicionar um link para resposta.php com um parâmetro, como o ID da mensagem
                echo "<p><a href='resposta.php?id=" . $row['id'] . "'>Responder</a></p>";
                
                echo "<hr>";
            }
        } else {
            echo "Nenhuma mensagem encontrada.";
        }
    } catch (PDOException $e) {
        die("Erro na execução da consulta: " . $e->getMessage());
    }

    // Fechar a conexão
    $pdo = null;
    ?>
</body>
</html>
