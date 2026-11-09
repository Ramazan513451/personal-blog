<?php
/**
 * blog-post.php — Tekil Blog Yazısı
 * Ramazan Vural · Antigravity Blog & Portfolyo
 *
 * URL: blog-post.php?slug=yazi-slug-i
 */

require_once 'config.php';
require_once 'includes/blog-data.php';

// ─── Slug'a göre yazıyı bul ───────────────────────────────────────────────────
$slug = isset($_GET['slug']) ? htmlspecialchars(trim($_GET['slug'])) : '';
$post = get_post_by_slug($slug, $blog_posts);

// Bulunamazsa blog listesine yönlendir
if (!$post) {
    header('Location: blog.php');
    exit;
}

$page_title = $post['title'];

// Önceki / Sonraki yazıyı bul
$post_keys  = array_keys($blog_posts);
$post_index = null;
foreach ($blog_posts as $i => $p) {
    if ($p['slug'] === $slug) { $post_index = $i; break; }
}
$prev_post = ($post_index !== null && $post_index > 0)
    ? $blog_posts[$post_index - 1]
    : null;
$next_post = ($post_index !== null && $post_index < count($blog_posts) - 1)
    ? $blog_posts[$post_index + 1]
    : null;

include 'includes/header.php';
?>

<!-- ══════════════════════════════════════════════════════
     SAYFA HERO
     ══════════════════════════════════════════════════════ -->
<div class="page-hero" role="banner">
    <div class="container">

        <!-- Breadcrumb -->
        <nav class="breadcrumb" aria-label="Sayfa konumu">
            <a href="index.php">Ana Sayfa</a>
            <span class="breadcrumb-sep" aria-hidden="true">›</span>
            <a href="blog.php">Blog</a>
            <span class="breadcrumb-sep" aria-hidden="true">›</span>
            <span class="breadcrumb-current"><?= htmlspecialchars($post['title']) ?></span>
        </nav>

    </div>
</div>

<!-- ══════════════════════════════════════════════════════
     YAZI İÇERİĞİ
     ══════════════════════════════════════════════════════ -->
