<?php
require_once 'User.php';

class Admin extends User {
    public function __construct($db) {
        parent::__construct($db);
        $this->role = 'admin';
    }

    public function login() {
        $query = "SELECT id_user, username, password FROM users WHERE username = :username AND role = 'admin'";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':username', $this->username);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if (password_verify($this->password, $row['password'])) {
                $this->id = $row['id_user'];
                return true;
            }
        }
        return false;
    }

    public function create() {
        $query = "INSERT INTO users SET username=:username, password=:password, role=:role";
        $stmt = $this->conn->prepare($query);
        $this->username = htmlspecialchars(strip_tags($this->username));
        $hashed_password = password_hash($this->password, PASSWORD_DEFAULT);
        $stmt->bindParam(':username', $this->username);
        $stmt->bindParam(':password', $hashed_password);
        $stmt->bindParam(':role', $this->role);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}
?>
