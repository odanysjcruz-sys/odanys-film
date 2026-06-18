<footer class="site-footer">
    <div class="container">

        {{-- Top three-column area --}}
        <div class="footer-top">

            {{-- Brand --}}
            <div class="footer-brand">
                <a href="#" class="footer-logo-link" aria-label="Odanys Media">
                    <img src="/images/logo.png" alt="Odanys Media" class="footer-logo-img">
                </a>
                <p class="footer-tagline">
                    Filmmaker&nbsp;&bull;&nbsp;Creative Director<br>
                    Visual Storytelling
                </p>
                <p class="footer-location">
                    <span class="footer-location-dot" aria-hidden="true"></span>
                    United States, NY
                </p>
            </div>

            {{-- Navigation --}}
            <nav class="footer-col" aria-label="Footer navigation">
                <p class="footer-col-label">Navigate</p>
                <ul class="footer-nav-list">
                    <li><a href="#about"    class="footer-nav-link">About</a></li>
                    <li><a href="#work"     class="footer-nav-link">Work</a></li>
                    <li><a href="#services" class="footer-nav-link">Services</a></li>
                    <li><a href="#contact"  class="footer-nav-link">Contact</a></li>
                </ul>
            </nav>

            {{-- Connect --}}
            <div class="footer-col">
                <p class="footer-col-label">Connect</p>
                <a href="mailto:odanysj.cruz@gmail.com" class="footer-email">
                    odanysj.cruz@gmail.com
                </a>
                <div class="footer-social">
                    <a href="#" class="footer-social-link" aria-label="Instagram" target="_blank" rel="noopener noreferrer">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <rect x="2" y="2" width="20" height="20" rx="5.5"/>
                            <circle cx="12" cy="12" r="5"/>
                            <circle cx="17.5" cy="6.5" r="0.8" fill="currentColor" stroke="none"/>
                        </svg>
                        Instagram
                    </a>
                    <a href="#" class="footer-social-link" aria-label="YouTube" target="_blank" rel="noopener noreferrer">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <path d="M22.54 6.42a2.78 2.78 0 0 0-1.95-1.95C18.88 4 12 4 12 4s-6.88 0-8.59.46a2.78 2.78 0 0 0-1.95 1.96A29 29 0 0 0 1 12a29 29 0 0 0 .46 5.58A2.78 2.78 0 0 0 3.41 19.6C5.12 20 12 20 12 20s6.88 0 8.59-.46a2.78 2.78 0 0 0 1.95-1.96A29 29 0 0 0 23 12a29 29 0 0 0-.46-5.58z"/>
                            <polygon points="9.75 15.02 15.5 12 9.75 8.98 9.75 15.02" fill="currentColor" stroke="none"/>
                        </svg>
                        YouTube
                    </a>
                </div>
            </div>

        </div>{{-- /.footer-top --}}

        {{-- Divider --}}
        <div class="footer-divider" aria-hidden="true"></div>

        {{-- Bottom bar --}}
        <div class="footer-bottom">
            <p class="footer-copy">&copy; {{ date('Y') }} Odanys Media. All rights reserved.</p>
            <p class="footer-credit">Crafted with vision.</p>
        </div>

    </div>
</footer>
