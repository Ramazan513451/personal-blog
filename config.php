<?php
/**
 * config.php — Merkezi Ayar Dosyası
 * Tüm global sabitler burada tanımlanır.
 * Değiştirmek istediğin bir şey varsa yalnızca bu dosyayı düzenlemen yeterli.
 */

// ─── Kişisel Bilgiler ───────────────────────────────────────────────────────
define('SITE_OWNER',    'Ramazan Vural');
define('SITE_TITLE',    'Ramazan Vural — Software Engineer & Game Dev');
define('SITE_TAGLINE',  'Full-Stack Developer & Game Developer');
define('SITE_DESC',     'Yazılım Mühendisliği Öğrencisi · Python, Django, C#, ASP.NET Core, Unity');
define('SITE_URL', 'https://ramazanvural-blog.onrender.com');   

// ─── Sosyal Medya Linkleri ──────────────────────────────────────────────────
define('GITHUB_URL',    'https://github.com/Ramazan513451');  
define('LINKEDIN_URL',  'https://www.linkedin.com/in/ramazan-vural-b0424819a/');  

// ─── İletişim ───────────────────────────────────────────────────────────────
define('CONTACT_EMAIL', 'rvural042@gmail.com');

// ─── PHP Mail Ayarları ──────────────────────────────────────────────────────
define('MAIL_FROM_NAME',    'Blog İletişim Formu');
define('MAIL_SUBJECT_PREFIX', '[Blog] ');

// ─── Geliştirici Modu (hataları görmek için true yap) ──────────────────────
define('DEV_MODE', true);
if (DEV_MODE) {
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
}
?>
