<?php
// Simple PHP router for SPA

$page = isset($_GET['page']) ? $_GET['page'] : 'home';

$allowed_pages = [
    'home'
    'login',
];

if (!in_array($page, $allowed_pages)) {
    http_response_code(404);
    $page = 'home'; // fallback to home
}

include __DIR__ . '/pages/' . $page . '.php';
?>
