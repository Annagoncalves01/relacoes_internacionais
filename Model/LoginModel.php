<?php
class UserModel
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function register($name, $email, $password, $birthdate)
    {
        $sql = "SELECT COUNT(*) FROM users WHERE email = :email";
        $stmt = $this->pdo->prepare($sql);

        $stmt->bindParam(':email', $email);
        $stmt->execute();

        $existe = $stmt->fetchColumn();

        if ($existe == 1) {
            $_SESSION['erro'] = "Email já cadastrado";
            return false;
        } else {
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
            $stmt = $this->pdo->prepare("INSERT INTO users (nome, email, senha, data_nascimento	) VALUES (:name, :email, :password, :birthdate)");
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $hashedPassword);
            $stmt->bindParam(':birthdate', $birthdate);
            return $stmt->execute();
        }
    }

    public function login($email, $password)
    {
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

    public function changePasswordWithEmail($email, $newPassword)
    {
        $newPassword = password_hash($newPassword, PASSWORD_BCRYPT);
        $stmt = $this->pdo->prepare("UPDATE users SET senha = :senha WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':senha', $newPassword);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
