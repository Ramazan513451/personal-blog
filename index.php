<?php
/**
 * index.php — Ana Sayfa
 * Ramazan Vural · Antigravity Blog & Portfolyo
 *
 * Bölümler: Hero → About → Projects → Blog Preview → Contact
 */

require_once 'config.php';
require_once 'includes/projects-data.php';
require_once 'includes/blog-data.php';

$page_title = 'Ana Sayfa';

// ─── Form gönderimi var mı? ──────────────────────────────────────────────────
$form_success = isset($_GET['sent']) && $_GET['sent'] === '1';
$form_error   = isset($_GET['error']) ? htmlspecialchars($_GET['error']) : '';

// ─── Tag'e CSS sınıfı eşle ──────────────────────────────────────────────────
function tag_class(string $tag): string {
    $map = [
        'Python'          => 'python',
        'Django'          => 'django',
        'C#'              => 'csharp',
        'ASP.NET Core'    => 'aspnet',
        '.NET'            => 'aspnet',
        'Unity'           => 'unity',
        'Aseprite'        => 'aseprite',
        'Pixel Art'       => 'pixel',
        'SQL Server'      => 'sql',
        'PostgreSQL'      => 'sql',
        'REST API'        => 'rest',
    ];
    return $map[$tag] ?? 'default';
}

include 'includes/header.php';
?>

<!-- ══════════════════════════════════════════════════════
     HEROsection
     ══════════════════════════════════════════════════════ -->
<section class="hero" id="hero" aria-label="Hero bölümü">

    <!-- Canvas Parçacık Arka Planı -->
    <canvas id="particles-canvas" aria-hidden="true"></canvas>

    <!-- Hero İçeriği -->
    <div class="hero-content">

        <!-- Durum rozeti -->
        <div class="hero-badge">
            <span class="hero-badge-dot" aria-hidden="true"></span>
            Malatya Turgut Özal Üniversitesi · Yazılım Mühendisliği
        </div>

        <!-- Ana başlık -->
        <h1 class="hero-title">
            <span class="name-gradient">Ramazan Vural</span>
        </h1>

        <!-- Typing Effect alt başlık -->
        <p class="hero-subtitle" aria-live="polite">
            <span id="typing-text">Full-Stack Developer</span><span class="typing-cursor" aria-hidden="true"></span>
        </p>

        <!-- Kısa açıklama -->
        <p class="hero-description">
            Niğde kökenli, Python · Django · C# · ASP.NET Core ve Unity ile çalışan bir yazılım mühendisliği öğrencisi.
            Piksel sanatından web mimarisine kadar geniş bir yelpazede üretiyorum.
        </p>

        <!-- CTA Butonları -->
        <div class="hero-actions">
            <a href="#projects" class="btn btn-primary btn-lg">
                <!-- Briefcase icon -->
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <rect width="20" height="14" x="2" y="7" rx="2"/><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"/>
                </svg>
                Projelerimi Gör
            </a>
            <a href="<?= GITHUB_URL ?>" class="btn btn-outline btn-lg" target="_blank" rel="noopener noreferrer">
                <!-- GitHub icon -->
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                    <path d="M12 0C5.37 0 0 5.37 0 12c0 5.31 3.435 9.795 8.205 11.385.6.105.825-.255.825-.57 0-.285-.015-1.23-.015-2.235-3.015.555-3.795-.735-4.035-1.41-.135-.345-.72-1.41-1.23-1.695-.42-.225-1.02-.78-.015-.795.945-.015 1.62.87 1.845 1.23 1.08 1.815 2.805 1.305 3.495.99.105-.78.42-1.305.765-1.605-2.67-.3-5.46-1.335-5.46-5.925 0-1.305.465-2.385 1.23-3.225-.12-.3-.54-1.53.12-3.18 0 0 1.005-.315 3.3 1.23.96-.27 1.98-.405 3-.405s2.04.135 3 .405c2.295-1.56 3.3-1.23 3.3-1.23.66 1.65.24 2.88.12 3.18.765.84 1.23 1.905 1.23 3.225 0 4.605-2.805 5.625-5.475 5.925.435.375.81 1.095.81 2.22 0 1.605-.015 2.895-.015 3.3 0 .315.225.69.825.57A12.02 12.02 0 0 0 24 12c0-6.63-5.37-12-12-12z"/>
                </svg>
                GitHub
            </a>
            <a href="<?= LINKEDIN_URL ?>" class="btn btn-outline btn-lg" target="_blank" rel="noopener noreferrer">
                <!-- LinkedIn icon -->
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                    <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 0 1-2.063-2.065 2.064 2.064 0 1 1 2.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                </svg>
                LinkedIn
            </a>
        </div>

    </div>

    <!-- Aşağı scroll oku -->
    <a href="#about" class="hero-scroll-hint" aria-label="Aşağı kaydır">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
            <path d="M12 5v14M5 12l7 7 7-7"/>
        </svg>
    </a>

