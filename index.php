<?php 
session_start();
include_once 'connection.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="indexx.css">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StudyConect</title>
</head>
<body>
    <header>
        <h1>StudyConect</h1>
    </header>
    <main>
        <section class="NavBar">
            <a href="#">Blog</a>
            <a href="#">Sobre</a>
            <a href="#">Linguagens</a>
            <a href="login.php">Login</a>
            <a href="register.php">Register</a>
        </section>    
    </main>
    <footer>
    &copy; 2023 StudyConect
    </footer>
</body>
</html>