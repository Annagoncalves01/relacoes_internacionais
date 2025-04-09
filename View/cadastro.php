<?php

session_start();

?>

<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <title>Cadastro</title>
    <link rel="stylesheet" href="style.css">
</head>

<body class="login">
    <button id="dark-mode-toggle">🌙 Alternar Modo</button>

    <div class="login-wrapper">
        <div class="logo-container">
            <img src="../img/download.png" alt="Logo" class="logo">
        </div>
        <div class="login-container">
            <div class="register-container">
                <div class="avatar"></div>
                <h2>Cadastro</h2>
                <form action="../index.php?route=registerUser" method="POST">
                    <div class="input-group">
                        <input type="text" name="name" placeholder="Nome Completo" required>
                    </div>
                    <div class="input-group">
                        <input type="email" name="email" placeholder="E-mail" required>
                    </div>
                    <div class="input-group">
                        <input type="date" name="birthdate" required>
                    </div>
                    <div class="input-group">
                        <input type="password" name="password" placeholder="Senha" required>
                    </div>
                    <button type="submit" class="register-btn">Cadastrar</button>
                </form>
                <div class="links-container">
                    <a href="../index.php?route=login" class="register-link">Já tem uma conta? Faça Login</a>
                </div>
            </div>
        </div>

        <script>
            document.addEventListener("DOMContentLoaded", function () {
                const darkModeToggle = document.getElementById("dark-mode-toggle");
                const body = document.body;

                if (localStorage.getItem("dark-mode") === "enabled") {
                    body.classList.add("dark-mode");
                }

                darkModeToggle.addEventListener("click", function () {
                    body.classList.toggle("dark-mode");
                    if (body.classList.contains("dark-mode")) {
                        localStorage.setItem("dark-mode", "enabled");
                    } else {
                        localStorage.removeItem("dark-mode");
                    }
                });
            });
        </script>
</body>

</html>