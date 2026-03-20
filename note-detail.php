<?php
declare(strict_types=1);
$pageTitle = 'Not Bul | Not Detayı';
$pageKey = 'detail';
require __DIR__ . '/includes/header.php';
?>
<main class="page-shell">
    <section class="container section-block">
        <p class="text-secondary small mb-3">Anasayfa > Calculus 101 - Fonksiyonlar</p>
        <div class="row g-4">
            <div class="col-lg-7">
                <div class="preview-shell">
                    <div class="preview-toolbar d-flex justify-content-between align-items-center">
                        <strong>Dosya Önizleme</strong>
                        <span class="badge text-bg-info">PDF Önizleme Alanı</span>
                    </div>
                    <div class="preview-canvas">
                        <p class="mb-2 fw-semibold">Dosya yüklenince bu alanda PDF/içerik önizleme gösterilecek.</p>
                        <p class="mb-0 text-secondary">Backend bağlantısı tamamlandığında güvenli dosya stream endpoint'i ile görüntülenecek.</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-5">
                <article class="panel-card h-100">
                    <h1 class="section-title mb-2">Veri Yapıları - Final Hazırlık Notları</h1>
                    <p class="text-secondary">Ağaç yapıları, hash tablolar ve sıklıkla gelen final sorularının açıklamalı çözümü.</p>

                    <div class="note-meta-grid">
                        <div><span>Yükleyen</span><strong>Ahmet Yılmaz</strong></div>
                        <div><span>Üniversite</span><strong>İstanbul Teknik Üniversitesi</strong></div>
                        <div><span>Bölüm</span><strong>Bilgisayar Mühendisliği</strong></div>
                        <div><span>Sınıf</span><strong>2. Sınıf</strong></div>
                        <div><span>Görüntülenme</span><strong>4.982</strong></div>
                        <div><span>İndirme</span><strong>1.364</strong></div>
                    </div>

                    <div class="mt-3 d-flex flex-wrap gap-2">
                        <span class="badge rounded-pill text-bg-light">#final</span>
                        <span class="badge rounded-pill text-bg-light">#algoritma</span>
                        <span class="badge rounded-pill text-bg-light">#çıkmış-soru</span>
                    </div>

                    <div class="mt-4 d-grid gap-2 d-md-flex">
                        <a class="btn btn-primary btn-lg" href="#" role="button">İndir</a>
                        <a class="btn btn-outline-primary btn-lg" href="search.php">Benzer Notlar</a>
                    </div>
                </article>
            </div>
        </div>
    </section>

    <section class="container section-block pb-5">
        <div class="panel-card">
            <h2 class="section-title mb-3">Yorumlar</h2>
            <div id="commentsList" class="comment-list">
                <article class="comment-item">
                    <header>
                        <strong>Zeynep</strong> <span class="text-secondary">| 5/5</span>
                    </header>
                    <p class="mb-0">Özellikle final öncesi çok faydalı oldu. Teşekkürler.</p>
                </article>
                <article class="comment-item">
                    <header>
                        <strong>Can</strong> <span class="text-secondary">| 4/5</span>
                    </header>
                    <p class="mb-0">Örnek soru çözümü sayısı artarsa daha da iyi olur.</p>
                </article>
            </div>

            <form id="commentForm" class="mt-4">
                <div class="row g-3">
                    <div class="col-md-3">
                        <label class="form-label" for="commentAuthor">Adın</label>
                        <input class="form-control" id="commentAuthor" maxlength="70" required>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label" for="commentRating">Puan</label>
                        <select class="form-select" id="commentRating" required>
                            <option value="5">5 - Çok iyi</option>
                            <option value="4">4 - İyi</option>
                            <option value="3">3 - Orta</option>
                            <option value="2">2 - Geliştirilmeli</option>
                            <option value="1">1 - Zayıf</option>
                        </select>
                    </div>
                    <div class="col-12">
                        <label class="form-label" for="commentText">Yorum</label>
                        <textarea class="form-control" id="commentText" rows="3" maxlength="700" required></textarea>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">Yorum Ekle</button>
                    </div>
                </div>
            </form>
        </div>
    </section>
</main>
<?php require __DIR__ . '/includes/footer.php'; ?>

