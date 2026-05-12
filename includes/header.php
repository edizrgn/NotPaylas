<?php
declare(strict_types=1);
@session_start();

$pageTitle = $pageTitle ?? 'Not Bul';
$pageKey = $pageKey ?? 'home';
$navItems = [
    ['key' => 'search', 'label' => 'Ders Notu Bul', 'href' => 'search.php'],
    ['key' => 'upload', 'label' => 'Not Yükle', 'href' => 'upload.php'],
];
?>
<!doctype html>
<html lang="tr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= htmlspecialchars($pageTitle, ENT_QUOTES, 'UTF-8'); ?></title>
    <link rel="icon" type="image/svg+xml" href="assets/icons/favicon.svg">
    <link rel="shortcut icon" href="assets/icons/favicon.svg">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer">
    <link rel="stylesheet" href="assets/css/app.css">
</head>
<body data-page="<?= htmlspecialchars($pageKey, ENT_QUOTES, 'UTF-8'); ?>">
<header class="site-header">
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light py-2">
            <a class="navbar-brand brand-mark" href="index.php">
                <i class="fa-solid fa-book-open-reader brand-icon" aria-hidden="true"></i>
                <span>Not Bul</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav" aria-controls="mainNav" aria-expanded="false" aria-label="Navigasyonu Aç">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="mainNav">
                <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-2 me-lg-2">
                    <?php foreach ($navItems as $item): ?>
                        <li class="nav-item">
                            <a class="nav-link top-link <?= $pageKey === $item['key'] ? 'active' : ''; ?>" href="<?= htmlspecialchars($item['href'], ENT_QUOTES, 'UTF-8'); ?>">
                                <?= htmlspecialchars($item['label'], ENT_QUOTES, 'UTF-8'); ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
                <div class="d-flex gap-2 auth-actions">
                    <?php if (isset($_SESSION['user_id'])): ?>
                        <?php
                            $currentFirstName = trim((string)($_SESSION['first_name'] ?? ''));
                            $displayFirstName = $currentFirstName !== '' ? $currentFirstName : 'Hesabım';
                            $userInitial = mb_strtoupper(mb_substr($displayFirstName, 0, 1, 'UTF-8'), 'UTF-8');
                        ?>
                        <div class="user-quickbar" aria-label="Kullanıcı işlemleri">
                            <a class="user-chip <?= $pageKey === 'profile' ? 'active' : ''; ?>" href="profile.php" aria-label="Profilim">
                                <span class="user-avatar" aria-hidden="true"><?= htmlspecialchars($userInitial, ENT_QUOTES, 'UTF-8') ?></span>
                                <span class="user-chip-copy">
                                    <span class="user-chip-label">Profilim</span>
                                    <span class="user-chip-name"><?= htmlspecialchars($displayFirstName, ENT_QUOTES, 'UTF-8') ?></span>
                                </span>
                            </a>
                            <?php if (($_SESSION['role'] ?? 'user') === 'admin'): ?>
                                <a class="header-action-btn <?= $pageKey === 'admin' ? 'active' : ''; ?>" href="admin.php" title="Admin Paneli" aria-label="Admin Paneli">
                                    <i class="fa-solid fa-gauge-high" aria-hidden="true"></i>
                                </a>
                            <?php endif; ?>
                            <a class="header-action-btn" href="profile_edit.php" title="Profili Düzenle" aria-label="Profili Düzenle">
                                <i class="fa-solid fa-user-pen" aria-hidden="true"></i>
                            </a>
                            <a class="header-action-btn header-action-danger" href="logout.php" title="Çıkış Yap" aria-label="Çıkış Yap">
                                <i class="fa-solid fa-right-from-bracket" aria-hidden="true"></i>
                            </a>
                        </div>
                    <?php else: ?>
                        <a class="btn btn-sm btn-outline-primary" href="login.php">Giriş Yap</a>
                        <a class="btn btn-sm btn-primary" href="register.php">Kayıt Ol</a>
                    <?php endif; ?>
                </div>
            </div>
        </nav>
    </div>
</header>
