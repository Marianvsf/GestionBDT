<?php
namespace App\Controllers;
use App\Models\User;

class AuthController {
    private const DEPARTMENTS = [
        'Recursos Humanos',
        'Operaciones',
        'Gestión de Riesgos',
        'Finanzas y Contabilidad',
        'Tecnología de la Información (TI)',
        'Auditoría Interna',
        'Cumplimiento',
        'Marketing y Comunicaciones',
        'Atención al Cliente',
        'Banca Minorista',
        'Banca Corporativa',
        'Banca de Inversión',
        'Tesorería',
        'Análisis de Crédito',
        'Cobranzas',
        'Departamento Legal',
    ];

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

        $departments = self::DEPARTMENTS;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = trim($_POST['username'] ?? '');
            $password = trim($_POST['password'] ?? '');
            $role = trim($_POST['role'] ?? '');
            $department = trim($_POST['department'] ?? '');

            if ($username === '' || $password === '' || $role === '' || $department === '') {
                $error = "Completa todos los campos";
                require __DIR__ . '/../Views/auth/create_user.php';
                return;
            }

            if (!in_array($department, $departments, true)) {
                $error = "Selecciona un departamento válido";
                require __DIR__ . '/../Views/auth/create_user.php';
                return;
            }

            if (!preg_match('/^(?=.*[A-Za-z])(?=.*\d).{8,}$/', $password)) {
                $error = "La contraseña debe tener al menos 8 caracteres y contener letras y números.";
                require __DIR__ . '/../Views/auth/create_user.php';
                return; 
            }

            try {
                $ok = User::create($username, $password, $role, $department);
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

    public function users() {
        if (!isset($_SESSION['user_id'])) { header('Location: index.php'); exit; }
        if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'Gerente') { header('Location: index.php?route=dashboard'); exit; }

        $users = User::getAll();
        $flashError = $_SESSION['user_error'] ?? null;
        $flashSuccess = $_SESSION['user_success'] ?? null;
        unset($_SESSION['user_error'], $_SESSION['user_success']);

        require __DIR__ . '/../Views/auth/list_users.php';
    }

    public function editUser() {
        if (!isset($_SESSION['user_id'])) { header('Location: index.php'); exit; }
        if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'Gerente') { header('Location: index.php?route=dashboard'); exit; }

        $departments = self::DEPARTMENTS;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userId = intval($_POST['user_id'] ?? 0);
            $username = trim($_POST['username'] ?? '');
            $role = trim($_POST['role'] ?? '');
            $department = trim($_POST['department'] ?? '');
            $password = trim($_POST['password'] ?? '');

            if ($userId <= 0 || $username === '' || $role === '' || $department === '') {
                $error = "Completa todos los campos requeridos";
                $user = User::getById($userId);
                require __DIR__ . '/../Views/auth/edit_user.php';
                return;
            }

            if (!in_array($department, $departments, true)) {
                $error = "Selecciona un departamento válido";
                $user = User::getById($userId);
                require __DIR__ . '/../Views/auth/edit_user.php';
                return;
            }

            if ($password !== '') {
                if (!preg_match('/^(?=.*[A-Za-z])(?=.*\d).{8,}$/', $password)) {
                    $error = "La nueva contraseña debe tener al menos 8 caracteres y contener letras y números.";
                    $user = User::getById($userId);
                    require __DIR__ . '/../Views/auth/edit_user.php';
                    return;
                }
            }

            try {
                $ok = User::update($userId, $username, $role, $department, $password === '' ? null : $password);
                if ($ok) {
                    $_SESSION['user_success'] = "Usuario actualizado correctamente";
                } else {
                    $_SESSION['user_error'] = "No se pudo actualizar el usuario";
                }
            } catch (\Throwable $e) {
                $_SESSION['user_error'] = "Usuario ya existe o datos inválidos";
            }

            header('Location: index.php?route=users');
            exit;
        } else {
            $userId = intval($_GET['id'] ?? 0);
            if ($userId <= 0) { header('Location: index.php?route=users'); exit; }
            $user = User::getById($userId);
            if (!$user) { $_SESSION['user_error'] = "Usuario no encontrado"; header('Location: index.php?route=users'); exit; }
            require __DIR__ . '/../Views/auth/edit_user.php';
        }
    }

    public function deleteUser() {
        if (!isset($_SESSION['user_id'])) { header('Location: index.php'); exit; }
        if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'Gerente') { header('Location: index.php?route=dashboard'); exit; }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userId = intval($_POST['user_id'] ?? 0);
            if ($userId > 0) {
                if ($userId === intval($_SESSION['user_id'])) {
                    $_SESSION['user_error'] = "No puedes eliminar tu propio usuario";
                } else {
                    User::deleteById($userId);
                    $_SESSION['user_success'] = "Usuario eliminado correctamente";
                }
            }
        }
        header('Location: index.php?route=users');
        exit;
    }
}