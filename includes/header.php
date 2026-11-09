<?php
/**
 * header.php — Ortak Üst Bölüm
 * Her sayfada <?php include 'includes/header.php'; ?> ile çağrılır.
 * $page_title değişkeni çağıran sayfada tanımlanmalıdır.
 */

// Eğer config henüz yüklenmemişse yükle
if (!defined('SITE_TITLE')) {
    require_once __DIR__ . '/../config.php';
}

$current_page_title = isset($page_title) ? $page_title . ' | ' . SITE_OWNER : SITE_TITLE;
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?= htmlspecialchars(SITE_DESC) ?>">
    <meta name="author" content="<?= htmlspecialchars(SITE_OWNER) ?>">

    <!-- Open Graph (sosyal paylaşım önizlemesi) -->
    <meta property="og:title" content="<?= htmlspecialchars($current_page_title) ?>">
    <meta property="og:description" content="<?= htmlspecialchars(SITE_DESC) ?>">
    <meta property="og:type" content="website">

    <title><?= htmlspecialchars($current_page_title) ?></title>

    <!-- Google Fonts: Space Grotesk + Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;500;600;700&family=Inter:wght@300;400;500;600&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">

    <!-- CSS -->
    <link rel="stylesheet" href="<?= rtrim(SITE_URL, '/') ?>/assets/css/main.css">
    <link rel="stylesheet" href="<?= rtrim(SITE_URL, '/') ?>/assets/css/animations.css">
    <link rel="stylesheet" href="<?= rtrim(SITE_URL, '/') ?>/assets/css/components.css">

    <!-- Favicon (emoji tabanlı SVG) -->
    <link rel="icon" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><text y='.9em' font-size='90'>🚀</text></svg>">
</head>
<body>

<!-- ══════════════════════════════════════════════════════
     NAVİGASYON ÇUBUĞU
     ══════════════════════════════════════════════════════ -->
<nav class="navbar" id="navbar" role="navigation" aria-label="Ana navigasyon">
    <div class="nav-container">

        <!-- Logo / Marka -->
        <a href="<?= SITE_URL ?>/index.php" class="nav-logo" aria-label="Ana sayfaya git">
            <span class="logo-bracket">&lt;</span>
            <span class="logo-name">RV</span>
            <span class="logo-bracket">/&gt;</span>
        </a>

        <!-- Masaüstü Menü -->
        <ul class="nav-links" role="list">
            <li><a href="<?= SITE_URL ?>/index.php#about"    class="nav-link">Hakkımda</a></li>
            <li><a href="<?= SITE_URL ?>/index.php#projects" class="nav-link">Projeler</a></li>
            <li><a href="<?= SITE_URL ?>/blog.php"           class="nav-link">Blog</a></li>
            <li><a href="<?= SITE_URL ?>/index.php#contact"  class="nav-link">İletişim</a></li>
        </ul>

        <!-- Sosyal İkonlar (Nav) -->
        <div class="nav-social">
            <a href="<?= GITHUB_URL ?>" class="social-icon-nav" target="_blank" rel="noopener noreferrer" aria-label="GitHub profili">
                <!-- GitHub SVG -->
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                    <path d="M12 0C5.37 0 0 5.37 0 12c0 5.31 3.435 9.795 8.205 11.385.6.105.825-.255.825-.57 0-.285-.015-1.23-.015-2.235-3.015.555-3.795-.735-4.035-1.41-.135-.345-.72-1.41-1.23-1.695-.42-.225-1.02-.78-.015-.795.945-.015 1.62.87 1.845 1.23 1.08 1.815 2.805 1.305 3.495.99.105-.78.42-1.305.765-1.605-2.67-.3-5.46-1.335-5.46-5.925 0-1.305.465-2.385 1.23-3.225-.12-.3-.54-1.53.12-3.18 0 0 1.005-.315 3.3 1.23.96-.27 1.98-.405 3-.405s2.04.135 3 .405c2.295-1.56 3.3-1.23 3.3-1.23.66 1.65.24 2.88.12 3.18.765.84 1.23 1.905 1.23 3.225 0 4.605-2.805 5.625-5.475 5.925.435.375.81 1.095.81 2.22 0 1.605-.015 2.895-.015 3.3 0 .315.225.69.825.57A12.02 12.02 0 0 0 24 12c0-6.63-5.37-12-12-12z"/>
                </svg>
            </a>
            <a href="<?= LINKEDIN_URL ?>" class="social-icon-nav" target="_blank" rel="noopener noreferrer" aria-label="LinkedIn profili">
                <!-- LinkedIn SVG -->
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                    <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 0 1-2.063-2.065 2.064 2.064 0 1 1 2.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                </svg>
            </a>
        </div>

        <!-- Hamburger Menü (Mobil) -->
        <button class="hamburger" id="hamburger" aria-label="Menüyü aç/kapat" aria-expanded="false" aria-controls="mobile-menu">
            <span class="hamburger-line"></span>
            <span class="hamburger-line"></span>
            <span class="hamburger-line"></span>
        </button>
    </div>

    <!-- Mobil Menü -->
    <div class="mobile-menu" id="mobile-menu" role="dialog" aria-hidden="true">
        <ul class="mobile-nav-links" role="list">
            <li><a href="<?= SITE_URL ?>/index.php#about"    class="mobile-nav-link">Hakkımda</a></li>
            <li><a href="<?= SITE_URL ?>/index.php#projects" class="mobile-nav-link">Projeler</a></li>
            <li><a href="<?= SITE_URL ?>/blog.php"           class="mobile-nav-link">Blog</a></li>
            <li><a href="<?= SITE_URL ?>/index.php#contact"  class="mobile-nav-link">İletişim</a></li>
            <li class="mobile-social-links">
                <a href="<?= GITHUB_URL ?>"   target="_blank" rel="noopener noreferrer">GitHub</a>
                <a href="<?= LINKEDIN_URL ?>" target="_blank" rel="noopener noreferrer">LinkedIn</a>
            </li>
        </ul>
    </div>
</nav>
