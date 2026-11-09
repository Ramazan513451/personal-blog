/**
 * particles.js — Canvas Tabanlı Antigravity Parçacık Sistemi
 * Ramazan Vural · Antigravity Blog & Portfolyo
 *
 * Özellikler:
 *  - 120 adet yıldız/parçacık, rastgele hareket
 *  - Parçacıklar hafifçe yukarı süzülür (antigravity hissi)
 *  - Mouse yakınlığına repulsion (itme) tepkisi
 *  - Yakın parçacıklar arası bağlantı çizgileri
 *  - Responsive: canvas yeniden boyutlandırılır
 */

(function () {
    'use strict';

    // ─── Ayarlar ─────────────────────────────────────────────────────────────
    const CONFIG = {
        particleCount:    120,       // Parçacık sayısı
        maxRadius:        2.5,       // Maksimum parçacık yarıçapı
        minRadius:        0.5,
        baseSpeed:        0.3,       // Temel hareket hızı
        floatBias:        -0.08,     // Negatif = yukarı süzülme (antigravity)
        connectionDist:   140,       // Bağlantı çizgisi için maksimum mesafe (px)
        mouseRepulseRadius: 100,     // Mouse repulsion yarıçapı (px)
        mouseRepulseForce:  0.6,     // Repulsion kuvveti
        fadeInDuration:   1500,      // Başlangıçta solma süresi (ms)
        // Renk paleti — uzay/indigo temaları
        colors: [
            'rgba(99, 102, 241, ',   // İndigo
            'rgba(139, 92, 246, ',   // Violet
            'rgba(6, 182, 212, ',    // Cyan
            'rgba(248, 250, 252, ',  // Beyaz
            'rgba(167, 139, 250, ',  // Light violet
        ],
    };

    // ─── Durum ───────────────────────────────────────────────────────────────
    let canvas, ctx, particles = [], mouse = { x: -9999, y: -9999 };
    let startTime = null;
    let animationId = null;

    // ─── Yardımcı: İki nokta arası mesafe ───────────────────────────────────
    function dist(ax, ay, bx, by) {
        const dx = ax - bx, dy = ay - by;
        return Math.sqrt(dx * dx + dy * dy);
    }

    // ─── Parçacık Fabrikası ──────────────────────────────────────────────────
    function createParticle() {
        const color = CONFIG.colors[Math.floor(Math.random() * CONFIG.colors.length)];
        const angle = Math.random() * Math.PI * 2;
        const speed = CONFIG.baseSpeed * (0.5 + Math.random() * 1.5);

        return {
            x:      Math.random() * canvas.width,
            y:      Math.random() * canvas.height,
            vx:     Math.cos(angle) * speed,
            vy:     Math.sin(angle) * speed + CONFIG.floatBias,
            radius: CONFIG.minRadius + Math.random() * (CONFIG.maxRadius - CONFIG.minRadius),
            color,
            // Orijinal hız (repulsion sonrası geri dönmek için)
            baseVx: Math.cos(angle) * speed,
            baseVy: Math.sin(angle) * speed + CONFIG.floatBias,
            // Titremeyi farklılaştırmak için rastgele faz
            phase:  Math.random() * Math.PI * 2,
            opacity: 0.4 + Math.random() * 0.5,
        };
    }

    // ─── Parçacıkları Başlat ─────────────────────────────────────────────────
    function initParticles() {
        particles = [];
        for (let i = 0; i < CONFIG.particleCount; i++) {
            particles.push(createParticle());
        }
    }

    // ─── Canvas Boyutlandırma ─────────────────────────────────────────────────
    function resize() {
        if (!canvas) return;
        canvas.width  = canvas.offsetWidth;
        canvas.height = canvas.offsetHeight;
    }

    // ─── Ana Çizim Döngüsü ───────────────────────────────────────────────────
    function draw(timestamp) {
        animationId = requestAnimationFrame(draw);

        if (!startTime) startTime = timestamp;
        const elapsed = timestamp - startTime;

        // Global fade-in
        const globalAlpha = Math.min(1, elapsed / CONFIG.fadeInDuration);

        ctx.clearRect(0, 0, canvas.width, canvas.height);

        const t = timestamp * 0.001; // saniye cinsinden zaman

        // ── Parçacıkları güncelle ve çiz ──────────────────────────────────
        for (let i = 0; i < particles.length; i++) {
            const p = particles[i];

            // Mouse repulsion
            const d = dist(p.x, p.y, mouse.x, mouse.y);
            if (d < CONFIG.mouseRepulseRadius && d > 0) {
                const force = (CONFIG.mouseRepulseRadius - d) / CONFIG.mouseRepulseRadius;
                const angle = Math.atan2(p.y - mouse.y, p.x - mouse.x);
                p.vx += Math.cos(angle) * force * CONFIG.mouseRepulseForce;
                p.vy += Math.sin(angle) * force * CONFIG.mouseRepulseForce;
            }

            // Orijinal hıza doğru sönümleme (damping)
            p.vx += (p.baseVx - p.vx) * 0.04;
            p.vy += (p.baseVy - p.vy) * 0.04;

            // Hafif sinüs titremesi (antigravity salınımı)
            p.vx += Math.sin(t + p.phase) * 0.004;

            // Pozisyon güncelle
            p.x += p.vx;
            p.y += p.vy;

            // Sınırları geç: diğer kenardan çık
            if (p.x < -p.radius)           p.x = canvas.width  + p.radius;
            if (p.x > canvas.width  + p.radius) p.x = -p.radius;
            if (p.y < -p.radius)           p.y = canvas.height + p.radius;
            if (p.y > canvas.height + p.radius) p.y = -p.radius;

            // Parçacığı çiz
            ctx.beginPath();
            ctx.arc(p.x, p.y, p.radius, 0, Math.PI * 2);
            ctx.fillStyle = p.color + (p.opacity * globalAlpha) + ')';
            ctx.fill();
        }

        // ── Bağlantı çizgileri ─────────────────────────────────────────────
        for (let i = 0; i < particles.length - 1; i++) {
            for (let j = i + 1; j < particles.length; j++) {
                const d = dist(particles[i].x, particles[i].y, particles[j].x, particles[j].y);
                if (d < CONFIG.connectionDist) {
                    // Mesafeye göre solma
                    const alpha = (1 - d / CONFIG.connectionDist) * 0.25 * globalAlpha;
                    ctx.beginPath();
                    ctx.moveTo(particles[i].x, particles[i].y);
                    ctx.lineTo(particles[j].x, particles[j].y);
                    ctx.strokeStyle = `rgba(99, 102, 241, ${alpha})`;
                    ctx.lineWidth = 0.6;
                    ctx.stroke();
                }
            }
        }
    }

    // ─── Mouse Olayları ───────────────────────────────────────────────────────
    function onMouseMove(e) {
        const rect = canvas.getBoundingClientRect();
        mouse.x = e.clientX - rect.left;
        mouse.y = e.clientY - rect.top;
    }

    function onMouseLeave() {
        mouse.x = -9999;
        mouse.y = -9999;
    }

    // ─── Başlatma ─────────────────────────────────────────────────────────────
    function init() {
        canvas = document.getElementById('particles-canvas');
        if (!canvas) return; // Canvas yoksa hiçbir şey yapma

        ctx = canvas.getContext('2d');

        resize();
        initParticles();
        draw(0);

        // Event listeners
        window.addEventListener('resize', () => {
            resize();
            initParticles(); // Canvas yeniden boyutlandığında parçacıkları sıfırla
        });

        canvas.addEventListener('mousemove', onMouseMove);
        canvas.addEventListener('mouseleave', onMouseLeave);

        // Mobilde touch desteği
        canvas.addEventListener('touchmove', (e) => {
            if (e.touches.length > 0) {
                const rect = canvas.getBoundingClientRect();
                mouse.x = e.touches[0].clientX - rect.left;
                mouse.y = e.touches[0].clientY - rect.top;
            }
        }, { passive: true });

        canvas.addEventListener('touchend', onMouseLeave);
    }

    // DOM hazır olduğunda başlat
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }

    // Sayfa gizlendiğinde animasyonu durdur (pil/performans için)
    document.addEventListener('visibilitychange', () => {
        if (document.hidden) {
            cancelAnimationFrame(animationId);
        } else {
            startTime = null;
            animationId = requestAnimationFrame(draw);
        }
    });

})();
