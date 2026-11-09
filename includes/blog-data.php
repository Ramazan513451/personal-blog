<?php
/**
 * blog-data.php — Blog Yazı Verileri
 * Yeni yazı eklemek için $blog_posts array'ine yeni eleman ekle.
 * İleride MySQL'e geçmek istersen bu array'i bir veritabanı sorgusuyla değiştirebilirsin.
 */

$blog_posts = [
    [
        'id'       => 1,
        'slug'     => 'django-ile-rest-api-gelistirme',
        'title'    => 'Django ile REST API Geliştirme: Başlangıç Rehberi',
        'excerpt'  => 'Django REST Framework kullanarak sağlam, ölçeklenebilir API\'ler nasıl inşa edilir? Authentication, serializer\'lar ve viewset\'ler üzerine kapsamlı bir rehber.',
        'content'  => '
<p>Django REST Framework (DRF), Python\'ın en popüler web framework\'ü Django üzerine inşa edilmiş güçlü bir araçtır. Bu rehberde sıfırdan bir REST API geliştireceğiz.</p>

<h2>Kurulum</h2>
<pre><code>pip install djangorestframework
pip install django-cors-headers</code></pre>

<h2>Serializer Oluşturma</h2>
<p>Serializer\'lar, Python nesnelerini JSON\'a (ve tersine) dönüştürür. Model serializer\'lar bu işlemi otomatize eder:</p>
<pre><code>from rest_framework import serializers
from .models import Project

class ProjectSerializer(serializers.ModelSerializer):
    class Meta:
        model = Project
        fields = [\'id\', \'title\', \'description\', \'tags\']</code></pre>

<h2>ViewSet ve Router</h2>
<p>ViewSet\'ler CRUD operasyonlarını tek bir sınıfta toplar. Router ise URL\'leri otomatik oluşturur.</p>

<p>Bu rehber, API geliştirme sürecinin yalnızca başlangıcıdır. Authentication, pagination ve filtreleme konularını ilerleyen yazılarda ele alacağım.</p>
        ',
        'tags'     => ['Python', 'Django', 'REST API', 'Backend'],
        'date'     => '2026-10-15',
        'reading_time' => 8,
        'icon'     => '🐍',
    ],
    [
        'id'       => 2,
        'slug'     => 'unity-ile-pixel-art-animasyon',
        'title'    => 'Unity\'de Pixel Art Animasyon: Aseprite\'den Oyuna',
        'excerpt'  => 'Aseprite ile çizdiğin 2D sprite\'ları Unity\'e aktarma, Animator Controller kurulumu ve akıcı karakter animasyonları oluşturma adım adım anlatımı.',
        'content'  => '
<p>Pixel art oyunlar geliştirirken en kritik süreçlerden biri, çizdiğin sprite\'ları oyun motoruna entegre etmektir. Bu yazıda Aseprite\'den Unity\'e tam iş akışını anlatacağım.</p>

<h2>Aseprite\'de Export Ayarları</h2>
<p>File → Export Sprite Sheet seçeneğiyle tüm frame\'leri tek bir PNG\'ye (sprite sheet) aktarabilirsin. JSON veri dosyasını da aynı anda export etmeyi unutma.</p>

<h2>Unity\'de Import Ayarları</h2>
<p>Sprite\'ı Unity\'e sürükledikten sonra Inspector\'da şu ayarları yap:</p>
<ul>
    <li><strong>Texture Type:</strong> Sprite (2D and UI)</li>
    <li><strong>Pixels Per Unit:</strong> Aseprite\'deki canvas boyutuna göre ayarla (örn. 16)</li>
    <li><strong>Filter Mode:</strong> Point (no filter) — piksel netliği için şart!</li>
</ul>

<h2>Animator Controller</h2>
<p>Idle, Run, Jump gibi animasyon state\'lerini Animator Controller\'da tanımlayıp parametrelerle geçişleri kontrol edebilirsin.</p>
        ',
        'tags'     => ['Unity', 'C#', 'Pixel Art', 'Aseprite', 'Oyun Geliştirme'],
        'date'     => '2026-09-28',
        'reading_time' => 12,
        'icon'     => '🎮',
    ],
    [
        'id'       => 3,
        'slug'     => 'aspnet-core-ile-clean-architecture',
        'title'    => 'ASP.NET Core\'da Clean Architecture Uygulaması',
        'excerpt'  => 'SOLID prensiplerini göz önünde bulundurarak ASP.NET Core projelerinde Clean Architecture nasıl kurulur? Repository pattern, CQRS ve MediatR entegrasyonu.',
        'content'  => '
<p>Clean Architecture, bağımlılıkları içe doğru yönlendirerek iş mantığını dış katmanlardan (veritabanı, UI, framework) bağımsız kılar. Bu yaklaşım büyük projelerde sürdürülebilirliği dramatik biçimde artırır.</p>

<h2>Katman Yapısı</h2>
<ul>
    <li><strong>Domain:</strong> Entity\'ler, interface\'ler, iş kuralları</li>
    <li><strong>Application:</strong> Use case\'ler, CQRS command/query\'leri</li>
    <li><strong>Infrastructure:</strong> Repository implementasyonları, veritabanı bağlantısı</li>
    <li><strong>Presentation:</strong> API controller\'ları, middleware</li>
</ul>

<h2>Repository Pattern</h2>
<p>Interface\'i Domain katmanında tanımla, implementasyonu Infrastructure\'da yaz. Bu sayede veritabanını değiştirmek istersen yalnızca Infrastructure katmanını değiştirmen yeterli.</p>

<h2>MediatR ile CQRS</h2>
<p>MediatR kütüphanesi, command ve query\'leri handler\'larla eşleştirir. Controller\'lar yalnızca <code>_mediator.Send()</code> çağrısı yapar, iş mantığını bilmez.</p>
        ',
        'tags'     => ['C#', 'ASP.NET Core', '.NET', 'Architecture'],
        'date'     => '2026-09-10',
        'reading_time' => 15,
        'icon'     => '⚙️',
    ],
];

/**
 * Slug'a göre tek bir yazı döndürür.
 */
function get_post_by_slug(string $slug, array $posts): ?array {
    foreach ($posts as $post) {
        if ($post['slug'] === $slug) return $post;
    }
    return null;
}

/**
 * Tarihi Türkçe formatlı döndürür: "15 Ekim 2026"
 */
function format_date_tr(string $date): string {
    $months = [
        1=>'Ocak',2=>'Şubat',3=>'Mart',4=>'Nisan',
        5=>'Mayıs',6=>'Haziran',7=>'Temmuz',8=>'Ağustos',
        9=>'Eylül',10=>'Ekim',11=>'Kasım',12=>'Aralık'
    ];
    $ts = strtotime($date);
    return date('j', $ts) . ' ' . $months[(int)date('n', $ts)] . ' ' . date('Y', $ts);
}
?>
