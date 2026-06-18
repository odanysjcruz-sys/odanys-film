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
                            <img src="/images/aboutme.jpeg"
                                 alt="Odanys De La Cruz, Filmmaker"
                                 class="about-photo">
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
                        I'm a Dominican filmmaker and creative director driven by a relentless
                        pursuit of cinematic excellence. Every project I take on, from high-energy
                        music videos to polished brand films and social content, is treated as a
                        deliberate narrative experience. Raw authenticity meets premium aesthetics,
                        producing imagery that resonates long after the screen goes dark.
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
                <article class="film-frame film-frame--featured" data-film-reveal="0">
                    <div class="film-img">
                        {{-- Gradient shows until hover; video fades in on hover --}}
                        <div class="film-img-bg"
                             style="background: linear-gradient(160deg, #12061a 0%, #08040c 45%, #0a0810 100%);">
                            <video class="film-video" muted loop playsinline preload="none">
                                <source src="/videos/me-llamas-yuyo.mp4" type="video/mp4">
                            </video>
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
                        <article class="film-frame film-frame--regular" data-film-reveal="0.14">
                            <div class="film-img">
                                <div class="film-img-bg"
                                     style="background: linear-gradient(160deg, #0a0e1a 0%, #060810 45%, #0c0a18 100%);">
                                    <video class="film-video" muted loop playsinline preload="none">
                                        <source src="/videos/pacto-makleen.mp4" type="video/mp4">
                                    </video>
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
                                <div class="film-img-bg"
                                     style="background: linear-gradient(160deg, #080618 0%, #050410 45%, #0a0a1a 100%);"></div>
                            </div>
                            <span class="film-c film-c-tl" aria-hidden="true"></span>
                            <span class="film-c film-c-tr" aria-hidden="true"></span>
                            <span class="film-c film-c-bl" aria-hidden="true"></span>
                            <span class="film-c film-c-br" aria-hidden="true"></span>
                            <div class="film-overlay" aria-hidden="true"></div>
                            <div class="film-meta-top" aria-hidden="true">
                                <span class="film-num">A-03</span>
                                <span class="film-cat-badge">Brand Film</span>
                                <span class="film-runtime">6:08</span>
                            </div>
                            <div class="film-content">
                                <h3 class="film-title">Ra&iacute;ces</h3>
                                <p class="film-desc">A cultural brand film celebrating Dominican heritage and visual identity.</p>
                                <span class="film-cta">View Project <span class="btn-arrow" aria-hidden="true">→</span></span>
                            </div>
                        </article>
                    </div>
                </div>

            </div>{{-- /.row --}}

        </div>{{-- /.container --}}
    </section>


    {{-- ── Services ─────────────────────────────────────── --}}
    <section id="services" class="services-section">

        {{-- Sticky full-viewport stage --}}
        <div class="srv-stage">

            {{-- Section header — floats above panels --}}
            <div class="srv-header">
                <p class="section-eyebrow">What I Do</p>
                <h2 class="srv-heading">Services</h2>
            </div>

            {{-- Horizontal panel accordion --}}
            <div class="srv-panels">

                {{-- 01 Music Videos --}}
                <div class="srv-panel is-active" data-srv-index="0" data-num="01">
                    <div class="srv-panel-bg" style="background: linear-gradient(155deg, #130428 0%, #09021a 45%, #05060a 100%);"></div>
                    <div class="srv-panel-inner">
                        <div class="srv-panel-top">
                            <span class="srv-panel-num">01</span>
                            <span class="srv-panel-eyebrow">Music Videos</span>
                        </div>
                        <div class="srv-panel-body">
                            <h3 class="srv-panel-title">Music<br>Videos</h3>
                            <p class="srv-panel-desc">High-impact visuals that amplify your sound. From concept to final cut, every frame is crafted to command attention and leave a lasting impression.</p>
                            <ul class="srv-panel-features">
                                <li>Concept Development</li>
                                <li>On-Set Direction</li>
                                <li>Color Grading</li>
                            </ul>
                        </div>
                    </div>
                </div>

                {{-- 02 Brand Films --}}
                <div class="srv-panel" data-srv-index="1" data-num="02">
                    <div class="srv-panel-bg" style="background: linear-gradient(155deg, #021326 0%, #010c1c 45%, #05060a 100%);"></div>
                    <div class="srv-panel-inner">
                        <div class="srv-panel-top">
                            <span class="srv-panel-num">02</span>
                            <span class="srv-panel-eyebrow">Brand Films</span>
                        </div>
                        <div class="srv-panel-body">
                            <h3 class="srv-panel-title">Brand<br>Films</h3>
                            <p class="srv-panel-desc">Cinematic short films that tell your brand's story with depth and clarity. Visually rich narratives that build trust and elevate your identity.</p>
                            <ul class="srv-panel-features">
                                <li>Brand Strategy</li>
                                <li>Narrative Scripting</li>
                                <li>Post-Production</li>
                            </ul>
                        </div>
                    </div>
                </div>

                {{-- 03 Social Media Content --}}
                <div class="srv-panel" data-srv-index="2" data-num="03">
                    <div class="srv-panel-bg" style="background: linear-gradient(155deg, #011420 0%, #010e18 45%, #05060a 100%);"></div>
                    <div class="srv-panel-inner">
                        <div class="srv-panel-top">
                            <span class="srv-panel-num">03</span>
                            <span class="srv-panel-eyebrow">Social Content</span>
                        </div>
                        <div class="srv-panel-body">
                            <h3 class="srv-panel-title">Social<br>Content</h3>
                            <p class="srv-panel-desc">Scroll-stopping reels, teasers, and campaign visuals engineered to perform. Built for the digital world, never at the cost of cinematic quality.</p>
                            <ul class="srv-panel-features">
                                <li>Short-Form Video</li>
                                <li>Campaign Shoots</li>
                                <li>Platform Strategy</li>
                            </ul>
                        </div>
                    </div>
                </div>

                {{-- 04 Creative Direction --}}
                <div class="srv-panel" data-srv-index="3" data-num="04">
                    <div class="srv-panel-bg" style="background: linear-gradient(155deg, #0b0524 0%, #06031a 45%, #05060a 100%);"></div>
                    <div class="srv-panel-inner">
                        <div class="srv-panel-top">
                            <span class="srv-panel-num">04</span>
                            <span class="srv-panel-eyebrow">Creative Direction</span>
                        </div>
                        <div class="srv-panel-body">
                            <h3 class="srv-panel-title">Creative<br>Direction</h3>
                            <p class="srv-panel-desc">Full-spectrum creative vision: moodboards, shot lists, and on-set direction. Every detail shaped so the look, feel, and story align perfectly.</p>
                            <ul class="srv-panel-features">
                                <li>Visual Identity</li>
                                <li>Moodboard &amp; Styling</li>
                                <li>Art Direction</li>
                            </ul>
                        </div>
                    </div>
                </div>

            </div>{{-- /.srv-panels --}}

            {{-- Navigation dots --}}
            <nav class="srv-nav" aria-label="Services navigation">
                <button class="srv-nav-dot is-active" data-srv-target="0" aria-label="Music Videos"></button>
                <button class="srv-nav-dot" data-srv-target="1" aria-label="Brand Films"></button>
                <button class="srv-nav-dot" data-srv-target="2" aria-label="Social Content"></button>
                <button class="srv-nav-dot" data-srv-target="3" aria-label="Creative Direction"></button>
            </nav>

        </div>{{-- /.srv-stage --}}

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
                            <span class="contact-detail-value">odanysj.cruz@gmail.com</span>
                        </div>
                        <div class="contact-detail-item">
                            <span class="contact-detail-label">Based In</span>
                            <span class="contact-detail-value">United Sstates NY</span>
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
