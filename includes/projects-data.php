<?php
/**
 * projects-data.php — Proje Verileri
 * Her projeyi buradan ekleyip düzenleyebilirsin.
 * Yeni proje eklemek için $projects array'ine yeni bir eleman eklemen yeterli.
 */

$projects = [
    [
        'id'          => 'kurumsal-web',
        'title'       => 'Kurumsal Web Platformu',
        'description' => 'Turgut Özal Üniversitesi Dijital Dönüşüm Ofisi için geliştirilmiş kapsamlı Django tabanlı web projesi. Kullanıcı yönetimi, içerik yönetim sistemi ve kurumsal raporlama modüllerini kapsamaktadır.',
        'tags'        => ['Python', 'Django', 'PostgreSQL', 'REST API'],
        'icon'        => '🏛️',
        'accent'      => '#6366f1',   // İndigo
        'github'      => '#',
        'live'        => '#',
        'featured'    => true,
    ],
    [
        'id'          => 'rmhys',
        'title'       => 'RMHYS',
        'description' => 'Randevu ve Müşteri Hizmetleri Yönetim Sistemi. .NET ve C# kullanılarak geliştirilmiş, randevu planlaması, müşteri takibi ve hizmet raporlaması özelliklerine sahip kapsamlı yönetim sistemi.',
        'tags'        => ['C#', 'ASP.NET Core', '.NET', 'SQL Server'],
        'icon'        => '📋',
        'accent'      => '#8b5cf6',   // Violet
        'github'      => '#',
        'live'        => '#',
        'featured'    => true,
    ],
    [
        'id'          => 'market-simulator',
        'title'       => '2D Market Management Simulator',
        'description' => 'Unity ve C# ile geliştirilen, tüm piksel art ve sprite animasyonları Aseprite ile sıfırdan çizilmiş top-down simülasyon oyunu. Stok yönetimi, müşteri yapay zekası ve dinamik ekonomi sistemi içermektedir.',
        'tags'        => ['Unity', 'C#', 'Aseprite', 'Pixel Art'],
        'icon'        => '🎮',
        'accent'      => '#06b6d4',   // Cyan
        'github'      => '#',
        'live'        => '#',
        'featured'    => true,
    ],
    [
        'id'          => 'tower-defense',
        'title'       => 'Tower Defense Game',
        'description' => '2D Unity tabanlı mezuniyet projesi. Çoklu düşman türleri, farklı kule kategorileri, dalga sistemi ve skor tablosu içeren strateji oyunu.',
        'tags'        => ['Unity', 'C#', 'Oyun Geliştirme', '2D'],
        'icon'        => '🗼',
        'accent'      => '#10b981',   // Emerald
        'github'      => '#',
        'live'        => '#',
        'featured'    => false,
    ],
    [
        'id'          => 'turkiye-haritasi',
        'title'       => 'Etkileşimli Türkiye Haritası',
        'description' => 'IV. Ar-Ge Proje Pazarı\'nda sergilenen poster projesi. İllere tıklanabilir bölgeler, demografik veri görselleştirmesi ve interaktif bilgi panosu içermektedir.',
        'tags'        => ['Ar-Ge', 'Tasarım', 'Veri Görselleştirme'],
        'icon'        => '🗺️',
        'accent'      => '#f59e0b',   // Amber
        'github'      => '#',
        'live'        => '#',
        'featured'    => false,
    ],
];
?>
