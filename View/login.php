<?php

session_start();



?>

<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="View/style.css">
</head>

<body class="login">

    <button id="dark-mode-toggle">🌙 Alternar Modo</button>

    <div class="login-wrapper">
        <div class="logo-container">
            <img src="img/download.png" alt="Logo" class="logo">
        </div>
        <div class="login-container">
            <div class="avatar"></div>
            <form action="index.php?route=login" method="POST">
                <div class="input-group">
                    <input type="email" id="email" name="email" placeholder="E-mail" required>
                </div>
                <div class="input-group">
                    <input type="password" id="password" name="password" placeholder="Senha" required>
                </div>
                <button type="submit" class="login-btn">
                    Entrar
                </button>

            </form>
            <div class="links-container">
                <a href="View/esquecisenha.php" class="forgot-password">Esqueceu a senha?</a>
                <span class="divider">|</span>
                <a href="View/cadastro.php" class="register-link">Não tem uma conta? Cadastre-se</a>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const darkModeToggle = document.getElementById("dark-mode-toggle");
            const body = document.body;

            // Verificar se há preferência salva
            if (localStorage.getItem("dark-mode") === "enabled") {
                body.classList.add("dark-mode");
            }

            darkModeToggle.addEventListener("click", function () {
                body.classList.toggle("dark-mode");

                // Salvar a preferência do usuário
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