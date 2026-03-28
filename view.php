<?php
declare(strict_types=1);

require_once __DIR__ . '/includes/db.php';
require_once __DIR__ . '/includes/storage.php';
@session_start();

// Bu dosya PDF ve diğer dokümanları güvenli bir şekilde sunucudan tarayıcıya stream etmek için kullanılır.
// Dosyalar doğrudan URL ile değil bu endpoint üzerinden sunulur.

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($id <= 0) {
    die('Geçersiz dosya ID.');
}

$stmt = $pdo->prepare("SELECT * FROM notes WHERE id = :id");
$stmt->execute(['id' => $id]);
$note = $stmt->fetch();

if (!$note) {
    die('Not bulunamadı.');
}

$filePath = getNoteStorageDir() . $note['stored_filename'];

if (!file_exists($filePath)) {
    die('Dosya sunucuda bulunamadı.');
}

// Tarayıcıya dosya tipini bildir
header('Content-Type: ' . $note['mime_type']);
header('Content-Length: ' . filesize($filePath));

// Dosyayı oku ve gönder
readfile($filePath);
exit;
