<?php
/**
 * blog.php — Tüm Blog Yazıları
 * Ramazan Vural · Antigravity Blog & Portfolyo
 */

require_once 'config.php';
require_once 'includes/blog-data.php';

$page_title = 'Blog';

// Aktif filtre etiketi
$active_tag = isset($_GET['tag']) ? htmlspecialchars($_GET['tag']) : '';

// Filtreleme
$filtered_posts = $blog_posts;
if ($active_tag) {
    $filtered_posts = array_filter($blog_posts, function($p) use ($active_tag) {
        return in_array($active_tag, $p['tags']);
    });
}

// Tüm benzersiz etiketleri topla
$all_tags = [];
foreach ($blog_posts as $post) {
    foreach ($post['tags'] as $tag) {
        $all_tags[$tag] = ($all_tags[$tag] ?? 0) + 1;
    }
}
arsort($all_tags);

include 'includes/header.php';
?>

<!-- ══════════════════════════════════════════════════════
     SAYFA HERO
     ══════════════════════════════════════════════════════ -->
<div class="page-hero" role="banner">
    <div class="container">
        <span class="section-label">Blog</span>
        <h1 class="section-title" style="margin-top:1rem;">
            Teknik <span class="gradient-text">Yazılarım</span>
        </h1>
        <p class="section-subtitle" style="margin-top:0.75rem;">
            Yazılım, oyun geliştirme ve öğrendiklerimi paylaşıyorum.
            Şu an <strong style="color:var(--text-primary)"><?= count($blog_posts) ?></strong> yazı mevcut.
        </p>
    </div>
</div>

<!-- ══════════════════════════════════════════════════════
     ETİKET FİLTRELERİ
     ══════════════════════════════════════════════════════ -->
<div style="border-bottom: 1px solid var(--border-color); background: var(--bg-secondary);">
    <div class="container" style="padding-top: 1.5rem; padding-bottom: 1.5rem;">
        <div class="tags-list" role="group" aria-label="Etikete göre filtrele">

            <a href="blog.php"
               class="tag <?= !$active_tag ? 'tag-default' : '' ?>"
               style="<?= !$active_tag ? '' : 'color:var(--text-muted);border-color:var(--border-color);' ?>"
               <?= !$active_tag ? 'aria-current="true"' : '' ?>>
                Tümü (<?= count($blog_posts) ?>)
            </a>

            <?php foreach ($all_tags as $tag => $count): ?>
            <a href="blog.php?tag=<?= urlencode($tag) ?>"
               class="tag <?= $active_tag === $tag ? 'tag-default' : '' ?>"
               style="<?= $active_tag === $tag ? '' : 'color:var(--text-muted);border-color:var(--border-color);' ?>"
               <?= $active_tag === $tag ? 'aria-current="true"' : '' ?>>
                <?= htmlspecialchars($tag) ?> (<?= $count ?>)
            </a>
            <?php endforeach; ?>

        </div>
    </div>
</div>

<!-- ══════════════════════════════════════════════════════
     BLOG KARTLARI
     ══════════════════════════════════════════════════════ -->
<main class="container" id="main-content">

    <?php if (empty($filtered_posts)): ?>
    <!-- Sonuç yok -->
    <div style="text-align:center; padding: var(--space-3xl) 0; color: var(--text-muted);">
        <span style="font-size:3rem; display:block; margin-bottom:1rem;">🔍</span>
        <p>"<?= $active_tag ?>" etiketiyle eşleşen yazı bulunamadı.</p>
        <a href="blog.php" class="btn btn-outline" style="margin-top:1.5rem;">Tüm Yazıları Gör</a>
    </div>
    <?php else: ?>

    <div class="blog-page-grid" aria-label="Blog yazıları listesi">
        <?php foreach ($filtered_posts as $i => $post): ?>
        <a href="blog-post.php?slug=<?= urlencode($post['slug']) ?>"
           class="blog-card reveal-on-scroll reveal-delay-<?= ($i % 3) + 1 ?>"
           aria-label="<?= htmlspecialchars($post['title']) ?> yazısını oku">

            <div class="blog-card-header">
                <span class="blog-card-icon" aria-hidden="true"><?= $post['icon'] ?></span>
                <time class="blog-card-date" datetime="<?= $post['date'] ?>">
                    <?= format_date_tr($post['date']) ?>
                </time>
            </div>

            <div class="blog-card-body">
                <h2 class="blog-card-title"><?= htmlspecialchars($post['title']) ?></h2>
                <p class="blog-card-excerpt"><?= htmlspecialchars($post['excerpt']) ?></p>

                <!-- Etiketler -->
                <div class="tags-list" style="margin-bottom: 0.75rem;">
                    <?php foreach ($post['tags'] as $tag): ?>
                    <span class="tag tag-default" style="font-size:0.68rem;"><?= htmlspecialchars($tag) ?></span>
                    <?php endforeach; ?>
                </div>

                <div class="blog-card-footer">
                    <span class="blog-read-time">
                        <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/>
                        </svg>
                        <?= $post['reading_time'] ?> dk okuma
                    </span>
                    <span class="blog-read-more">
                        Oku
                        <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <path d="M5 12h14M12 5l7 7-7 7"/>
                        </svg>
                    </span>
                </div>
            </div>
        </a>
        <?php endforeach; ?>
    </div>

    <?php endif; ?>

</main>

<!-- Scroll-to-top -->
<button class="scroll-to-top" aria-label="Sayfanın başına git">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
        <path d="M12 19V5M5 12l7-7 7 7"/>
    </svg>
</button>

<?php include 'includes/footer.php'; ?>