</section>

<!-- Hero Scroll İpucu Stili (inline, sadece burada kullanılıyor) -->
<style>
.hero-scroll-hint {
    position: absolute;
    bottom: 2rem;
    left: 50%;
    transform: translateX(-50%);
    color: var(--text-muted);
    animation: float 2.5s ease-in-out infinite;
    z-index: 1;
    transition: color var(--transition-fast);
}
.hero-scroll-hint:hover { color: var(--accent-primary); }
</style>

<!-- ══════════════════════════════════════════════════════
     HAKKIMDA
     ══════════════════════════════════════════════════════ -->
<section class="about section" id="about" aria-labelledby="about-heading">
    <div class="container">

        <div class="section-header reveal-on-scroll">
            <span class="section-label">01. Hakkımda</span>
            <h2 class="section-title" id="about-heading">
                Merhaba, ben <span class="gradient-text">Ramazan</span>
            </h2>
            <div class="section-divider"></div>
        </div>

        <div class="about-grid">

            <!-- Sol: Metin -->
            <div class="about-text reveal-left">
                <p>
                    Niğde'de doğup büyüdüm, şu anda Malatya'da <strong>Turgut Özal Üniversitesi Yazılım Mühendisliği</strong>
                    bölümünde eğitimime devam ediyorum. Kod yazmayı yalnızca bir meslek olarak değil,
                    bir düşünce biçimi olarak görüyorum.
                </p>
                <p>
                    Backend tarafında <strong>Python & Django</strong> ile kurumsal ölçekte web platformları,
                    <strong>C# & ASP.NET Core</strong> ile yönetim sistemleri geliştiriyorum.
                    Oyun geliştirme cephesinde ise <strong>Unity ve C#</strong> ile çalışıyorum;
                    kullandığım her piksel artını <strong>Aseprite</strong>'da kendim çiziyorum.
                </p>
                <p>
                    Boş zamanlarımda motosikletimle şehir dışı turlar atıyorum ve
                    dizi & film dünyasını yakından takip ediyorum.
                </p>

                <!-- Teknoloji yığını -->
                <div class="about-tech-stack">
                    <h4>// Kullandığım Teknolojiler</h4>
                    <div class="tech-grid">
                        <span class="tech-item">Python</span>
                        <span class="tech-item">Django & DRF</span>
                        <span class="tech-item">C#</span>
                        <span class="tech-item">ASP.NET Core</span>
                        <span class="tech-item">Unity 3D</span>
                        <span class="tech-item">Aseprite</span>
                        <span class="tech-item">PostgreSQL</span>
                        <span class="tech-item">Git & GitHub</span>
                    </div>
                </div>
            </div>

            <!-- Sağ: Öne çıkan kartlar -->
            <div class="about-highlights">

                <!-- İstatistik kartları -->
                <div class="stat-row" style="display:grid;grid-template-columns:repeat(3,1fr);gap:1rem;margin-bottom:1rem;">
                    <div class="stat-card reveal-on-scroll reveal-delay-1">
                        <span class="stat-number">5+</span>
                        <span class="stat-label">Proje</span>
                    </div>
                    <div class="stat-card reveal-on-scroll reveal-delay-2">
                        <span class="stat-number">3+</span>
                        <span class="stat-label">Teknoloji</span>
                    </div>
                    <div class="stat-card reveal-on-scroll reveal-delay-3">
                        <span class="stat-number">∞</span>
                        <span class="stat-label">Öğrenme</span>
                    </div>
                </div>

                <div class="highlight-card reveal-right reveal-delay-1">
                    <div class="highlight-card-icon">🚀</div>
                    <div class="highlight-card-title">Full-Stack Geliştirici</div>
                    <p>Django backend'den ASP.NET Core servislerine, React-benzeri ön yüzden Unity oyunlarına kadar geniş yelpaze.</p>
                </div>

                <div class="highlight-card reveal-right reveal-delay-2">
                    <div class="highlight-card-icon">🎨</div>
                    <div class="highlight-card-title">Oyun & Piksel Sanatı</div>
                    <p>Unity ile oyun mekaniği tasarlıyor, tüm piksel artları ve sprite animasyonlarını Aseprite'da sıfırdan çiziyorum.</p>
                </div>

                <div class="highlight-card reveal-right reveal-delay-3">
                    <div class="highlight-card-icon">🏍️</div>
                    <div class="highlight-card-title">Hobiler</div>
                    <p>Motosiklet turları, dizi & film takipçisi, sürekli bir şeyler öğrenmeye çalışan meraklı bir mühendis adayı.</p>
                </div>

            </div>

        </div>
    </div>
