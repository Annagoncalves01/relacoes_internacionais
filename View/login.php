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
    <style>
        .input-group {
            position: relative;
            width: 100%;
        }

        .input-group input {
            width: 100%;
            padding: 10px;
            padding-right: -25%; /* Ajuste o valor para dar espaço ao ícone */
            box-sizing: border-box;
        }

        #togglePassword {
            position: absolute;
            top: 50%;
            right: -25%; /* Coloca o ícone à direita do campo */
            transform: translateY(-50%); /* Alinha verticalmente */
            background: none;
            margin-top: -2%;
            border: none;
            cursor: pointer;
            font-size: 18px;
            color: #555;
        }
    </style>
</head>

<body class="login">

    <button id="dark-mode-toggle">🌙 Alternar Modo</button>

    <div class="login-wrapper">
        <div class="logo-container">
            <img src="img/download.png" alt="Logo" class="logo">
        </div>
        <div class="login-container">
            <div class="avatar"></div>

            <!-- Mensagens de erro ou sucesso -->
            <?php if (isset($_SESSION['erro'])): ?>
                <div class="message error"><?php echo $_SESSION['erro']; unset($_SESSION['erro']); ?></div>
            <?php endif; ?>

            <?php if (isset($_SESSION['success'])): ?>
                <div class="message success"><?php echo $_SESSION['success']; unset($_SESSION['success']); ?></div>
            <?php endif; ?>

            <form action="index.php" method="POST">
                <div class="input-group">
                    <input type="email" id="email" name="email" placeholder="E-mail" required>
                </div>
                <div class="input-group">
                    <input type="password" id="password" name="password" placeholder="Senha" required>
                    <button type="button" id="togglePassword">👁️</button>
                </div>
                <button type="submit" class="login-btn">Entrar</button>
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

            const togglePassword = document.getElementById("togglePassword");
            const passwordField = document.getElementById("password");

            togglePassword.addEventListener("click", function () {
                const type = passwordField.getAttribute("type") === "password" ? "text" : "password";
                passwordField.setAttribute("type", type);
                this.textContent = type === "password" ? "👁️" : "👁️‍🗨️";
            });
        });
    </script>

</body>

</html>
