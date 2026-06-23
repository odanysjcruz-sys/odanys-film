import 'bootstrap';

// Navbar: glass on scroll + active section tracking + mobile toggle
const siteNav = document.getElementById('siteNav');

if (siteNav) {
    // ── Scroll: transparent → glass ──
    const onNavScroll = () => {
        siteNav.classList.toggle('is-scrolled', window.scrollY > 60);
    };
    window.addEventListener('scroll', onNavScroll, { passive: true });
    onNavScroll();

    // ── Active section tracking ──
    const navLinks  = Array.from(siteNav.querySelectorAll('.site-nav-link[data-section]'));
    const sections  = Array.from(document.querySelectorAll('section[id]'));

    if (navLinks.length && sections.length) {
        const activateLink = (id) => {
            navLinks.forEach(l => l.classList.toggle('is-active', l.dataset.section === id));
        };

        const trackSection = () => {
            const midY = window.scrollY + window.innerHeight * 0.38;
            let current = sections[0].id;
            sections.forEach(s => { if (s.offsetTop <= midY) current = s.id; });
            activateLink(current);
        };

        window.addEventListener('scroll', trackSection, { passive: true });
        trackSection();
    }

    // ── Mobile toggle ──
    const toggle   = siteNav.querySelector('.site-nav-toggle');
    const mobileEl = document.getElementById('siteNavMobile');

    if (toggle && mobileEl) {
        toggle.addEventListener('click', () => {
            const open = toggle.getAttribute('aria-expanded') === 'true';
            toggle.setAttribute('aria-expanded', String(!open));
            toggle.classList.toggle('is-open', !open);
            mobileEl.classList.toggle('is-open', !open);
            mobileEl.setAttribute('aria-hidden', String(open));
        });

        // Close on link click
        mobileEl.querySelectorAll('.site-nav-link').forEach(link => {
            link.addEventListener('click', () => {
                toggle.setAttribute('aria-expanded', 'false');
                toggle.classList.remove('is-open');
                mobileEl.classList.remove('is-open');
                mobileEl.setAttribute('aria-hidden', 'true');
            });
        });
    }
}

// Work section: scroll reveal for each film frame
const filmRevealFrames = document.querySelectorAll('[data-film-reveal]');
if (filmRevealFrames.length) {
    const revealObs = new IntersectionObserver(
        (entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const delay = parseFloat(entry.target.dataset.filmReveal) || 0;
                    entry.target.style.transitionDelay = `${delay}s`;
                    entry.target.classList.add('is-revealed');
                    setTimeout(() => { entry.target.style.transitionDelay = ''; }, (delay + 0.9) * 1000);
                } else {
                    entry.target.style.transitionDelay = '0s';
                    entry.target.classList.remove('is-revealed');
                }
            });
        },
        { threshold: 0.1 }
    );
    filmRevealFrames.forEach(el => revealObs.observe(el));
}

// Work section: Vimeo lightbox — open/close modal with embedded player
const vimeoModal  = document.getElementById('vimeo-modal');
const vimeoIframe = document.getElementById('vimeo-iframe');

if (vimeoModal && vimeoIframe) {
    const openModal = (vimeoId) => {
        vimeoIframe.src = `https://player.vimeo.com/video/${vimeoId}?autoplay=1&color=ffffff&title=0&byline=0&portrait=0`;
        vimeoModal.classList.add('is-open');
        vimeoModal.setAttribute('aria-hidden', 'false');
        document.body.classList.add('modal-open');
    };

    const closeModal = () => {
        vimeoIframe.src = '';
        vimeoModal.classList.remove('is-open');
        vimeoModal.setAttribute('aria-hidden', 'true');
        document.body.classList.remove('modal-open');
    };

    document.querySelectorAll('.film-frame[data-vimeo]').forEach(frame => {
        frame.addEventListener('click', () => openModal(frame.dataset.vimeo));
    });

    vimeoModal.querySelector('.vimeo-modal-backdrop').addEventListener('click', closeModal);
    vimeoModal.querySelector('.vimeo-modal-close').addEventListener('click', closeModal);

    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && vimeoModal.classList.contains('is-open')) closeModal();
    });
}

