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

    public function createUser() {
        if (!isset($_SESSION['user_id'])) { header('Location: index.php'); exit; }
        if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'Gerente') { header('Location: index.php?route=dashboard'); exit; }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = trim($_POST['username'] ?? '');
            $password = trim($_POST['password'] ?? '');
            $role = trim($_POST['role'] ?? '');

            if ($username === '' || $password === '' || $role === '') {
                $error = "Completa todos los campos";
                require __DIR__ . '/../Views/auth/create_user.php';
                return;
            }

            try {
                $ok = User::create($username, $password, $role);
                if ($ok) {
                    $success = "Usuario creado correctamente";
                } else {
                    $error = "No se pudo crear el usuario";
                }
            } catch (\Throwable $e) {
                $error = "Usuario ya existe o datos inválidos";
            }

            require __DIR__ . '/../Views/auth/create_user.php';
        } else {
            require __DIR__ . '/../Views/auth/create_user.php';
        }
    }
}