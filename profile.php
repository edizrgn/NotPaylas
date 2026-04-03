<?php
declare(strict_types=1);

require_once __DIR__ . '/includes/db.php';
@session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$userId = (int)$_SESSION['user_id'];

$stmt = $pdo->prepare("SELECT id, first_name, last_name, email, created_at, verified FROM users WHERE id = :id");
$stmt->execute(['id' => $userId]);
$user = $stmt->fetch();

if (!$user) {
    session_destroy();
    header('Location: login.php');
    exit;
}

// Get note count
$stmtNotes = $pdo->prepare("SELECT COUNT(*) as note_count FROM notes WHERE user_id = :uid");
$stmtNotes->execute(['uid' => $userId]);
$noteCount = (int) $stmtNotes->fetch()['note_count'];

$pageTitle = 'Not Bul | Profilim';
$pageKey = 'profile';
require __DIR__ . '/includes/header.php';
?>
<main class="page-shell">
    <section class="container section-block mt-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="panel-card">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h1 class="h3 mb-0">Profil Bilgileri</h1>
                        <a href="profile_edit.php" class="btn btn-sm btn-outline-primary"><i class="fa-solid fa-pen"></i> Düzenle</a>
                    </div>
                    
                    <div class="card shadow-sm border-0 bg-light">
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-sm-3 text-secondary">
                                    <i class="fa-solid fa-user me-2"></i>Ad Soyad
                                </div>
                                <div class="col-sm-9 text-dark fw-medium">
                                    <?= htmlspecialchars($user['first_name'] . ' ' . $user['last_name']) ?>
                                </div>
                            </div>
                            <hr class="text-muted">
                            <div class="row mb-3">
                                <div class="col-sm-3 text-secondary">
                                    <i class="fa-solid fa-envelope me-2"></i>E-posta
                                </div>
                                <div class="col-sm-9 text-dark fw-medium">
                                    <?= htmlspecialchars($user['email']) ?>
                                    <?php if ((int)$user['verified'] === 1): ?>
                                        <span class="badge bg-success ms-2"><i class="fa-solid fa-check-circle"></i> Doğrulanmış</span>
                                    <?php else: ?>
                                        <span class="badge bg-warning text-dark ms-2"><i class="fa-solid fa-clock"></i> Doğrulanmamış</span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <hr class="text-muted">
                            <div class="row mb-3">
                                <div class="col-sm-3 text-secondary">
                                    <i class="fa-solid fa-calendar-days me-2"></i>Kayıt Tarihi
                                </div>
                                <div class="col-sm-9 text-dark fw-medium">
                                    <?= htmlspecialchars(date('d.m.Y H:i', strtotime($user['created_at']))) ?>
                                </div>
                            </div>
                            <hr class="text-muted">
                            <div class="row">
                                <div class="col-sm-3 text-secondary">
                                    <i class="fa-solid fa-file-lines me-2"></i>Yüklenen Notlar
                                </div>
                                <div class="col-sm-9 text-dark fw-medium">
                                    <?= $noteCount ?> adet not yüklendi.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
<?php require __DIR__ . '/includes/footer.php'; ?>
