<?php

session_start();



?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Redefinir Senha</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="login">
<button id="dark-mode-toggle">🌙 Alternar Modo</button>

<div class="login-wrapper">
        <div class="logo-container">
            <img src="../img/download.png" alt="Logo" class="logo">
        </div>
<div class="login-container">
<div class="avatare"></div>
    <div class="forgot-password-container">
        <h2>Redefinir Senha</h2>
        <form action="../index.php?route=resetPassword" method="POST">
            <div class="input-group">
                <input type="email" name="email" placeholder="Digite seu e-mail" required>
            </div>
            <div class="input-group">
                <input type="password" name="newPassword" placeholder="Nova senha" required>
            </div>
            <button type="submit" class="register-btn">Redefinir Senha</button>
        </form>
        <a href="../index.php" class="register-link">Voltar ao Login</a>
    </div>
    </div>
         
    
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const darkModeToggle = document.getElementById("dark-mode-toggle");
            const body = document.body;
            
            // Verificar se há preferência salva
            if (localStorage.getItem("dark-mode") === "enabled") {
                body.classList.add("dark-mode");
            }
            
            darkModeToggle.addEventListener("click", function() {
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
