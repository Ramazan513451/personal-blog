/**
 * scroll.js — Scroll Efektleri, Smooth Scroll & Scroll Spy
 * Ramazan Vural · Antigravity Blog & Portfolyo
 */

(function () {
    'use strict';

    // ─── Navbar Scroll Efekti ────────────────────────────────────────────────
    const navbar = document.getElementById('navbar');

    function handleNavbarScroll() {
        if (!navbar) return;
        if (window.scrollY > 20) {
            navbar.classList.add('scrolled');
        } else {
            navbar.classList.remove('scrolled');
        }
    }

    // ─── Scroll-to-Top Butonu ────────────────────────────────────────────────
    const scrollTopBtn = document.querySelector('.scroll-to-top');

    function handleScrollTopBtn() {
        if (!scrollTopBtn) return;
        if (window.scrollY > 500) {
            scrollTopBtn.classList.add('visible');
        } else {
            scrollTopBtn.classList.remove('visible');
        }
    }

    if (scrollTopBtn) {
        scrollTopBtn.addEventListener('click', () => {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    }

    // ─── Scroll Spy — Aktif Nav Linkini Güncelle ─────────────────────────────
    const navLinks = document.querySelectorAll('.nav-link[href*="#"]');
    const sections = [];

    navLinks.forEach(link => {
        const id = link.getAttribute('href').split('#')[1];
        if (id) {
            const section = document.getElementById(id);
            if (section) sections.push({ id, section, link });
        }
    });

    function updateActiveNavLink() {
        if (sections.length === 0) return;

        const scrollY     = window.scrollY;
        const navHeight   = navbar ? navbar.offsetHeight : 72;
        const windowMid   = scrollY + navHeight + 100;

        let current = null;

        sections.forEach(({ section, id }) => {
            const top    = section.offsetTop;
            const bottom = top + section.offsetHeight;
            if (windowMid >= top && windowMid < bottom) {
                current = id;
            }
        });

        sections.forEach(({ link, id }) => {
            if (id === current) {
                link.classList.add('active');
            } else {
                link.classList.remove('active');
            }
        });
    }

    // ─── Scroll Reveal — Intersection Observer ───────────────────────────────
    const revealElements = document.querySelectorAll(
        '.reveal-on-scroll, .reveal-left, .reveal-right'
    );

    if (revealElements.length > 0 && 'IntersectionObserver' in window) {
        const revealObserver = new IntersectionObserver(
            (entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('revealed');
                        // Bir kere gösterildikten sonra gözlemciyi kaldır
                        revealObserver.unobserve(entry.target);
                    }
                });
            },
            {
                threshold:   0.12,   // %12'si görününce tetikle
                rootMargin: '0px 0px -60px 0px',  // Alt kenardan biraz önce
            }
        );

        revealElements.forEach(el => revealObserver.observe(el));
    } else {
        // IntersectionObserver desteklenmiyor — hepsini göster
        revealElements.forEach(el => el.classList.add('revealed'));
    }

    // ─── Proje Kartları — Staggered Reveal ──────────────────────────────────
    const projectCards = document.querySelectorAll('.project-card');

    if (projectCards.length > 0 && 'IntersectionObserver' in window) {
        const cardObserver = new IntersectionObserver(
            (entries) => {
                entries.forEach((entry, i) => {
                    if (entry.isIntersecting) {
                        // Kaskad gecikmesi
                        const card  = entry.target;
                        const delay = Array.from(projectCards).indexOf(card) * 100;
                        setTimeout(() => {
                            card.style.animationDelay = delay + 'ms';
                            card.classList.add('revealed');
                        }, delay);
                        cardObserver.unobserve(card);
                    }
                });
            },
            { threshold: 0.1 }
        );

        projectCards.forEach(card => {
            card.style.opacity = '0';
            cardObserver.observe(card);
        });
    }

    // ─── Smooth Scroll — Anchor Linkleri ─────────────────────────────────────
    document.querySelectorAll('a[href*="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            const href  = this.getAttribute('href');
            const hash  = href.includes('#') ? '#' + href.split('#')[1] : null;

            if (!hash || hash === '#') return;

            // Aynı sayfa içi link mi?
            const targetId = hash.substring(1);
            const target   = document.getElementById(targetId);

            if (target) {
                e.preventDefault();
                const navH   = navbar ? navbar.offsetHeight : 72;
                const top    = target.getBoundingClientRect().top + window.scrollY - navH - 20;
                window.scrollTo({ top, behavior: 'smooth' });
            }
        });
    });

    // ─── Ana Scroll Dinleyicisi (throttled) ──────────────────────────────────
    let scrollTicking = false;

    function onScroll() {
        if (!scrollTicking) {
            requestAnimationFrame(() => {
                handleNavbarScroll();
                handleScrollTopBtn();
                updateActiveNavLink();
                scrollTicking = false;
            });
            scrollTicking = true;
        }
    }

    window.addEventListener('scroll', onScroll, { passive: true });

    // ─── İlk Çalıştırma ──────────────────────────────────────────────────────
    handleNavbarScroll();
    handleScrollTopBtn();
    updateActiveNavLink();

})();
