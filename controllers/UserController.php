<?php
require_once __DIR__ . '/../mdl/UserModel.php';

class UserController {
    private UserModel $model;

    public function __construct(UserModel $model) {
        $this->model = $model;
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function showLogin(): void {
        $page_title = 'Login';
        ob_start();
        include __DIR__ . '/../pages/login.php';
        $content = ob_get_clean();
        include __DIR__ . '/../templates/base.php';
    }

    public function showRegister(): void {
        $page_title = 'Register';
        ob_start();
        include __DIR__ . '/../pages/register.php';
        $content = ob_get_clean();
        include __DIR__ . '/../templates/base.php';
    }

    public function register(): void {
        $data = [
            'full_name' => trim($_POST['full_name'] ?? ''),
            'email' => trim($_POST['email'] ?? ''),
            'phone' => trim($_POST['phone'] ?? ''),
            'password' => $_POST['password'] ?? '',
            'type' => trim($_POST['type'] ?? ''),
            'is_active' => isset($_POST['is_active']) ? 1 : 0,
        ];
        if ($data['full_name'] === '' || $data['email'] === '' || $data['password'] === '') {
            $_SESSION['error'] = 'Required fields missing';
            header('Location: index.php?route=register');
            exit;
        }
        $this->model->create($data);
        header('Location: index.php?route=login');
        exit;
    }

    public function login(): void {
        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';
        if ($email === '' || $password === '') {
            $_SESSION['error'] = 'Invalid credentials';
            header('Location: index.php?route=login');
            exit;
        }
        $user = $this->model->findByEmail($email);
        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user'] = $user;
            header('Location: index.php');
            exit;
        }
        $_SESSION['error'] = 'Invalid credentials';
        header('Location: index.php?route=login');
        exit;
    }
}