</section>

<!-- ══════════════════════════════════════════════════════
     PROJELER
     ══════════════════════════════════════════════════════ -->
<section class="section" id="projects" aria-labelledby="projects-heading">
    <div class="container">

        <div class="section-header reveal-on-scroll">
            <span class="section-label">02. Projeler</span>
            <h2 class="section-title" id="projects-heading">
                Öne Çıkan <span class="gradient-text">Çalışmalarım</span>
            </h2>
            <p class="section-subtitle">
                Akademik, kişisel ve kurumsal projelerden bir seçki.
            </p>
            <div class="section-divider"></div>
        </div>

        <!-- Proje Grid -->
        <div class="projects-grid">
            <?php foreach ($projects as $i => $project): ?>
            <article class="project-card" style="--card-accent: <?= htmlspecialchars($project['accent']) ?>; animation-delay: <?= $i * 100 ?>ms;">

                <!-- Üst renkli şerit -->
                <div class="project-card-accent-bar" style="background: <?= htmlspecialchars($project['accent']) ?>;"></div>

                <!-- Kart içeriği -->
                <div class="project-card-body">
                    <span class="project-card-icon" aria-hidden="true"><?= $project['icon'] ?></span>

                    <h3 class="project-card-title"><?= htmlspecialchars($project['title']) ?></h3>

                    <p class="project-card-desc"><?= htmlspecialchars($project['description']) ?></p>

                    <!-- Teknoloji etiketleri -->
                    <div class="tags-list">
                        <?php foreach ($project['tags'] as $tag): ?>
                        <span class="tag tag-<?= tag_class($tag) ?>"><?= htmlspecialchars($tag) ?></span>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- Kart footer: linkler -->
                <div class="project-card-footer">
                    <a href="<?= htmlspecialchars($project['github']) ?>" class="project-link" target="_blank" rel="noopener noreferrer" aria-label="<?= htmlspecialchars($project['title']) ?> GitHub">
                        <!-- GitHub küçük ikon -->
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                            <path d="M12 0C5.37 0 0 5.37 0 12c0 5.31 3.435 9.795 8.205 11.385.6.105.825-.255.825-.57 0-.285-.015-1.23-.015-2.235-3.015.555-3.795-.735-4.035-1.41-.135-.345-.72-1.41-1.23-1.695-.42-.225-1.02-.78-.015-.795.945-.015 1.62.87 1.845 1.23 1.08 1.815 2.805 1.305 3.495.99.105-.78.42-1.305.765-1.605-2.67-.3-5.46-1.335-5.46-5.925 0-1.305.465-2.385 1.23-3.225-.12-.3-.54-1.53.12-3.18 0 0 1.005-.315 3.3 1.23.96-.27 1.98-.405 3-.405s2.04.135 3 .405c2.295-1.56 3.3-1.23 3.3-1.23.66 1.65.24 2.88.12 3.18.765.84 1.23 1.905 1.23 3.225 0 4.605-2.805 5.625-5.475 5.925.435.375.81 1.095.81 2.22 0 1.605-.015 2.895-.015 3.3 0 .315.225.69.825.57A12.02 12.02 0 0 0 24 12c0-6.63-5.37-12-12-12z"/>
                        </svg>
                        Kod
                    </a>

                    <?php if ($project['live'] !== '#'): ?>
                    <a href="<?= htmlspecialchars($project['live']) ?>" class="project-link" target="_blank" rel="noopener noreferrer" aria-label="<?= htmlspecialchars($project['title']) ?> canlı site">
                        <!-- External link icon -->
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/>
                            <polyline points="15 3 21 3 21 9"/><line x1="10" x2="21" y1="14" y2="3"/>
                        </svg>
                        Canlı
                    </a>
                    <?php endif; ?>
                </div>

            </article>
            <?php endforeach; ?>
        </div>

    </div>
