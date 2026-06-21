import 'bootstrap';

// Theme toggle — dark / light
const themeToggle = document.getElementById('themeToggle');
if (themeToggle) {
    themeToggle.addEventListener('click', () => {
        const current = document.documentElement.dataset.theme || 'dark';
        const next    = current === 'dark' ? 'light' : 'dark';
        document.documentElement.dataset.theme = next;
        localStorage.setItem('om-theme', next);
    });
}

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
                if (!entry.isIntersecting) return;
                const delay = parseFloat(entry.target.dataset.filmReveal) || 0;
                entry.target.style.transitionDelay = `${delay}s`;
                entry.target.classList.add('is-revealed');
                // Clear delay after animation so hover transitions stay snappy
                setTimeout(() => {
                    entry.target.style.transitionDelay = '';
                }, (delay + 0.9) * 1000);
                revealObs.unobserve(entry.target);
            });
        },
        { threshold: 0.1 }
    );
    filmRevealFrames.forEach(el => revealObs.observe(el));
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

// Services: scroll-driven cinematic horizontal accordion
const srvSection = document.querySelector('#services');
if (srvSection) {
    const srvPanels = Array.from(srvSection.querySelectorAll('.srv-panel'));
    const srvDots   = Array.from(srvSection.querySelectorAll('.srv-nav-dot'));
    let srvActive   = 0;
    let srvRaf      = false;

    const setSrvActive = (index) => {
        if (index === srvActive && srvPanels[index]?.classList.contains('is-active')) return;
        srvActive = index;
        srvPanels.forEach((p, i) => p.classList.toggle('is-active', i === index));
        srvDots.forEach((d, i)  => d.classList.toggle('is-active', i === index));
    };

    const isDesktop = () => window.innerWidth >= 992;

    // Slot size = total sticky scroll range divided by number of transitions (panels - 1)
    const getSrvSlotH = () =>
        (srvSection.offsetHeight - window.innerHeight) / (srvPanels.length - 1);

    const onSrvScroll = () => {
        if (!isDesktop()) return;
        const rect     = srvSection.getBoundingClientRect();
        const scrolled = Math.max(0, -rect.top);
        const slotH    = getSrvSlotH();
        const index    = Math.min(srvPanels.length - 1, Math.floor(scrolled / slotH));
        setSrvActive(index);

        // Parallax on the active panel background
        const activeBg = srvPanels[srvActive]?.querySelector('.srv-panel-bg');
        if (activeBg) {
            const totalScroll = slotH * (srvPanels.length - 1);
            const progress    = totalScroll > 0 ? scrolled / totalScroll : 0;
            activeBg.style.transform = `translateY(${(progress - 0.5) * 48}px)`;
        }
    };

    // Nav dot clicks — scroll to the corresponding slot on desktop, expand on mobile
    srvDots.forEach((dot, i) => {
        dot.addEventListener('click', () => {
            if (!isDesktop()) { setSrvActive(i); return; }
            const sectionTop = srvSection.getBoundingClientRect().top + window.scrollY;
            window.scrollTo({ top: sectionTop + i * getSrvSlotH(), behavior: 'smooth' });
        });
    });

    // Mobile: tap any panel to expand it
    srvPanels.forEach(panel => {
        panel.addEventListener('click', () => {
            if (isDesktop()) return;
            setSrvActive(parseInt(panel.dataset.srvIndex) || 0);
        });
    });

    // Throttled scroll handler
    window.addEventListener('scroll', () => {
        if (srvRaf || !isDesktop()) return;
        srvRaf = true;
        requestAnimationFrame(() => { onSrvScroll(); srvRaf = false; });
    }, { passive: true });

    setSrvActive(0);
    onSrvScroll();
}

// Brands section: reveal header on scroll into view
const brandsSection = document.querySelector('.brands-section');
if (brandsSection) {
    const brdObs = new IntersectionObserver(
        ([entry]) => {
            if (entry.isIntersecting) {
                brandsSection.classList.add('in-view');
                brdObs.unobserve(brandsSection);
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
                if (!entry.isIntersecting) return;
                const delay = parseFloat(entry.target.dataset.brandsDelay) || 0;
                entry.target.style.transitionDelay = `${delay}s`;
                entry.target.classList.add('is-revealed');
                setTimeout(() => { entry.target.style.transitionDelay = ''; }, (delay + 0.7) * 1000);
                brdItemObs.unobserve(entry.target);
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
                if (!entry.isIntersecting) return;
                const delay = parseFloat(entry.target.dataset.tstDelay) || 0;
                entry.target.style.transitionDelay = `${delay}s`;
                entry.target.classList.add('is-revealed');
                setTimeout(() => { entry.target.style.transitionDelay = ''; }, (delay + 0.85) * 1000);
                tstObs.unobserve(entry.target);
            });
        },
        { threshold: 0.12 }
    );
    tstCards.forEach(el => tstObs.observe(el));
}

// About section: IntersectionObserver reveal + parallax
const aboutSection = document.querySelector('.about-section');

if (aboutSection) {
    // Reveal on scroll into view
    const observer = new IntersectionObserver(
        ([entry]) => {
            if (entry.isIntersecting) {
                aboutSection.classList.add('in-view');
                observer.unobserve(aboutSection);
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
