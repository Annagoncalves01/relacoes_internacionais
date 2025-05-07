<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once 'C:/Turma2/xampp/htdocs/relacoes_internacionais/Controller/UsuarioController.php';
require_once 'C:/Turma2/xampp/htdocs/relacoes_internacionais/config.php';

$usuarioController = new UsuarioController($pdo);
$usuario = $usuarioController->listarUsuarioPorID($_SESSION['user_id']);

$mensagem = null;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $email = $_POST['email'];
    $data_nascimento = $_POST['data_nascimento']; // Data de nascimento do formulário
    $sobre_mim = $_POST['sobre_mim'];

    $foto_perfil = $usuario['foto_perfil'];
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] === 0) {
        $foto_perfil = file_get_contents($_FILES['foto']['tmp_name']);
    }

    $senha = $_POST['senha'];
    if (!empty($senha)) {
        $senha = password_hash($senha, PASSWORD_DEFAULT); // Criptografa a nova senha
    } else {
        $senha = $usuario['senha']; // Mantém a senha anterior caso não tenha sido alterada
    }

    // Atualiza os dados no banco de dados
    $usuarioController->atualizar($id, $email, $senha, $data_nascimento, $sobre_mim, $foto_perfil);

    // Recarrega os dados do usuário após a atualização
    $usuario = $usuarioController->listarUsuarioPorID($_SESSION['user_id']);
    $mensagem = "Dados atualizados com sucesso!";
}

$foto_perfil = !empty($usuario['foto_perfil']) ? 'data:image/jpeg;base64,' . base64_encode($usuario['foto_perfil']) : 'img/perfil.png';
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Perfil</title>
    <link rel="stylesheet" href="/relacoes_internacionais/View/usuario/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.querySelector(".formulario").addEventListener("submit", function(e) {
                e.preventDefault();

                let formData = new FormData(this);

                fetch("/relacoes_internacionais/View/usuario/editar.php", {
                    method: "POST",
                    body: formData
                })
                .then(response => response.text())
                .then(data => {
                    // Exibe a mensagem de sucesso na mesma página
                    document.querySelector(".perfil-conteudo").innerHTML = data;
                    // Redireciona ou recarrega a página após a atualização
                    window.location.reload();  // Recarrega a página
                })
                .catch(error => console.error("Erro:", error));
            });
        });
    </script>
</head>
<body class="perfil-body">
<header class="header">
    <div class="header-logo">
        <a href="/relacoes_internacionais/site.php">
            <img src="/relacoes_internacionais/View/usuario/img/download.png" alt="Logotipo Global Pathway" style="height: 100px; max-height: 100%; object-fit: contain;">
        </a>
    </div>
    <nav class="navbar">
        <ul>
            <li><a href="../../profissao.php">Sobre a Profissão</a></li>
            <li><a href="editar.php">Sobre Mim</a></li>
            <li><a href="../teste.php">Teste de Personalidade</a></li>
        </ul>
    </nav>
    <div class="header-buttons">
        <div class="avatar">
            <img src="<?= $foto_perfil; ?>" alt="Avatar do Usuário">
        </div>
        <a href="/relacoes_internacionais/index.php" class="logout-button" title="Sair">
            <i class="fa-solid fa-right-from-bracket"></i> <span>Sair</span>
        </a>
    </div>
</header>

<div class="perfil-container">
    <div class="perfil-foto">
        <div class="perfil-imagem-circular">
            <img src="<?= $foto_perfil; ?>" alt="Foto de Perfil">
        </div>
        <label class="botao-mudar-foto" for="foto">MUDAR FOTO</label>
    </div>

    <div class="linha-vertical"></div>

    <div class="perfil-conteudo">
        <h2 class="perfil-titulo">SOBRE MIM</h2>

        <?php if ($mensagem): ?>
            <p class="mensagem-sucesso"><?= $mensagem ?></p>
        <?php endif; ?>

        <form class="formulario" action="/relacoes_internacionais/View/usuario/editar.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= $usuario['id'] ?>">
            <input type="file" name="foto" id="foto" style="display: none;">

            <label>Email:</label>
            <input type="email" name="email" value="<?= htmlspecialchars($usuario['email']) ?>">

            <label>Data de Nascimento:</label>
            <input type="date" name="data_nascimento" value="<?= htmlspecialchars($usuario['data_nascimento']) ?>">

            <!-- Exibe a senha atual como mascarado -->
            <label>Senha Atual:</label>
            <input type="password" value="********" disabled>

            <!-- Campo para a nova senha -->
            <label>Atualizar Senha:</label>
            <div class="senha-container">
                <input type="password" name="senha" id="senha" placeholder="Digite nova senha">
            </div>

            <label>Sobre Mim:</label>
            <textarea name="sobre_mim" rows="4"><?= isset($usuario['sobre_mim']) ? htmlspecialchars($usuario['sobre_mim']) : '' ?></textarea>
            <br>
            <button type="submit" class="botao-atualizar">ATUALIZAR DADOS</button>
        </form>
    </div>
</div>
<footer class="footer">
    <div class="footer-container">
        <div class="footer-col contatos">
            <h4>CONTATOS</h4>
            <p><i class="fa-solid fa-phone"></i> <span>(11) 98765-4321</span></p>
            <p><i class="fa-solid fa-envelope"></i> <span>contato@globalpathway.com</span></p>
        </div>
        <div class="footer-col logo">
            <img src="/relacoes_internacionais/View/usuario/img/download.png" alt="Logo Global Pathway" />
        </div>
        <div class="footer-col links">
            <h4>LINKS RÁPIDOS</h4>
            <ul>
            <li><a href="../../profissao.php"><i class="fa-solid fa-briefcase"></i> Sobre a Profissão</a></li>
        <li><a href="View/teste.php"><i class="fa-solid fa-brain"></i> Teste de Personalidade</a></li>
        <li><a href="View/planejamento.php"><i class="fa-solid fa-bullseye"></i> Planejamento do Futuro</a></li>
        <li><a href="View/metas.php"><i class="fa-solid fa-bullseye"></i> Estabelecendo Metas</a></li>
        <li><a href="usuario/editar.php"><i class="fa-solid fa-user"></i> Meu Perfil</a></li>
        <li><a href="/relacoes_internacionais/index.php"><i class="fa-solid fa-right-from-bracket"></i> Sair</a></li>
            </ul>
        </div>
    </div>
    <div class="footer-bottom">
        <p>&copy; <?= date("Y"); ?> Global Pathway | Anna Clara Gonçalves. Todos os direitos reservados.</p>
    </div>
</footer>

</body>
</html>
