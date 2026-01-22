<?php
namespace App\Controllers;
use App\Models\User;

class AuthController {
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user = User::login($_POST['username'], $_POST['password']);
            if ($user) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['role'] = $user['role'];
                header('Location: index.php?route=dashboard');
                exit;
            } else {
                $error = "Credenciales incorrectas";
                require __DIR__ . '/../Views/auth/login.php';
            }
        } else {
            require __DIR__ . '/../Views/auth/login.php';
        }
    }

    public function logout() {
        session_destroy();
        header('Location: index.php');
    }
}