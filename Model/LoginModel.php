<?php
class UserModel {
    private $pdo;
    
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function register($name, $email, $password, $birthdate) {
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $stmt = $this->pdo->prepare("INSERT INTO users (nome, email, senha, nascimento) VALUES (:name, :email, :password, :birthdate)");
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $hashedPassword);
        $stmt->bindParam(':birthdate', $birthdate);
        return $stmt->execute();
    }

    public function login($email, $password) {
        $stmt = $this->pdo->prepare("SELECT id, senha FROM users WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['senha'])) {
            $_SESSION['user_id'] = $user['id'];
            return true;
        }
        return false;
    }

    public function sendResetLink($email) {
        $token = bin2hex(random_bytes(50));
        $stmt = $this->pdo->prepare("UPDATE users SET reset_token = :token WHERE email = :email");
        $stmt->bindParam(':token', $token);
        $stmt->bindParam(':email', $email);

        if ($stmt->execute()) {
            mail($email, "Redefinição de Senha", "Clique no link para redefinir: http://localhost/reset.php?token=$token");
            return true;
        }
        return false;
    }
}
