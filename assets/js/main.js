/**
 * Prof. Festus Uwakhemen Asikhia - Portfolio
 * Main JavaScript
 */

document.addEventListener('DOMContentLoaded', function() {

    // ===== Preloader =====
    const preloader = document.querySelector('.preloader');
    if (preloader) {
        window.addEventListener('load', function() {
            setTimeout(function() {
                preloader.classList.add('hidden');
            }, 800);
        });
        // Fallback: hide after 3s if load event already fired
        setTimeout(function() {
            if (!preloader.classList.contains('hidden')) {
                preloader.classList.add('hidden');
            }
        }, 3000);
    }

    // ===== Navigation =====
    const navbar = document.querySelector('.navbar');
    const navToggle = document.querySelector('.nav-toggle');
    const navLinks = document.querySelector('.nav-links');

    // Mobile menu toggle
    if (navToggle) {
        navToggle.addEventListener('click', function(e) {
            e.stopPropagation();
            this.classList.toggle('active');
            navLinks.classList.toggle('open');
            document.body.style.overflow = navLinks.classList.contains('open') ? 'hidden' : '';
        });
    }

    // Close mobile menu on link click
    document.querySelectorAll('.nav-links a').forEach(link => {
        link.addEventListener('click', function() {
            navToggle.classList.remove('active');
            navLinks.classList.remove('open');
            document.body.style.overflow = '';
        });
    });

    // Close mobile menu on click outside
    document.addEventListener('click', function(e) {
        if (navLinks && navLinks.classList.contains('open')) {
            if (!navLinks.contains(e.target) && !navToggle.contains(e.target)) {
                navToggle.classList.remove('active');
                navLinks.classList.remove('open');
                document.body.style.overflow = '';
            }
        }
    });

    // Navbar scroll effect
    function updateNavbar() {
        if (window.scrollY > 80) {
            navbar.classList.add('scrolled');
        } else {
            navbar.classList.remove('scrolled');
        }
    }

    window.addEventListener('scroll', updateNavbar);
    updateNavbar();

    // Active nav link on scroll
    const sections = document.querySelectorAll('section[id]');
    const navAnchors = document.querySelectorAll('.nav-links a');

    function updateActiveNav() {
        let current = '';
        sections.forEach(section => {
            const sectionTop = section.offsetTop - 150;
            const sectionHeight = section.offsetHeight;
            if (window.scrollY >= sectionTop && window.scrollY < sectionTop + sectionHeight) {
                current = section.getAttribute('id');
            }
        });

        navAnchors.forEach(anchor => {
            anchor.classList.remove('active');
            if (anchor.getAttribute('href') === '#' + current) {
                anchor.classList.add('active');
            }
        });
    }

    window.addEventListener('scroll', updateActiveNav);

    // ===== Smooth scroll for anchor links =====
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            const targetId = this.getAttribute('href');
            if (targetId === '#') return;
            const target = document.querySelector(targetId);
            if (target) {
                e.preventDefault();
                const navHeight = window.innerWidth <= 768 ? 60 : 80;
                const offsetTop = target.offsetTop - navHeight;
                window.scrollTo({
                    top: offsetTop,
                    behavior: 'smooth'
                });
            }
        });
    });

    // ===== Scroll Reveal Animations =====
    const revealElements = document.querySelectorAll('.reveal, .reveal-left, .reveal-right, .reveal-scale, .stagger-children');

    function checkReveal() {
        const windowHeight = window.innerHeight;
        const revealPoint = 100;

        revealElements.forEach(el => {
            const elementTop = el.getBoundingClientRect().top;
            if (elementTop < windowHeight - revealPoint) {
                el.classList.add('visible');
            }
        });
    }

    window.addEventListener('scroll', checkReveal);
    window.addEventListener('load', checkReveal);
    checkReveal();

    // ===== Counter Animation =====
    function animateCounter(el) {
        const target = parseInt(el.getAttribute('data-target'));
        const duration = 2000;
        const step = Math.max(1, Math.floor(target / 60));
        let current = 0;

        const timer = setInterval(function() {
            current += step;
            if (current >= target) {
                el.textContent = target;
                clearInterval(timer);
            } else {
                el.textContent = current;
            }
        }, duration / 60);
    }

    // Intersection Observer for counters
    const counterObserver = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const counters = entry.target.querySelectorAll('.counter');
                counters.forEach(counter => animateCounter(counter));
                counterObserver.unobserve(entry.target);
            }
        });
    }, { threshold: 0.5 });

    document.querySelectorAll('.about-stats, .hero-stats').forEach(section => {
        counterObserver.observe(section);
    });

    // ===== Testimonials Slider =====
    let currentSlide = 0;
    const slides = document.querySelectorAll('.testimonial-slide');
    const dots = document.querySelectorAll('.testimonial-dot');

    function showSlide(index) {
        slides.forEach((slide, i) => {
            slide.style.display = i === index ? 'block' : 'none';
            slide.style.opacity = i === index ? '1' : '0';
            slide.style.transition = 'opacity 0.5s ease';
        });
        dots.forEach((dot, i) => {
            dot.classList.toggle('active', i === index);
        });
    }

    if (slides.length > 0) {
        // Set initial state
        slides.forEach(s => { s.style.opacity = '0'; });
        showSlide(0);

        dots.forEach((dot, i) => {
            dot.addEventListener('click', function() {
                currentSlide = i;
                showSlide(currentSlide);
            });
        });

        // Touch swipe support
        const slider = document.querySelector('.testimonials-slider');
        if (slider) {
            let startX = 0;
            let endX = 0;

            slider.addEventListener('touchstart', function(e) {
                startX = e.changedTouches[0].screenX;
            }, { passive: true });

            slider.addEventListener('touchend', function(e) {
                endX = e.changedTouches[0].screenX;
                const diff = startX - endX;
                if (Math.abs(diff) > 50) {
                    if (diff > 0 && currentSlide < slides.length - 1) {
                        currentSlide++;
                    } else if (diff < 0 && currentSlide > 0) {
                        currentSlide--;
                    }
                    showSlide(currentSlide);
                }
            }, { passive: true });
        }

        // Auto slide
        let autoSlideInterval = setInterval(function() {
            currentSlide = (currentSlide + 1) % slides.length;
            showSlide(currentSlide);
        }, 5000);

        // Pause auto slide on interaction
        dots.forEach(dot => {
            dot.addEventListener('click', function() {
                clearInterval(autoSlideInterval);
                autoSlideInterval = setInterval(function() {
                    currentSlide = (currentSlide + 1) % slides.length;
                    showSlide(currentSlide);
                }, 5000);
            });
        });
    }

    // ===== Contact Form =====
    const contactForm = document.getElementById('contactForm');
    const formMessage = document.getElementById('formMessage');

    if (contactForm) {
        contactForm.addEventListener('submit', function(e) {
            e.preventDefault();

            const formData = new FormData(this);
            const submitBtn = this.querySelector('.btn-primary');
            const originalText = submitBtn.textContent;

            submitBtn.textContent = 'Sending...';
            submitBtn.disabled = true;

            fetch('contact_process.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    formMessage.className = 'form-message success show';
                    formMessage.textContent = data.message;
                    contactForm.reset();
                } else {
                    formMessage.className = 'form-message error show';
                    formMessage.textContent = data.message;
                }
            })
            .catch(() => {
                formMessage.className = 'form-message error show';
                formMessage.textContent = 'An error occurred. Please try again later.';
            })
            .finally(() => {
                submitBtn.textContent = originalText;
                submitBtn.disabled = false;
                setTimeout(() => {
                    formMessage.classList.remove('show');
                }, 5000);
            });
        });
    }

    // ===== Back to Top Button =====
    const backToTop = document.querySelector('.back-to-top');

    if (backToTop) {
        window.addEventListener('scroll', function() {
            if (window.scrollY > 500) {
                backToTop.classList.add('visible');
            } else {
                backToTop.classList.remove('visible');
            }
        });

        backToTop.addEventListener('click', function() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    }

    // ===== Parallax effect for hero rings (desktop only) =====
    if (!('ontouchstart' in window) && !navigator.maxTouchPoints) {
        document.addEventListener('mousemove', function(e) {
            const rings = document.querySelectorAll('.hero-ring');
            const x = e.clientX / window.innerWidth;
            const y = e.clientY / window.innerHeight;

            rings.forEach((ring, index) => {
                const speed = (index + 1) * 8;
                const moveX = (x - 0.5) * speed;
                const moveY = (y - 0.5) * speed;
                ring.style.transform = `translate(calc(-50% + ${moveX}px), calc(-50% + ${moveY}px)) rotate(${moveX * 0.3}deg)`;
            });
        });
    }

    // ===== Typing effect for roles =====
    const rolesContainer = document.querySelector('.hero-roles');
    if (rolesContainer) {
        const tags = rolesContainer.querySelectorAll('.hero-role-tag');
        tags.forEach((tag, index) => {
            tag.style.opacity = '0';
            tag.style.transform = 'translateY(20px)';
            setTimeout(() => {
                tag.style.transition = 'all 0.6s ease';
                tag.style.opacity = '1';
                tag.style.transform = 'translateY(0)';
            }, 1000 + index * 200);
        });
    }

    // ===== See More / Show Less Toggle =====
    function setupSeeMore(btnId, hiddenClass) {
        const btn = document.getElementById(btnId);
        if (!btn) return;
        const items = document.querySelectorAll('.' + hiddenClass);
        btn.addEventListener('click', function() {
            const isExpanded = this.classList.toggle('expanded');
            items.forEach(item => {
                item.style.display = isExpanded ? 'block' : 'none';
            });
            this.innerHTML = isExpanded
                ? 'Show Less <i class="fas fa-chevron-up"></i>'
                : 'See More <i class="fas fa-chevron-down"></i>';
        });
    }
    setupSeeMore('seeMoreBooks', 'hidden-book');
    setupSeeMore('seeMoreJournal', 'hidden-journal');
    setupSeeMore('seeMoreArticles', 'hidden-article');

    console.log('%c Prof. Festus Uwakhemen Asikhia ',
        'background: #d4a843; color: #0a0e1a; font-size: 14px; font-weight: bold; padding: 10px 20px; border-radius: 4px;');
    console.log('%c Excellence is a continuous journey. ', 'color: #e2e8f0; font-size: 12px; font-style: italic;');
});
