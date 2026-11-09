/**
 * main.js — Ana Etkileşim Mantığı
 * Ramazan Vural · Antigravity Blog & Portfolyo
 *
 * İçerik:
 *  - Hamburger menü toggle
 *  - Typing effect (hero subtitle)
 *  - İletişim formu client-side doğrulama
 *  - Form AJAX gönderimi
 */

(function () {
    'use strict';

    // ─── DOM Hazır olduğunda başlat ──────────────────────────────────────────
    document.addEventListener('DOMContentLoaded', function () {
        initHamburger();
        initTypingEffect();
        initContactForm();
    });

    // ═══════════════════════════════════════════════════════════════════════════
    // HAMBURGEr MENÜ
    // ═══════════════════════════════════════════════════════════════════════════
    function initHamburger() {
        const hamburger  = document.getElementById('hamburger');
        const mobileMenu = document.getElementById('mobile-menu');
        if (!hamburger || !mobileMenu) return;

        hamburger.addEventListener('click', function () {
            const isOpen = mobileMenu.classList.contains('open');

            hamburger.classList.toggle('active');
            mobileMenu.classList.toggle('open');

            // Erişilebilirlik
            hamburger.setAttribute('aria-expanded', String(!isOpen));
            mobileMenu.setAttribute('aria-hidden', String(isOpen));
        });

        // Mobil menü linke tıklandığında kapat
        mobileMenu.querySelectorAll('.mobile-nav-link').forEach(link => {
            link.addEventListener('click', () => {
                hamburger.classList.remove('active');
                mobileMenu.classList.remove('open');
                hamburger.setAttribute('aria-expanded', 'false');
                mobileMenu.setAttribute('aria-hidden', 'true');
            });
        });

        // Dışarı tıklandığında kapat
        document.addEventListener('click', function (e) {
            if (!hamburger.contains(e.target) && !mobileMenu.contains(e.target)) {
                hamburger.classList.remove('active');
                mobileMenu.classList.remove('open');
                hamburger.setAttribute('aria-expanded', 'false');
                mobileMenu.setAttribute('aria-hidden', 'true');
            }
        });
    }

    // ═══════════════════════════════════════════════════════════════════════════
    // TYPING EFFECT — Hero Alt Başlık
    // ═══════════════════════════════════════════════════════════════════════════
    function initTypingEffect() {
        const el = document.getElementById('typing-text');
        if (!el) return;

        const strings = [
            'Full-Stack Developer',
            'Game Developer',
            'Pixel Art Creator',
            'Python & Django Engineer',
            'Unity & C# Developer',
            'ASP.NET Core Developer',
        ];

        let  stringIndex = 0;
        let  charIndex   = 0;
        let  isDeleting  = false;
        const typingSpeed   = 80;    // ms/karakter
        const deletingSpeed = 40;
        const pauseAfterType = 2000; // Yazıldıktan sonra bekleme
        const pauseAfterDelete = 400;

        function type() {
            const current = strings[stringIndex];

            if (isDeleting) {
                // Silme
                el.textContent = current.substring(0, charIndex - 1);
                charIndex--;
            } else {
                // Yazma
                el.textContent = current.substring(0, charIndex + 1);
                charIndex++;
            }

            let delay = isDeleting ? deletingSpeed : typingSpeed;

            if (!isDeleting && charIndex === current.length) {
                // Yazma tamamlandı — bekle sonra sil
                delay = pauseAfterType;
                isDeleting = true;
            } else if (isDeleting && charIndex === 0) {
                // Silme tamamlandı — sonraki stringe geç
                isDeleting = false;
                stringIndex = (stringIndex + 1) % strings.length;
                delay = pauseAfterDelete;
            }

            setTimeout(type, delay);
        }

        // Başlama gecikmesi (sayfa yüklendikten 1sn sonra)
        setTimeout(type, 1000);
    }

    // ═══════════════════════════════════════════════════════════════════════════
    // İLETİŞİM FORMU
    // ═══════════════════════════════════════════════════════════════════════════
    function initContactForm() {
        const form = document.getElementById('contact-form');
        if (!form) return;

        form.addEventListener('submit', function (e) {
            e.preventDefault();

            // Client-side doğrulama
            if (!validateForm(form)) return;

            // Gönder butonu durumu
            const submitBtn    = form.querySelector('[type="submit"]');
            const originalText = submitBtn.innerHTML;
            submitBtn.innerHTML = '<span class="spinner"></span> Gönderiliyor...';
            submitBtn.disabled  = true;

            const formData = new FormData(form);

            fetch('contact-handler.php', {
                method: 'POST',
                body:   formData,
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    showFormMessage(form, 'success', '✅ ' + data.message);
                    form.reset();
                } else {
                    showFormMessage(form, 'error', '❌ ' + data.message);
                }
            })
            .catch(() => {
                showFormMessage(form, 'error', '❌ Bir hata oluştu. Lütfen tekrar deneyin.');
            })
            .finally(() => {
                submitBtn.innerHTML = originalText;
                submitBtn.disabled  = false;
            });
        });

        // Real-time doğrulama (blur olduğunda)
        form.querySelectorAll('.form-input, .form-textarea').forEach(input => {
            input.addEventListener('blur', () => validateField(input));
            input.addEventListener('input', () => {
                if (input.classList.contains('error')) validateField(input);
            });
        });
    }

    // Form doğrulama
    function validateForm(form) {
        let valid = true;
        form.querySelectorAll('[required]').forEach(field => {
            if (!validateField(field)) valid = false;
        });
        return valid;
    }

    function validateField(field) {
        const value  = field.value.trim();
        let   error  = '';

        if (field.hasAttribute('required') && !value) {
            error = 'Bu alan zorunludur.';
        } else if (field.type === 'email' && value) {
            const emailRe = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRe.test(value)) error = 'Geçerli bir e-posta adresi girin.';
        } else if (field.name === 'message' && value && value.length < 10) {
            error = 'Mesajınız en az 10 karakter olmalıdır.';
        }

        const errorEl = field.parentElement.querySelector('.form-error');
        if (error) {
            field.classList.add('error');
            if (errorEl) { errorEl.textContent = error; errorEl.classList.add('visible'); }
            return false;
        } else {
            field.classList.remove('error');
            if (errorEl) { errorEl.textContent = ''; errorEl.classList.remove('visible'); }
            return true;
        }
    }

    // Form mesajı göster
    function showFormMessage(form, type, message) {
        let msgEl = form.querySelector('.form-message');
        if (!msgEl) {
            msgEl = document.createElement('div');
            msgEl.className = 'form-message';
            form.appendChild(msgEl);
        }
        msgEl.className  = 'form-message ' + type + ' success-animation';
        msgEl.textContent = message;

        // 6 saniye sonra gizle
        setTimeout(() => { msgEl.className = 'form-message'; }, 6000);
    }

})();
