/**
 * Insure Inc - Main JS
 */
(function () {
    'use strict';

    /* ---- Navbar: sticky + scroll class ---- */
    const header = document.getElementById('site-header');
    if (header) {
        window.addEventListener('scroll', () => {
            header.classList.toggle('scrolled', window.scrollY > 30);
        });
    }

    /* ---- Hamburger menu ---- */
    const hamburger = document.getElementById('hamburger');
    const navMenu   = document.getElementById('nav-menu');
    if (hamburger && navMenu) {
        hamburger.addEventListener('click', () => {
            const open = navMenu.classList.toggle('open');
            hamburger.setAttribute('aria-expanded', open);
            hamburger.classList.toggle('active', open);
        });

        // close on link click
        navMenu.querySelectorAll('a').forEach(link => {
            link.addEventListener('click', () => {
                navMenu.classList.remove('open');
                hamburger.setAttribute('aria-expanded', false);
            });
        });
    }

    /* ---- Smooth scroll for anchor links ---- */
    document.querySelectorAll('a[href*="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            const url   = new URL(this.href, location.href);
            const hash  = url.hash;
            if (!hash) return;
            const target = document.querySelector(hash);
            if (!target) return;
            e.preventDefault();
            const offset = 80;
            const top = target.getBoundingClientRect().top + window.scrollY - offset;
            window.scrollTo({ top, behavior: 'smooth' });
        });
    });

    /* ---- Scroll-triggered fade-up animations ---- */
    const fadeEls = document.querySelectorAll('.fade-up');
    if ('IntersectionObserver' in window) {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.12, rootMargin: '0px 0px -40px 0px' });

        fadeEls.forEach(el => observer.observe(el));
    } else {
        fadeEls.forEach(el => el.classList.add('visible'));
    }

    /* ---- FAQ Accordion ---- */
    document.querySelectorAll('.faq-question').forEach(btn => {
        btn.addEventListener('click', () => {
            const item    = btn.closest('.faq-item');
            const isOpen  = item.classList.contains('active');

            // Close all
            document.querySelectorAll('.faq-item.active').forEach(open => {
                open.classList.remove('active');
                open.querySelector('.faq-question').setAttribute('aria-expanded', false);
            });

            // Open clicked if was closed
            if (!isOpen) {
                item.classList.add('active');
                btn.setAttribute('aria-expanded', true);
                // scroll into view on mobile
                if (window.innerWidth < 768) {
                    setTimeout(() => item.scrollIntoView({ behavior: 'smooth', block: 'nearest' }), 350);
                }
            }
        });

        // keyboard a11y
        btn.addEventListener('keydown', e => {
            if (e.key === 'Enter' || e.key === ' ') { e.preventDefault(); btn.click(); }
        });
    });

    /* ---- AJAX: Policy Form ---- */
    const policyForm = document.getElementById('policy-form');
    if (policyForm) {
        policyForm.addEventListener('submit', function (e) {
            e.preventDefault();
            const msgEl = document.getElementById('policy-message');
            const btn   = this.querySelector('.form-submit');
            btn.textContent = 'Sending…';
            btn.disabled    = true;
            msgEl.textContent = '';

            const data = new FormData(this);
            data.append('action', 'insure_policy');
            data.append('nonce',  insureAjax.policy_nonce);

            fetch(insureAjax.url, { method: 'POST', body: data })
                .then(r => r.json())
                .then(res => {
                    msgEl.style.color = res.success ? '#22c55e' : '#ef4444';
                    msgEl.textContent = res.data.message;
                    if (res.success) policyForm.reset();
                })
                .catch(() => {
                    msgEl.style.color = '#ef4444';
                    msgEl.textContent = 'Something went wrong. Please try again.';
                })
                .finally(() => {
                    btn.textContent = 'SUBMIT';
                    btn.disabled    = false;
                });
        });
    }

    /* ---- AJAX: Contact Form ---- */
    const contactForm = document.getElementById('contact-form');
    if (contactForm) {
        contactForm.addEventListener('submit', function (e) {
            e.preventDefault();
            const msgEl = document.getElementById('contact-message-result');
            const btn   = this.querySelector('[type="submit"]');
            const original = btn.innerHTML;
            btn.innerHTML  = 'Sending…';
            btn.disabled   = true;
            msgEl.textContent = '';

            const data = new FormData(this);
            data.append('action', 'insure_contact');
            data.append('nonce',  insureAjax.contact_nonce);

            fetch(insureAjax.url, { method: 'POST', body: data })
                .then(r => r.json())
                .then(res => {
                    msgEl.style.color = res.success ? '#86efac' : '#fca5a5';
                    msgEl.textContent = res.data.message;
                    if (res.success) contactForm.reset();
                })
                .catch(() => {
                    msgEl.style.color = '#fca5a5';
                    msgEl.textContent = 'Something went wrong. Please try again.';
                })
                .finally(() => {
                    btn.innerHTML = original;
                    btn.disabled  = false;
                });
        });
    }

    /* ---- Active nav link on scroll ---- */
    const sections = document.querySelectorAll('section[id]');
    const navLinks  = document.querySelectorAll('.nav-menu a');
    window.addEventListener('scroll', () => {
        let current = '';
        sections.forEach(section => {
            if (window.scrollY >= section.offsetTop - 100) current = section.getAttribute('id');
        });
        navLinks.forEach(link => {
            link.classList.remove('active');
            if (link.getAttribute('href').includes(current)) link.classList.add('active');
        });
    }, { passive: true });

})();