</section>

<!-- ══════════════════════════════════════════════════════
     BLOG ÖNİZLEME
     ══════════════════════════════════════════════════════ -->
<section class="blog-preview section" id="blog" aria-labelledby="blog-heading">
    <div class="container">

        <div class="section-header reveal-on-scroll">
            <span class="section-label">03. Blog</span>
            <h2 class="section-title" id="blog-heading">
                Son <span class="gradient-text">Yazılarım</span>
            </h2>
            <p class="section-subtitle">
                Öğrendiklerimi, deneyimlerimi ve teknik keşiflerimi paylaşıyorum.
            </p>
            <div class="section-divider"></div>
        </div>

        <!-- Blog Kartları (son 3 yazı) -->
        <div class="blog-grid">
            <?php foreach (array_slice($blog_posts, 0, 3) as $i => $post): ?>
            <a href="blog-post.php?slug=<?= urlencode($post['slug']) ?>"
               class="blog-card reveal-on-scroll reveal-delay-<?= $i + 1 ?>"
               aria-label="<?= htmlspecialchars($post['title']) ?> yazısını oku">

                <div class="blog-card-header">
                    <span class="blog-card-icon" aria-hidden="true"><?= $post['icon'] ?></span>
                    <time class="blog-card-date" datetime="<?= $post['date'] ?>">
                        <?= format_date_tr($post['date']) ?>
                    </time>
                </div>

                <div class="blog-card-body">
                    <h3 class="blog-card-title"><?= htmlspecialchars($post['title']) ?></h3>
                    <p class="blog-card-excerpt"><?= htmlspecialchars($post['excerpt']) ?></p>

                    <div class="blog-card-footer">
                        <span class="blog-read-time">
                            <!-- Clock icon -->
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

        <!-- Tüm yazılara git -->
        <div class="blog-preview-cta reveal-on-scroll">
            <a href="blog.php" class="btn btn-outline btn-lg">
                Tüm Yazıları Gör
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <path d="M5 12h14M12 5l7 7-7 7"/>
                </svg>
            </a>
        </div>

    </div>
</section>

<!-- ══════════════════════════════════════════════════════
     İLETİŞİM
     ══════════════════════════════════════════════════════ -->