<main class="container" id="main-content">
    <div class="post-layout">

        <!-- Ana İçerik -->
        <article class="post-content reveal-on-scroll" aria-labelledby="post-title">

            <!-- Yazı Başlığı -->
            <header class="post-header">
                <span class="post-header-icon" aria-hidden="true"><?= $post['icon'] ?></span>

                <h1 class="post-header-title" id="post-title">
                    <?= htmlspecialchars($post['title']) ?>
                </h1>

                <!-- Meta bilgiler -->
                <div class="post-meta">
                    <span class="post-meta-item">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <rect width="18" height="18" x="3" y="4" rx="2" ry="2"/><line x1="16" x2="16" y1="2" y2="6"/><line x1="8" x2="8" y1="2" y2="6"/><line x1="3" x2="21" y1="10" y2="10"/>
                        </svg>
                        <time datetime="<?= $post['date'] ?>"><?= format_date_tr($post['date']) ?></time>
                    </span>
                    <span class="post-meta-item">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/>
                        </svg>
                        <?= $post['reading_time'] ?> dakika okuma
                    </span>
                    <span class="post-meta-item">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/>
                        </svg>
                        <?= htmlspecialchars(SITE_OWNER) ?>
                    </span>
                </div>

                <!-- Etiketler -->
                <div class="tags-list">
                    <?php foreach ($post['tags'] as $tag): ?>
                    <a href="blog.php?tag=<?= urlencode($tag) ?>" class="tag tag-default">
                        <?= htmlspecialchars($tag) ?>
                    </a>
                    <?php endforeach; ?>
                </div>
            </header>

            <!-- Yazı İçeriği (HTML olarak render et) -->
            <div class="post-body">
                <?= $post['content'] /* İçerik zaten temiz HTML */ ?>
            </div>

            <!-- Önceki / Sonraki Yazı -->
            <nav class="post-navigation" aria-label="Yazılar arası navigasyon"
                 style="display:flex; justify-content:space-between; gap:1rem; margin-top:var(--space-2xl); padding-top:var(--space-xl); border-top:1px solid var(--border-color); flex-wrap:wrap;">

                <?php if ($prev_post): ?>
                <a href="blog-post.php?slug=<?= urlencode($prev_post['slug']) ?>"
                   class="btn btn-outline"
                   style="flex: 1; min-width: 200px; justify-content: flex-start;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <path d="M19 12H5M12 19l-7-7 7-7"/>
                    </svg>
                    <span style="text-align:left;">
                        <small style="display:block; font-size:0.7rem; color:var(--text-muted);">Önceki</small>
                        <?= htmlspecialchars($prev_post['title']) ?>
                    </span>
                </a>
                <?php else: ?><div></div><?php endif; ?>

                <?php if ($next_post): ?>
                <a href="blog-post.php?slug=<?= urlencode($next_post['slug']) ?>"
                   class="btn btn-outline"
                   style="flex: 1; min-width: 200px; justify-content: flex-end;">
                    <span style="text-align:right;">
                        <small style="display:block; font-size:0.7rem; color:var(--text-muted);">Sonraki</small>
                        <?= htmlspecialchars($next_post['title']) ?>
                    </span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <path d="M5 12h14M12 5l7 7-7 7"/>
                    </svg>
                </a>
                <?php endif; ?>

            </nav>

        </article>

        <!-- Kenar Çubuğu (Sidebar) -->
        <aside class="post-sidebar" aria-label="Kenar çubuğu">

            <!-- Yazar kartı -->
            <div class="sidebar-card">
                <h3 class="sidebar-card-title">// Yazar</h3>
                <div style="display:flex; align-items:center; gap:0.75rem; margin-bottom:0.75rem;">
                    <div style="
                        width: 44px; height: 44px; border-radius: 50%;
                        background: var(--gradient-primary);
                        display: flex; align-items: center; justify-content: center;
                        font-weight: 700; font-family: var(--font-heading); font-size: 1rem; color: white;
                        flex-shrink: 0;
                    ">RV</div>
                    <div>
                        <div style="font-weight: 600; font-size: 0.9rem; color: var(--text-primary);">
                            <?= htmlspecialchars(SITE_OWNER) ?>
                        </div>
                        <div style="font-size: 0.75rem; color: var(--text-muted);">
                            <?= htmlspecialchars(SITE_TAGLINE) ?>
                        </div>
                    </div>
                </div>
                <p style="font-size:0.8rem; color:var(--text-secondary); margin:0 0 0.75rem;">
                    Yazılım mühendisliği öğrencisi · Python, Django, C#, Unity ile çalışıyor.
                </p>
                <a href="<?= GITHUB_URL ?>" class="btn btn-outline btn-sm" target="_blank" rel="noopener noreferrer">
                    GitHub'da Takip Et
                </a>
            </div>

            <!-- Etiketler kartı -->
            <div class="sidebar-card">
                <h3 class="sidebar-card-title">// Etiketler</h3>
                <div class="tags-list">
                    <?php foreach ($post['tags'] as $tag): ?>
                    <a href="blog.php?tag=<?= urlencode($tag) ?>" class="tag tag-default">
                        <?= htmlspecialchars($tag) ?>
                    </a>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Diğer yazılar -->
            <?php
            $other_posts = array_filter($blog_posts, fn($p) => $p['slug'] !== $slug);
            $other_posts = array_slice($other_posts, 0, 3);
            if (!empty($other_posts)):
            ?>
            <div class="sidebar-card">
                <h3 class="sidebar-card-title">// Diğer Yazılar</h3>
                <div style="display: flex; flex-direction: column; gap: 0.75rem;">
                    <?php foreach ($other_posts as $op): ?>
                    <a href="blog-post.php?slug=<?= urlencode($op['slug']) ?>"
                       style="display:flex; align-items:center; gap:0.5rem; color:var(--text-secondary); font-size:0.85rem; transition: color var(--transition-fast); text-decoration:none;"
                       onmouseover="this.style.color='var(--accent-primary)'"
                       onmouseout="this.style.color='var(--text-secondary)'">
                        <span><?= $op['icon'] ?></span>
                        <span><?= htmlspecialchars($op['title']) ?></span>
                    </a>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php endif; ?>

            <!-- Blog'a dön -->
            <div style="text-align: center; margin-top: 0.5rem;">
                <a href="blog.php" class="btn btn-outline btn-sm">
                    ← Tüm Yazılara Dön
                </a>
            </div>

        </aside>

    </div>
</main>

<!-- Scroll-to-top -->
<button class="scroll-to-top" aria-label="Sayfanın başına git">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
        <path d="M12 19V5M5 12l7-7 7 7"/>
    </svg>
</button>

<?php include 'includes/footer.php'; ?>