// Work section: hover-to-play video previews with auto-thumbnail
document.querySelectorAll('.film-frame').forEach(frame => {
    const video  = frame.querySelector('.film-video');
    if (!video) return;

    const source = video.querySelector('source');
    const bg     = frame.querySelector('.film-img-bg');

    // Probe a hidden copy of the video to capture the first frame as a thumbnail.
    // The main <video> stays at preload="none" — only the probe downloads data.
    if (source && bg) {
        const probe       = document.createElement('video');
        probe.muted       = true;
        probe.playsInline = true;
        probe.preload     = 'metadata';

        probe.addEventListener('loadedmetadata', () => {
            probe.currentTime = 0.5; // seek just past the very first frame
        });

        probe.addEventListener('seeked', () => {
            try {
                const canvas  = document.createElement('canvas');
                canvas.width  = probe.videoWidth  || 1920;
                canvas.height = probe.videoHeight || 1080;
                canvas.getContext('2d').drawImage(probe, 0, 0, canvas.width, canvas.height);
                bg.style.backgroundImage    = `url("${canvas.toDataURL('image/jpeg', 0.85)}")`;
                bg.style.backgroundSize     = 'cover';
                bg.style.backgroundPosition = 'center';
            } catch (_) { /* CORS guard — silently skip */ }
            probe.src = ''; // release memory
        }, { once: true });

        probe.src = source.getAttribute('src');
    }

    // Hover: fade video in over the thumbnail, fade out on leave
    frame.addEventListener('mouseenter', () => {
        video.play().then(() => video.classList.add('is-playing')).catch(() => {});
    });

    frame.addEventListener('mouseleave', () => {
        video.pause();
        video.currentTime = 0;
        video.classList.remove('is-playing');
    });
});

// Work section: parallax on inner image background
const filmParallaxWraps = document.querySelectorAll('[data-film-parallax]');
if (filmParallaxWraps.length) {
    let filmRafPending = false;

    const updateFilmParallax = () => {
        const viewH = window.innerHeight;
        filmParallaxWraps.forEach(wrap => {
            const bg = wrap.querySelector('.film-img-bg');
            if (!bg) return;
            const rect = wrap.getBoundingClientRect();
            const speed = parseFloat(wrap.dataset.filmParallax) || 0.2;
            const progress = (viewH - rect.top) / (viewH + rect.height);
            const offset = (progress - 0.5) * speed * 100;
            bg.style.translate = `0 ${offset}px`;
        });
        filmRafPending = false;
    };

    window.addEventListener('scroll', () => {
        if (filmRafPending) return;
        filmRafPending = true;
        requestAnimationFrame(updateFilmParallax);
    }, { passive: true });

    updateFilmParallax();
}

// Services: scroll reveal
const servicesSection = document.querySelector('.services-section');
if (servicesSection) {
    const srvRevealObs = new IntersectionObserver(
        ([entry]) => {
            if (entry.isIntersecting) {
                servicesSection.classList.add('in-view');
            } else {
                servicesSection.classList.remove('in-view');
            }
        },
        { threshold: 0.1 }
    );
    srvRevealObs.observe(servicesSection);
}

// Services: split-screen tab switcher
const srvTabsEl = document.querySelector('.srv-tabs');
if (srvTabsEl) {
    const tabs  = Array.from(srvTabsEl.querySelectorAll('.srv-tab'));
    const panes = Array.from(document.querySelectorAll('.srv-pane'));

    const activateTab = (index) => {
        tabs.forEach((t, i) => {
            t.classList.toggle('is-active', i === index);
            t.setAttribute('aria-selected', String(i === index));
        });
        panes.forEach((p, i) => {
            p.classList.toggle('is-active', i === index);
        });
    };

    tabs.forEach((tab, i) => {
        tab.addEventListener('click', () => activateTab(i));
    });
}

