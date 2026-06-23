@extends('layouts.app')

@section('title', "Odanys Media | Filmmaker & Creative Director")

@section('content')

    {{-- ── Hero ─────────────────────────────────────────── --}}
    <section class="hero-section">

        {{-- Cinematic background (swap div for <img> or <video> later) --}}
        <div class="hero-bg" aria-hidden="true"></div>

        {{-- Edge vignette --}}
        <div class="hero-vignette" aria-hidden="true"></div>

        {{-- Drifting light leak / warm glow --}}
        <div class="hero-light-leak" aria-hidden="true"></div>

        {{-- Animated film grain --}}
        <div class="hero-grain" aria-hidden="true"></div>

        {{-- Content --}}
        <div class="hero-content">

            <p class="hero-eyebrow">Filmmaker & Creative Director</p>

            <h1 class="hero-name">
                <span class="hero-name-line">Odanys</span>
                <span class="hero-name-line">Media</span>
            </h1>

            <div class="hero-divider"></div>

            <p class="hero-subtitle">Filmmaker&nbsp;&bull;&nbsp;Creative Director&nbsp;&bull;&nbsp;Visual Storytelling</p>

            <div class="hero-buttons">
                <a href="#work" class="btn-film btn-film-primary">View My Work <span class="btn-arrow" aria-hidden="true">→</span></a>
                <a href="#contact" class="btn-film btn-film-secondary">Contact Me</a>
            </div>

        </div>

        {{-- Scroll indicator --}}
        <a href="#about" class="hero-scroll" aria-label="Scroll to next section">
            <span class="hero-scroll-label">Scroll</span>
            <span class="hero-scroll-line"></span>
        </a>

    </section>


    {{-- ── About ────────────────────────────────────────── --}}
    <section id="about" class="about-section">
        <div class="about-glow" aria-hidden="true"></div>
        <div class="container">
            <div class="row align-items-center g-5">

                {{-- Image column --}}
                <div class="col-lg-5 order-lg-1 about-img-wrapper">
                    <div class="about-img-frame">
                        <span class="fc fc-tl" aria-hidden="true"></span>
                        <span class="fc fc-tr" aria-hidden="true"></span>
                        <span class="fc fc-bl" aria-hidden="true"></span>
                        <span class="fc fc-br" aria-hidden="true"></span>
                        <div class="about-img-inner">
                            <img src="/images/aboutme.webp"
                                 alt="Odanys De La Cruz, Filmmaker"
                                 class="about-photo"
                                 loading="lazy"
                                 sizes="(max-width: 768px) 100vw, (max-width: 992px) 50vw, 41vw">
                            <div class="monitor-grain" aria-hidden="true"></div>
                            <div class="monitor-scan" aria-hidden="true"></div>
                            <div class="monitor-ui" aria-hidden="true">
                                <span class="mon-c mon-c-tl"></span>
                                <span class="mon-c mon-c-tr"></span>
                                <span class="mon-c mon-c-bl"></span>
                                <span class="mon-c mon-c-br"></span>
                                <span class="monitor-rec">
                                    <span class="monitor-rec-dot"></span>REC
                                </span>
                                <span class="monitor-tc">01:47:23:14</span>
                                <span class="monitor-label">ODC&nbsp;&middot;&nbsp;2024</span>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Text column --}}
                <div class="col-lg-7 order-lg-2">

                    <p class="section-eyebrow">About</p>
                    <h2 class="section-heading">The Director<br>Behind the Frame</h2>
                    <div class="section-divider"></div>

                    <p class="about-body">
                        I'm a Dominican filmmaker and creative director focused on creating cinematic
                        work that feels intentional and emotionally driven. From commercials to music
                        videos and branded content, I combine strong visuals with storytelling to
                        craft films that people connect with and remember.
                    </p>

                    <ul class="about-tags">
                        <li>Music Videos</li>
                        <li>Brand Films</li>
                        <li>Visual Content</li>
                        <li>Creative Direction</li>
                    </ul>

                </div>

            </div>
        </div>
    </section>


    {{-- ── Brands & Projects ───────────────────────────── --}}
    <section class="brands-section">

        <div class="brands-header container">
            <p class="section-eyebrow">Selected Work</p>
            <h2 class="section-heading">Brands &amp; Projects</h2>
            <div class="section-divider"></div>
        </div>

        <div class="brands-ticker">
            <div class="brands-track">
                <div class="brands-logo-wrap">
                    <img src="/images/brand-groom-harry.webp" alt="Groom by Harry" class="brands-logo" loading="lazy">
                </div>
                <div class="brands-logo-wrap">
                    <img src="/images/brand-merkaba.webp" alt="The Merkaba Method" class="brands-logo" loading="lazy">
                </div>
                <div class="brands-logo-wrap">
                    <img src="/images/brand-momo.webp" alt="Momo Tattoo Studio" class="brands-logo" loading="lazy">
                </div>
                <div class="brands-logo-wrap">
                    <img src="/images/brand-nk.webp" alt="NK" class="brands-logo" loading="lazy">
                </div>
                <div class="brands-logo-wrap">
                    <img src="/images/brand-new-era.webp" alt="New Era" class="brands-logo" loading="lazy">
                </div>
            </div>
        </div>


        <p class="brands-note container">
            A selection of commercial work, creative collaborations, and independent concept projects.
        </p>

    </section>


    {{-- ── Selected Work ────────────────────────────────── --}}
    <section id="work" class="work-section">
        <div class="container">

            {{-- Section header --}}
            <div class="work-header">
                <p class="section-eyebrow">Portfolio</p>
                <h2 class="section-heading">Selected Work</h2>
                <div class="section-divider mt-4 mb-0"></div>
            </div>

            {{-- ① Featured film frame (21:9 hero) --}}
            <div class="film-wrap mt-5" data-film-parallax="0.25">
                <article class="film-frame film-frame--featured" data-film-reveal="0" data-vimeo="1203313171">
                    <div class="film-img">
                        <div class="film-img-bg">
                            <img class="film-poster"
                                 src="/images/poster-me-llamas.webp"
                                 srcset="/images/poster-me-llamas-md.webp 960w, /images/poster-me-llamas.webp 1920w"
                                 sizes="(max-width: 992px) 100vw, 100vw"
                                 alt=""
                                 loading="lazy">
                        </div>
                    </div>
                    <span class="film-c film-c-tl" aria-hidden="true"></span>
                    <span class="film-c film-c-tr" aria-hidden="true"></span>
                    <span class="film-c film-c-bl" aria-hidden="true"></span>
                    <span class="film-c film-c-br" aria-hidden="true"></span>
                    <div class="film-overlay" aria-hidden="true"></div>
                    <div class="film-meta-top" aria-hidden="true">
                        <span class="film-num">A-01</span>
                        <span class="film-cat-badge">Music Video</span>
                        <span class="film-runtime">New York City</span>
                    </div>
                    <div class="film-content">
                        <h3 class="film-title">Me Llamas</h3>
                        <p class="film-desc">Music video for Yuyo, directed and shot in New York City. Rhythm, longing, and raw energy on every frame.</p>
                        <span class="film-cta">View Project <span class="btn-arrow" aria-hidden="true">→</span></span>
                    </div>
                </article>
            </div>

            {{-- ② + ③ Two smaller film frames --}}
            <div class="row g-4 mt-0">

                <div class="col-lg-6">
                    <div class="film-wrap" data-film-parallax="0.18">
                        <article class="film-frame film-frame--regular" data-film-reveal="0.14" data-vimeo="1203313238">
                            <div class="film-img">
                                <div class="film-img-bg">
                                    <img class="film-poster"
                                         src="/images/poster-pacto.webp"
                                         srcset="/images/poster-pacto-md.webp 960w, /images/poster-pacto.webp 1920w"
                                         sizes="(max-width: 992px) 100vw, 50vw"
                                         alt=""
                                         loading="lazy">
                                </div>
                            </div>
                            <span class="film-c film-c-tl" aria-hidden="true"></span>
                            <span class="film-c film-c-tr" aria-hidden="true"></span>
                            <span class="film-c film-c-bl" aria-hidden="true"></span>
                            <span class="film-c film-c-br" aria-hidden="true"></span>
                            <div class="film-overlay" aria-hidden="true"></div>
                            <div class="film-meta-top" aria-hidden="true">
                                <span class="film-num">A-02</span>
                                <span class="film-cat-badge">Music Video</span>
                                <span class="film-runtime">Dominican Republic</span>
                            </div>
                            <div class="film-content">
                                <h3 class="film-title">Pacto</h3>
                                <p class="film-desc">Music video for Makleen. Raw energy and cinematic storytelling.</p>
                                <span class="film-cta">View Project <span class="btn-arrow" aria-hidden="true">→</span></span>
                            </div>
                        </article>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="film-wrap" data-film-parallax="0.14">
                        <article class="film-frame film-frame--regular" data-film-reveal="0.28">
                            <div class="film-img">
                                <div class="film-img-bg" style="inset: 0;">
                                    <img class="film-poster"
                                         src="/images/poster-raices.webp"
                                         srcset="/images/poster-raices-md.webp 960w, /images/poster-raices.webp 1920w"
                                         sizes="(max-width: 992px) 100vw, 50vw"
                                         alt=""
                                         loading="lazy">
                                </div>
                            </div>
                            <span class="film-c film-c-tl" aria-hidden="true"></span>
                            <span class="film-c film-c-tr" aria-hidden="true"></span>
                            <span class="film-c film-c-bl" aria-hidden="true"></span>
                            <span class="film-c film-c-br" aria-hidden="true"></span>
                            <div class="film-overlay" aria-hidden="true"></div>
                            <div class="film-meta-top" aria-hidden="true">
                                <span class="film-num">A-03</span>
                                <span class="film-cat-badge">Brand Film</span>
                                <span class="film-runtime">New Era</span>
                            </div>
                            <div class="film-content">
                                <h3 class="film-title">Built Different</h3>
                                <p class="film-desc">Brand film for New Era. Identity, culture, and craft — built different.</p>
                                <span class="film-cta">Coming Soon <span class="btn-arrow" aria-hidden="true">→</span></span>
                            </div>
                        </article>
                    </div>
                </div>

            </div>{{-- /.row --}}

        </div>{{-- /.container --}}
    </section>


    {{-- ── Services ─────────────────────────────────────── --}}
    <section id="services" class="services-section">
        <div class="services-inner">

            {{-- Left: sidebar with header + tab list --}}
            <div class="srv-sidebar">
                <div class="srv-sidebar-hd">
                    <p class="section-eyebrow">What I Do</p>
                    <h2 class="srv-heading">Services</h2>
                </div>
                <nav class="srv-tabs" role="tablist" aria-label="Services navigation">
                    <button class="srv-tab is-active" role="tab" aria-selected="true"  data-srv-tab="0">
                        <span class="srv-tab-num">01</span>
                        <span class="srv-tab-name">Creative Direction</span>
                        <span class="srv-tab-arrow" aria-hidden="true">→</span>
                    </button>
                    <button class="srv-tab" role="tab" aria-selected="false" data-srv-tab="1">
                        <span class="srv-tab-num">02</span>
                        <span class="srv-tab-name">Music Videos</span>
                        <span class="srv-tab-arrow" aria-hidden="true">→</span>
                    </button>
                    <button class="srv-tab" role="tab" aria-selected="false" data-srv-tab="2">
                        <span class="srv-tab-num">03</span>
                        <span class="srv-tab-name">Brand Films</span>
                        <span class="srv-tab-arrow" aria-hidden="true">→</span>
                    </button>
                    <button class="srv-tab" role="tab" aria-selected="false" data-srv-tab="3" style="display:none">
                        <span class="srv-tab-num">04</span>
                        <span class="srv-tab-name">Social Content</span>
                        <span class="srv-tab-arrow" aria-hidden="true">→</span>
                    </button>
                </nav>
            </div>

            {{-- Right: stacked content panes --}}
            <div class="srv-panes">

                {{-- 01 Creative Direction --}}
                <div class="srv-pane is-active" role="tabpanel" data-srv-pane="0">
                    <div class="srv-pane-media">
                        <div class="srv-carousel">
                            <div class="srv-slide is-active">
                                <div class="srv-slide-bg" style="background-image: url('/images/srv-cd-1.webp');"></div>
                            </div>
                            <div class="srv-slide">
                                <div class="srv-slide-bg" style="background-image: url('/images/srv-cd-2.webp');"></div>
                            </div>
                            <div class="srv-slide">
                                <div class="srv-slide-bg" style="background-image: url('/images/srv-cd-3.webp');"></div>
                            </div>
                            <div class="srv-slide">
                                <div class="srv-slide-bg" style="background-image: url('/images/srv-cd-4.webp');"></div>
                            </div>
                            <div class="srv-slide">
                                <div class="srv-slide-bg" style="background-image: url('/images/srv-cd-5.webp');"></div>
                            </div>
                        </div>
                        <div class="srv-pane-overlay" aria-hidden="true"></div>
                        <button class="srv-car-btn srv-car-btn--prev" aria-label="Previous photo">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"/></svg>
                        </button>
                        <button class="srv-car-btn srv-car-btn--next" aria-label="Next photo">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"/></svg>
                        </button>
                        <div class="srv-car-dots"></div>
                    </div>
                    <div class="srv-pane-body">
                        <h3 class="srv-pane-title">Creative Direction</h3>
                        <p class="srv-pane-desc">Full-spectrum creative vision: moodboards, shot lists, and on-set direction. Every detail shaped so the look, feel, and story align perfectly.</p>
                        <ul class="srv-pane-features">
                            <li>Visual Identity</li>
                            <li>Moodboard &amp; Styling</li>
                            <li>Art Direction</li>
                        </ul>
                    </div>
                </div>

                {{-- 02 Music Videos --}}
                <div class="srv-pane" role="tabpanel" data-srv-pane="1">
                    <div class="srv-pane-media">
                        <div class="srv-carousel">
                            <div class="srv-slide is-active">
                                <div class="srv-slide-bg" style="background-image: url('/images/srv-mv-1.webp');"></div>
                            </div>
                            <div class="srv-slide">
                                <div class="srv-slide-bg" style="background-image: url('/images/srv-mv-2.webp');"></div>
                            </div>
                            <div class="srv-slide">
                                <div class="srv-slide-bg" style="background-image: url('/images/srv-mv-3.webp');"></div>
                            </div>
                            <div class="srv-slide">
                                <div class="srv-slide-bg" style="background-image: url('/images/srv-mv-4.webp');"></div>
                            </div>
                            <div class="srv-slide">
                                <div class="srv-slide-bg" style="background-image: url('/images/srv-mv-5.webp');"></div>
                            </div>
                            <div class="srv-slide">
                                <div class="srv-slide-bg" style="background-image: url('/images/srv-mv-6.webp');"></div>
                            </div>
                        </div>
                        <div class="srv-pane-overlay" aria-hidden="true"></div>
                        <button class="srv-car-btn srv-car-btn--prev" aria-label="Previous photo">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"/></svg>
                        </button>
                        <button class="srv-car-btn srv-car-btn--next" aria-label="Next photo">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"/></svg>
                        </button>
                        <div class="srv-car-dots"></div>
                    </div>
                    <div class="srv-pane-body">
                        <h3 class="srv-pane-title">Music Videos</h3>
                        <p class="srv-pane-desc">High-impact visuals that amplify your sound. From concept to final cut, every frame is crafted to command attention and leave a lasting impression.</p>
                        <ul class="srv-pane-features">
                            <li>Concept Development</li>
                            <li>On-Set Direction</li>
                            <li>Color Grading</li>
                        </ul>
                    </div>
                </div>

                {{-- 03 Brand Films --}}
                <div class="srv-pane srv-pane--square" role="tabpanel" data-srv-pane="2">
                    <div class="srv-pane-media srv-pane-media--square">
                        <div class="srv-carousel">
                            <div class="srv-slide is-active">
                                <div class="srv-slide-bg" style="background-image: url('/images/srv-bf-1.webp');"></div>
                            </div>
                            <div class="srv-slide">
                                <div class="srv-slide-bg" style="background-image: url('/images/srv-bf-2.webp');"></div>
                            </div>
                            <div class="srv-slide">
                                <div class="srv-slide-bg" style="background-image: url('/images/srv-bf-3.webp');"></div>
                            </div>
                        </div>
                        <div class="srv-pane-overlay" aria-hidden="true"></div>
                        <button class="srv-car-btn srv-car-btn--prev" aria-label="Previous photo">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"/></svg>
                        </button>
                        <button class="srv-car-btn srv-car-btn--next" aria-label="Next photo">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"/></svg>
                        </button>
                        <div class="srv-car-dots"></div>
                    </div>
                    <div class="srv-pane-body">
                        <h3 class="srv-pane-title">Brand Films</h3>
                        <p class="srv-pane-desc">Cinematic short films that tell your brand's story with depth and clarity. Visually rich narratives that build trust and elevate your identity.</p>
                        <ul class="srv-pane-features">
                            <li>Brand Strategy</li>
                            <li>Narrative Scripting</li>
                            <li>Post-Production</li>
                        </ul>
                    </div>
                </div>

                {{-- 04 Social Content --}}
                <div class="srv-pane" role="tabpanel" data-srv-pane="3" style="display:none">
                    <div class="srv-pane-media srv-pane-media--gradient">
                        <div class="srv-carousel">
                            {{-- slides go here when photos are ready --}}
                        </div>
                        <div class="srv-pane-overlay" aria-hidden="true"></div>
                        <button class="srv-car-btn srv-car-btn--prev" aria-label="Previous photo">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"/></svg>
                        </button>
                        <button class="srv-car-btn srv-car-btn--next" aria-label="Next photo">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"/></svg>
                        </button>
                        <div class="srv-car-dots"></div>
                    </div>
                    <div class="srv-pane-body">
                        <h3 class="srv-pane-title">Social Content</h3>
                        <p class="srv-pane-desc">Scroll-stopping reels, teasers, and campaign visuals engineered to perform. Built for the digital world, never at the cost of cinematic quality.</p>
                        <ul class="srv-pane-features">
                            <li>Short-Form Video</li>
                            <li>Campaign Shoots</li>
                            <li>Platform Strategy</li>
                        </ul>
                    </div>
                </div>

            </div>{{-- /.srv-panes --}}

        </div>{{-- /.services-inner --}}
    </section>


    {{-- ── Testimonials ─────────────────────────────────── --}}
    <section id="testimonials" class="tst-section">
        <div class="tst-glow" aria-hidden="true"></div>
        <div class="container">

            <div class="tst-header">
                <p class="section-eyebrow">What They Say</p>
                <h2 class="section-heading">Client Words</h2>
                <div class="section-divider"></div>
            </div>

            <div class="tst-grid">

                <div class="tst-card" data-tst-reveal data-tst-delay="0" data-tst-index="0">
                    <span class="tst-c tst-c-tl" aria-hidden="true"></span>
                    <span class="tst-c tst-c-tr" aria-hidden="true"></span>
                    <span class="tst-c tst-c-bl" aria-hidden="true"></span>
                    <span class="tst-c tst-c-br" aria-hidden="true"></span>
                    <div class="tst-mark" aria-hidden="true">"</div>
                    <p class="tst-quote">Working with Odanys was a complete game-changer. He understood the vision instantly and captured every bit of energy we wanted on screen. The final cut blew us away.</p>
                    <div class="tst-meta">
                        <span class="tst-name">Yuyo</span>
                        <span class="tst-sep" aria-hidden="true">—</span>
                        <span class="tst-role">Artist &middot; Music Video</span>
                    </div>
                </div>

                <div class="tst-card" data-tst-reveal data-tst-delay="0.12" data-tst-index="1">
                    <span class="tst-c tst-c-tl" aria-hidden="true"></span>
                    <span class="tst-c tst-c-tr" aria-hidden="true"></span>
                    <span class="tst-c tst-c-bl" aria-hidden="true"></span>
                    <span class="tst-c tst-c-br" aria-hidden="true"></span>
                    <div class="tst-mark" aria-hidden="true">"</div>
                    <p class="tst-quote">The level of professionalism and creative vision Odanys brings to every set is unmatched. He doesn't just direct — he elevates. Pacto came out better than anything we imagined.</p>
                    <div class="tst-meta">
                        <span class="tst-name">Makleen</span>
                        <span class="tst-sep" aria-hidden="true">—</span>
                        <span class="tst-role">Artist &middot; Music Video</span>
                    </div>
                </div>

                <div class="tst-card" data-tst-reveal data-tst-delay="0.24" data-tst-index="2">
                    <span class="tst-c tst-c-tl" aria-hidden="true"></span>
                    <span class="tst-c tst-c-tr" aria-hidden="true"></span>
                    <span class="tst-c tst-c-bl" aria-hidden="true"></span>
                    <span class="tst-c tst-c-br" aria-hidden="true"></span>
                    <div class="tst-mark" aria-hidden="true">"</div>
                    <p class="tst-quote">Odanys has an eye for detail that truly sets him apart. From the first conversation to final delivery, every step felt intentional. The result was pure cinema — exactly what our brand needed.</p>
                    <div class="tst-meta">
                        <span class="tst-name">Momo Tattoo Studio</span>
                        <span class="tst-sep" aria-hidden="true">—</span>
                        <span class="tst-role">Brand &middot; Commercial Ad</span>
                    </div>
                </div>

            </div>
        </div>
    </section>


    {{-- ── Contact ──────────────────────────────────────── --}}
    <section id="contact" class="contact-section">
        <div class="container">
            <div class="row g-5 align-items-start">

                {{-- Left: info --}}
                <div class="col-lg-5">
                    <p class="section-eyebrow">Get In Touch</p>
                    <h2 class="section-heading">Let's Create<br>Something</h2>
                    <div class="section-divider"></div>
                    <p class="contact-intro">
                        Have a project in mind? Whether it's a music video, brand film,
                        or something entirely new, reach out. I respond within 48 hours.
                    </p>
                    <div class="contact-details">
                        <div class="contact-detail-item">
                            <span class="contact-detail-label">Email</span>
                            <span class="contact-detail-value">hello@odanysmedia.com</span>
                        </div>
                        <div class="contact-detail-item">
                            <span class="contact-detail-label">Based In</span>
                            <span class="contact-detail-value">United States, NY</span>
                        </div>
                        <div class="contact-detail-item">
                            <span class="contact-detail-label">Response Time</span>
                            <span class="contact-detail-value">Within 48 hours</span>
                        </div>
                    </div>
                </div>

                {{-- Right: form --}}
                <div class="col-lg-7">

                    {{-- Success banner --}}
                    @if(session('success'))
                        <div class="contact-success">
                            <span class="contact-success-check">&#10003;</span>
                            {{ session('success') }}
                        </div>
                    @endif

                    {{-- Error summary --}}
                    @if($errors->any())
                        <div class="contact-error-banner">
                            Please correct the highlighted fields and try again.
                        </div>
                    @endif

                    <form action="{{ route('contact.send') }}" method="POST"
                          class="contact-form" novalidate>
                        @csrf

                        {{-- Honeypot — hidden from humans, visible to bots --}}
                        <div style="display:none" aria-hidden="true">
                            <label for="website">Leave this empty</label>
                            <input type="text" id="website" name="website"
                                   tabindex="-1" autocomplete="off">
                        </div>

                        <div class="row g-3">

                            {{-- Full Name --}}
                            <div class="col-md-6">
                                <div class="cf-group @error('name') cf-has-error @enderror">
                                    <label class="cf-label">Full Name</label>
                                    <input type="text" name="name"
                                           class="cf-input"
                                           value="{{ old('name') }}"
                                           placeholder="Your full name">
                                    @error('name')
                                        <span class="cf-error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            {{-- Email --}}
                            <div class="col-md-6">
                                <div class="cf-group @error('email') cf-has-error @enderror">
                                    <label class="cf-label">Email Address</label>
                                    <input type="email" name="email"
                                           class="cf-input"
                                           value="{{ old('email') }}"
                                           placeholder="your@email.com">
                                    @error('email')
                                        <span class="cf-error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            {{-- Project Type --}}
                            <div class="col-12">
                                <div class="cf-group @error('project_type') cf-has-error @enderror">
                                    <label class="cf-label">Project Type</label>
                                    <select name="project_type" class="cf-input cf-select">
                                        <option value="" disabled {{ old('project_type') ? '' : 'selected' }}>
                                            Select a service...
                                        </option>
                                        @foreach(['Music Video','Brand Film','Social Media Content','Commercial','Creative Direction','Other'] as $type)
                                            <option value="{{ $type }}"
                                                {{ old('project_type') === $type ? 'selected' : '' }}>
                                                {{ $type }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('project_type')
                                        <span class="cf-error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            {{-- Message --}}
                            <div class="col-12">
                                <div class="cf-group @error('message') cf-has-error @enderror">
                                    <label class="cf-label">Message</label>
                                    <textarea name="message" class="cf-input cf-textarea"
                                              rows="5"
                                              placeholder="Tell me about your project...">{{ old('message') }}</textarea>
                                    @error('message')
                                        <span class="cf-error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            {{-- Submit --}}
                            <div class="col-12">
                                <button type="submit" class="btn-film btn-film-primary btn-film-wide contact-submit">
                                    Let's Create Something <span class="btn-arrow" aria-hidden="true">→</span>
                                </button>
                            </div>

                        </div>{{-- /.row --}}
                    </form>

                </div>{{-- /.col form --}}
            </div>{{-- /.row --}}
        </div>{{-- /.container --}}
    </section>


{{-- Vimeo lightbox modal --}}
<div id="vimeo-modal" class="vimeo-modal" aria-hidden="true" role="dialog" aria-modal="true" aria-label="Video player">
    <div class="vimeo-modal-backdrop"></div>
    <button class="vimeo-modal-close" aria-label="Close video">&times;</button>
    <div class="vimeo-modal-frame">
        <div class="vimeo-modal-ratio">
            <iframe id="vimeo-iframe"
                    src=""
                    frameborder="0"
                    allow="autoplay; fullscreen; picture-in-picture; clipboard-write"
                    allowfullscreen></iframe>
        </div>
    </div>
</div>

@endsection

{{-- Auto-scroll to #contact after submit --}}
@if(session('success') || $errors->any())
    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                document.querySelector('#contact')
                    ?.scrollIntoView({ behavior: 'smooth', block: 'start' });
            });
        </script>
    @endpush
@endif
