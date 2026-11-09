<?php
/**
 * contact-handler.php — İletişim Formu İşleyici
 * Ramazan Vural · Antigravity Blog & Portfolyo
 *
 * POST isteği alır, doğrular, e-posta gönderir.
 * JSON yanıt döner (AJAX için).
 */

require_once 'config.php';

// ─── Sadece POST kabul et ─────────────────────────────────────────────────────
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit;
}

// ─── JSON yanıt için header ───────────────────────────────────────────────────
header('Content-Type: application/json; charset=UTF-8');

// ─── Yardımcı: Güvenli veri al ───────────────────────────────────────────────
function clean(string $value): string {
    return htmlspecialchars(strip_tags(trim($value)), ENT_QUOTES, 'UTF-8');
}

// ─── Veri al ve temizle ───────────────────────────────────────────────────────
$name    = clean($_POST['name']    ?? '');
$email   = clean($_POST['email']   ?? '');
$subject = clean($_POST['subject'] ?? 'Blog İletişim Formu');
$message = clean($_POST['message'] ?? '');

// ─── Sunucu taraflı doğrulama ─────────────────────────────────────────────────
$errors = [];

if (empty($name)) {
    $errors[] = 'Ad soyad alanı zorunludur.';
}

if (empty($email)) {
    $errors[] = 'E-posta alanı zorunludur.';
} elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    $errors[] = 'Geçerli bir e-posta adresi girin.';
}

if (empty($message)) {
    $errors[] = 'Mesaj alanı zorunludur.';
} elseif (strlen($message) < 10) {
    $errors[] = 'Mesajınız en az 10 karakter olmalıdır.';
}

// ─── Spam koruması: Basit rate limiting (session tabanlı) ─────────────────────
session_start();
$now = time();
$last_sent = $_SESSION['last_contact_sent'] ?? 0;

if (($now - $last_sent) < 60) { // 60 saniye bekleme
    echo json_encode([
        'success' => false,
        'message' => 'Çok sık mesaj gönderiyorsunuz. Lütfen 1 dakika bekleyin.',
    ]);
    exit;
}

// ─── Hata varsa döndür ───────────────────────────────────────────────────────
if (!empty($errors)) {
    echo json_encode([
        'success' => false,
        'message' => implode(' ', $errors),
    ]);
    exit;
}

// ─── E-posta içeriği ─────────────────────────────────────────────────────────
$email_subject = MAIL_SUBJECT_PREFIX . (!empty($subject) ? $subject : 'Yeni Mesaj');

$email_body = "
╔══════════════════════════════════════════════╗
   Blog İletişim Formu — Yeni Mesaj
╚══════════════════════════════════════════════╝

Gönderen   : {$name}
E-posta    : {$email}
Tarih      : " . date('d.m.Y H:i:s') . "
IP Adresi  : " . ($_SERVER['REMOTE_ADDR'] ?? 'bilinmiyor') . "

─── Mesaj ───────────────────────────────────────

{$message}

─────────────────────────────────────────────────
Bu e-posta ramazanvural.dev blog sitesi iletişim
formu aracılığıyla gönderilmiştir.
";

// ─── E-posta başlıkları ───────────────────────────────────────────────────────
$headers  = "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/plain; charset=UTF-8\r\n";
$headers .= "From: " . MAIL_FROM_NAME . " <noreply@" . ($_SERVER['HTTP_HOST'] ?? 'localhost') . ">\r\n";
$headers .= "Reply-To: {$name} <{$email}>\r\n";
$headers .= "X-Mailer: PHP/" . phpversion();

// ─── E-posta gönder ──────────────────────────────────────────────────────────
$mail_sent = mail(CONTACT_EMAIL, $email_subject, $email_body, $headers);

if ($mail_sent) {
    // Rate limiting için session güncelle
    $_SESSION['last_contact_sent'] = $now;

    echo json_encode([
        'success' => true,
        'message' => 'Mesajınız başarıyla iletildi! En kısa sürede geri dönüş yapacağım.',
    ]);
} else {
    // Mail gönderilemedi — geliştirici modunda hata logla
    if (DEV_MODE) {
        error_log('contact-handler.php: mail() başarısız oldu. To: ' . CONTACT_EMAIL);
    }

    echo json_encode([
        'success' => false,
        'message' => 'E-posta gönderilirken bir hata oluştu. Lütfen doğrudan e-posta ile ulaşın: ' . CONTACT_EMAIL,
    ]);
}
?>
