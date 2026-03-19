<?php
declare(strict_types=1);

$requestUri = $_SERVER['REQUEST_URI'] ?? '/';
$path = parse_url($requestUri, PHP_URL_PATH) ?: '/';
$path = rtrim($path, '/');
$path = $path === '' ? '/' : $path;

$projectRoot = dirname(__DIR__);
$routes = [
    '/' => $projectRoot . '/index.php',
    '/index.php' => $projectRoot . '/index.php',
    '/upload' => $projectRoot . '/upload.php',
    '/upload.php' => $projectRoot . '/upload.php',
    '/search' => $projectRoot . '/search.php',
    '/search.php' => $projectRoot . '/search.php',
    '/note-detail' => $projectRoot . '/note-detail.php',
    '/note-detail.php' => $projectRoot . '/note-detail.php',
];

if (isset($routes[$path])) {
    require $routes[$path];
    return;
}

http_response_code(404);
header('Content-Type: text/html; charset=UTF-8');
echo '<!doctype html><html lang="tr"><head><meta charset="UTF-8"><title>404</title></head><body>';
echo '<h1>404 - Sayfa bulunamadi</h1>';
echo '<p>Istenen yol: ' . htmlspecialchars($path, ENT_QUOTES, 'UTF-8') . '</p>';
echo '</body></html>';
