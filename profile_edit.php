<?php
declare(strict_types=1);

require_once __DIR__ . '/includes/db.php';
@session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$userId = (int)$_SESSION['user_id'];
$success = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $firstName = trim($_POST['first_name'] ?? '');
    $lastName = trim($_POST['last_name'] ?? '');

    if (empty($firstName) || empty($lastName)) {
        $error = 'Ad ve Soyad alanları boş bırakılamaz.';
    } else {
        try {
            $stmt = $pdo->prepare("UPDATE users SET first_name = :fname, last_name = :lname WHERE id = :uid");
            $stmt->execute([
                'fname' => $firstName,
                'lname' => $lastName,
                'uid' => $userId
            ]);
            
            $_SESSION['first_name'] = $firstName;
            $_SESSION['last_name'] = $lastName;
            $success = 'Profil bilgileriniz başarıyla güncellendi.';
        } catch (PDOException $e) {
            $error = 'Güncelleme sırasında bir hata oluştu: ' . $e->getMessage();
        }
    }
}

$stmt = $pdo->prepare("SELECT id, first_name, last_name, email FROM users WHERE id = :id");
$stmt->execute(['id' => $userId]);
$user = $stmt->fetch();

if (!$user) {
    session_destroy();
    header('Location: login.php');
    exit;
}

$pageTitle = 'Not Bul | Profili Düzenle';
$pageKey = 'profile_edit';
require __DIR__ . '/includes/header.php';
?>
<main class="page-shell">
    <section class="container section-block mt-5">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="panel-card">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h1 class="h3 mb-0">Profili Düzenle</h1>
                        <a href="profile.php" class="btn btn-sm btn-outline-secondary"><i class="fa-solid fa-arrow-left"></i> Geri Dön</a>
                    </div>
                    
                    <?php if ($error): ?>
                        <div class="alert alert-danger" role="alert"><?= htmlspecialchars($error) ?></div>
                    <?php endif; ?>
                    <?php if ($success): ?>
                        <div class="alert alert-success" role="alert"><?= htmlspecialchars($success) ?></div>
                    <?php endif; ?>

                    <form action="profile_edit.php" method="POST">
                        <div class="mb-3">
                            <label for="first_name" class="form-label">Ad</label>
                            <input type="text" class="form-control" id="first_name" name="first_name" value="<?= htmlspecialchars($user['first_name']) ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="last_name" class="form-label">Soyad</label>
                            <input type="text" class="form-control" id="last_name" name="last_name" value="<?= htmlspecialchars($user['last_name']) ?>" required>
                        </div>
                        <div class="mb-4">
                            <label for="email" class="form-label">E-posta</label>
                            <input type="email" class="form-control text-muted" id="email" value="<?= htmlspecialchars($user['email']) ?>" readonly disabled>
                            <div class="form-text">E-posta adresi değiştirilemez.</div>
                        </div>
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary"><i class="fa-solid fa-save"></i> Değişiklikleri Kaydet</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</main>
<?php require __DIR__ . '/includes/footer.php'; ?>
