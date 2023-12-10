<?php 
session_start();
include_once 'connection.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="register.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
<body>
    <header>
        <h1>Register User</h1>
    </header>
    <main>
        <?php 
            $data = filter_input_array(INPUT_POST, FILTER_DEFAULT);

            if (!empty($data['sendRegisterUser'])) {
                // Verifica se a senha e a confirmação de senha coincidem
                if ($data['use_password'] !== $data['confirm_password']) {
                    echo "<p>As senhas não coincidem</p>";
                } else {
                    $selectUserQuery = "INSERT INTO user (use_name, use_email, use_password, use_periodo) VALUES (:use_name, :use_email, :use_password, :use_periodo)";

                    $registerUser = $pdo->prepare($selectUserQuery);
                    
                    $registerUser->bindParam(':use_name', $data['use_name']);
                    $registerUser->bindParam(':use_email', $data['use_email']);
                    $registerUser->bindParam(':use_periodo', $data['use_periodo']);
                    
                    $passwordCript = password_hash($data['use_password'], PASSWORD_DEFAULT);
                    $registerUser->bindParam(':use_password', $passwordCript);
                    $registerUser->execute();

                    if ($registerUser->rowCount()) {
                        header("Location: index.php");
                        // $_SESSION['msg'] = "<p> User registered successfully </p>";
                    } else {
                        echo "User has not been registered";
                    }
                }
            }
        ?>

    <main>
        <section class="NavBar">
            <a href="#">Blog</a>
            <a href="#">Sobre</a>
            <a href="#">Linguagens</a>
            <a href="login.php">Login</a>
            <a href="register.php">Register</a>
        </section>    
    </main>

        <form action="" method="POST">
            <label>Name:</label>
            <input type="text" minlength="3" required name="use_name" placeholder="Name">
            <label>Email:</label>
            <input type="text" required name="use_email" placeholder="Email">
            <label>Password:</label>
            <input type="password" minlength="8" maxlength="20" required name="use_password" placeholder="Password">
            <label>Confirm Password:</label>
            <input type="password" minlength="8" maxlength="20" required name="confirm_password" placeholder="Confirm Password">
            <label for="lista-itens">Qual o seu periodo?</label>
            <select id="lista-itens" name="use_periodo" placeholder="Periodo">
                <option value="1 Periodo">1 Periodo</option>
                <option value="2 Periodo">2 Periodo</option>
                <option value="3 Periodo">3 Periodo</option>
                <option value="4 Periodo">4 Periodo</option>
                <option value="5 Periodo">5 Periodo</option>
                <option value="6 Periodo">6 Periodo</option>
                <option value="7 Periodo">7 Periodo</option>
                <option value="8 Periodo">8 Periodo</option>
                <option value="9 Periodo">9 Periodo</option>
                <option value="10 Periodo">10 Periodo</option>
            </select>
            <br>
            <br>
            <input type="submit" name="sendRegisterUser" value="Register">
            
        </form>

        <a href="index.php">Index</a>
    </main>
    <footer>
       &copy; 2023 StudyConnect
    </footer>
</body>
</html>