<section class="section" id="contact" aria-labelledby="contact-heading">
    <div class="container">

        <div class="section-header reveal-on-scroll">
            <span class="section-label">04. İletişim</span>
            <h2 class="section-title" id="contact-heading">
                Birlikte <span class="gradient-text">Çalışalım</span>
            </h2>
            <p class="section-subtitle">
                Proje fikrin mi var? Sorular, işbirlikleri veya sadece merhaba demek için yazabilirsin.
            </p>
            <div class="section-divider"></div>
        </div>

        <div class="contact-wrapper">

            <!-- Sol: İletişim bilgileri -->
            <div class="contact-info reveal-left">
                <h3>Hızlı İletişim</h3>
                <p>
                    Mesajlarına mümkün olan en kısa sürede dönmeye çalışırım.
                    Önce sosyal medyadan ulaşabilirsin.
                </p>

                <div class="contact-detail">
                    <span class="contact-detail-icon">✉️</span>
                    <div class="contact-detail-text">
                        <strong>E-posta</strong>
                        <a href="mailto:<?= CONTACT_EMAIL ?>"><?= CONTACT_EMAIL ?></a>
                    </div>
                </div>

                <div class="contact-detail">
                    <span class="contact-detail-icon" aria-hidden="true">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12 0C5.37 0 0 5.37 0 12c0 5.31 3.435 9.795 8.205 11.385.6.105.825-.255.825-.57 0-.285-.015-1.23-.015-2.235-3.015.555-3.795-.735-4.035-1.41-.135-.345-.72-1.41-1.23-1.695-.42-.225-1.02-.78-.015-.795.945-.015 1.62.87 1.845 1.23 1.08 1.815 2.805 1.305 3.495.99.105-.78.42-1.305.765-1.605-2.67-.3-5.46-1.335-5.46-5.925 0-1.305.465-2.385 1.23-3.225-.12-.3-.54-1.53.12-3.18 0 0 1.005-.315 3.3 1.23.96-.27 1.98-.405 3-.405s2.04.135 3 .405c2.295-1.56 3.3-1.23 3.3-1.23.66 1.65.24 2.88.12 3.18.765.84 1.23 1.905 1.23 3.225 0 4.605-2.805 5.625-5.475 5.925.435.375.81 1.095.81 2.22 0 1.605-.015 2.895-.015 3.3 0 .315.225.69.825.57A12.02 12.02 0 0 0 24 12c0-6.63-5.37-12-12-12z"/>
                        </svg>
                    </span>
                    <div class="contact-detail-text">
                        <strong>GitHub</strong>
                        <a href="<?= GITHUB_URL ?>" target="_blank" rel="noopener noreferrer">github.com/ramazanvural</a>
                    </div>
                </div>

                <div class="contact-detail">
                    <span class="contact-detail-icon" aria-hidden="true">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 0 1-2.063-2.065 2.064 2.064 0 1 1 2.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                        </svg>
                    </span>
                    <div class="contact-detail-text">
                        <strong>LinkedIn</strong>
                        <a href="<?= LINKEDIN_URL ?>" target="_blank" rel="noopener noreferrer">linkedin.com/in/ramazanvural</a>
                    </div>
                </div>
            </div>

            <!-- Sağ: Form -->
            <div class="reveal-right">
                <form class="contact-form" id="contact-form" novalidate aria-label="İletişim formu">

                    <?php if ($form_success): ?>
                    <div class="form-message success success-animation">
                        ✅ Mesajınız iletildi! En kısa sürede dönüş yapacağım.
                    </div>
                    <?php elseif ($form_error): ?>
                    <div class="form-message error">
                        ❌ <?= $form_error ?>
                    </div>
                    <?php endif; ?>

                    <!-- Ad Soyad -->
                    <div class="form-group">
                        <label class="form-label" for="contact-name">
                            Ad Soyad <span class="required" aria-hidden="true">*</span>
                        </label>
                        <input
                            type="text"
                            id="contact-name"
                            name="name"
                            class="form-input"
                            placeholder="Adınız Soyadınız"
                            required
                            autocomplete="name"
                        >
                        <span class="form-error" role="alert"></span>
                    </div>

                    <!-- E-posta -->
                    <div class="form-group">
                        <label class="form-label" for="contact-email">
                            E-posta <span class="required" aria-hidden="true">*</span>
                        </label>
                        <input
                            type="email"
                            id="contact-email"
                            name="email"
                            class="form-input"
                            placeholder="ornek@email.com"
                            required
                            autocomplete="email"
                        >
                        <span class="form-error" role="alert"></span>
                    </div>

                    <!-- Konu -->
                    <div class="form-group">
                        <label class="form-label" for="contact-subject">Konu</label>
                        <input
                            type="text"
                            id="contact-subject"
                            name="subject"
                            class="form-input"
                            placeholder="Mesajınızın konusu"
                            autocomplete="off"
                        >
                    </div>

                    <!-- Mesaj -->
                    <div class="form-group">
                        <label class="form-label" for="contact-message">
                            Mesaj <span class="required" aria-hidden="true">*</span>
                        </label>
                        <textarea
                            id="contact-message"
                            name="message"
                            class="form-textarea"
                            placeholder="Merhaba Ramazan, seninle..."
                            required
                        ></textarea>
                        <span class="form-error" role="alert"></span>
                    </div>

                    <!-- Gönder -->
                    <div class="form-submit-row">
                        <button type="submit" class="btn btn-primary btn-lg">
                            <!-- Send icon -->
                            <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <path d="m22 2-7 20-4-9-9-4Z"/><path d="M22 2 11 13"/>
                            </svg>
                            Mesajı Gönder
                        </button>
                    </div>

                </form>
            </div>

        </div>
    </div>
</section>

<!-- Scroll-to-top butonu -->
<button class="scroll-to-top" aria-label="Sayfanın başına git">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
        <path d="M12 19V5M5 12l7-7 7 7"/>
    </svg>
</button>

<?php include 'includes/footer.php'; ?>
