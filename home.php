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
<html>
<head>
    <title>studyConnect</title>
</head>
<body>
    <h1>StudyConnect</h1>

    <form method="POST" action="salvar_mensagem.php">
       

        <label for="mensagem">Escreva seu texto:</label>
        <textarea name="mensagem" id="mensagem" required></textarea><br>

        <input type="submit" value="Enviar">
    </form>
</body>
</html>


<?php
// Consulta SQL com junção entre as tabelas
$sql = "SELECT mensagem, data_publicacao, use_name
        FROM mensagens 
        JOIN user ON user_id = use_id 
        ORDER BY data_publicacao DESC";

try {
    // Preparar e executar a consulta
    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    // Exibir as mensagens
    if ($stmt->rowCount() > 0) {
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<p><strong>" . $row['use_name'] . "</strong></p>";
            echo "<p>" . $row['mensagem'] . "</p>";
            echo "<p>Data de Publicação: " . $row['data_publicacao'] . "</p>";
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