// Services: photo carousel inside each pane
document.querySelectorAll('.srv-pane-media').forEach(media => {
    const slides  = Array.from(media.querySelectorAll('.srv-slide'));
    const dotsEl  = media.querySelector('.srv-car-dots');
    const prevBtn = media.querySelector('.srv-car-btn--prev');
    const nextBtn = media.querySelector('.srv-car-btn--next');

    // Hide controls when 0 or 1 slides
    if (slides.length <= 1) {
        prevBtn?.classList.add('is-hidden');
        nextBtn?.classList.add('is-hidden');
        dotsEl?.classList.add('is-hidden');
        return;
    }

    let current = 0;

    // Build dots to match slide count
    if (dotsEl) {
        dotsEl.innerHTML = slides.map((_, i) =>
            `<button class="srv-car-dot${i === 0 ? ' is-active' : ''}" aria-label="Photo ${i + 1}"></button>`
        ).join('');
    }

    const dots = Array.from(dotsEl?.querySelectorAll('.srv-car-dot') ?? []);

    const goTo = (index) => {
        slides[current].classList.remove('is-active');
        dots[current]?.classList.remove('is-active');
        current = (index + slides.length) % slides.length;
        slides[current].classList.add('is-active');
        dots[current]?.classList.add('is-active');
    };

    prevBtn?.addEventListener('click', () => goTo(current - 1));
    nextBtn?.addEventListener('click', () => goTo(current + 1));
    dots.forEach((dot, i) => dot.addEventListener('click', () => goTo(i)));
});

// Brands section: reveal header on scroll into view
const brandsSection = document.querySelector('.brands-section');
if (brandsSection) {
    const brdObs = new IntersectionObserver(
        ([entry]) => {
            if (entry.isIntersecting) {
                brandsSection.classList.add('in-view');
            } else {
                brandsSection.classList.remove('in-view');
            }
        },
        { threshold: 0.1 }
    );
    brdObs.observe(brandsSection);
}

// Brands list: staggered row reveal
const brandsItems = document.querySelectorAll('[data-brands-reveal]');
if (brandsItems.length) {
    const brdItemObs = new IntersectionObserver(
        (entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const delay = parseFloat(entry.target.dataset.brandsDelay) || 0;
                    entry.target.style.transitionDelay = `${delay}s`;
                    entry.target.classList.add('is-revealed');
                    setTimeout(() => { entry.target.style.transitionDelay = ''; }, (delay + 0.7) * 1000);
                } else {
                    entry.target.style.transitionDelay = '0s';
                    entry.target.classList.remove('is-revealed');
                }
            });
        },
        { threshold: 0.1, rootMargin: '0px 0px -40px 0px' }
    );
    brandsItems.forEach(el => brdItemObs.observe(el));
}

// Testimonials: scroll reveal with staggered delay
const tstCards = document.querySelectorAll('[data-tst-reveal]');
if (tstCards.length) {
    const tstObs = new IntersectionObserver(
        (entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const delay = parseFloat(entry.target.dataset.tstDelay) || 0;
                    entry.target.style.transitionDelay = `${delay}s`;
                    entry.target.classList.add('is-revealed');
                    setTimeout(() => { entry.target.style.transitionDelay = ''; }, (delay + 0.85) * 1000);
                } else {
                    entry.target.style.transitionDelay = '0s';
                    entry.target.classList.remove('is-revealed');
                }
            });
        },
        { threshold: 0.12 }
    );
    tstCards.forEach(el => tstObs.observe(el));
}

// Contact section: scroll reveal
const contactSection = document.querySelector('.contact-section');
if (contactSection) {
    new IntersectionObserver(
        ([entry]) => {
            contactSection.classList.toggle('in-view', entry.isIntersecting);
        },
        { threshold: 0.08 }
    ).observe(contactSection);
}

// About section: IntersectionObserver reveal + parallax
const aboutSection = document.querySelector('.about-section');

if (aboutSection) {
    // Reveal on scroll into view
    const observer = new IntersectionObserver(
        ([entry]) => {
            if (entry.isIntersecting) {
                aboutSection.classList.add('in-view');
            } else {
                aboutSection.classList.remove('in-view');
            }
        },
        { threshold: 0.15 }
    );
    observer.observe(aboutSection);

    // Subtle parallax on the image column
    const imgWrapper = aboutSection.querySelector('.about-img-wrapper');
    if (imgWrapper) {
        let rafPending = false;
        const onScroll = () => {
            if (rafPending) return;
            rafPending = true;
            requestAnimationFrame(() => {
                const rect = aboutSection.getBoundingClientRect();
                const viewH = window.innerHeight;
                const progress = (viewH - rect.top) / (viewH + rect.height);
                const offset = (progress - 0.5) * 38;
                imgWrapper.style.transform = `translateY(${offset}px)`;
                rafPending = false;
            });
        };
        window.addEventListener('scroll', onScroll, { passive: true });
    }
}
