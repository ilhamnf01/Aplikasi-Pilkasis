<?php
require_once __DIR__ . '/../models/User.php';

class AuthController
{
    private $userModel;

    public function __construct()
    {
        $this->userModel = new User();
    }

    public function login($data)
    {
        $username = $data['username'] ?? '';
        $password = $data['password'] ?? '';
        $user = $this->userModel->findByUsername($username);
        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user'] = [
                'id' => $user['id_user'],
                'username' => $user['username'],
                'role' => $user['role'],
            ];
            header('Location: /pilkasis');
            return;
        }
        $_SESSION['flash'] = 'Login gagal. Periksa username/password.';
        header('Location: /pilkasis');
    }

    public function logout()
    {
        session_unset();
        session_destroy();
        header('Location: /pilkasis');
    }
}
