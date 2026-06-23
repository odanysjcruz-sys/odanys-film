<nav id="siteNav" class="site-nav">
    <div class="site-nav-inner">

        {{-- Logo --}}
        <a href="#" class="site-nav-logo" aria-label="Odanys Media — home">
            <img src="/images/odanys_logo_final.webp" alt="Odanys Media" class="site-nav-logo-img" loading="eager" fetchpriority="high">
        </a>

        {{-- Center nav links --}}
        <ul class="site-nav-links" role="list">
            <li><a href="#about"    class="site-nav-link" data-section="about">About</a></li>
            <li><a href="#work"     class="site-nav-link" data-section="work">Work</a></li>
            <li><a href="#services" class="site-nav-link" data-section="services">Services</a></li>
            <li><a href="#contact"  class="site-nav-link" data-section="contact">Contact</a></li>
        </ul>

        {{-- Right: social icons + mobile toggle --}}
        <div class="site-nav-right">

            <div class="site-nav-social" aria-label="Social links">

                <a href="#" class="site-nav-social-link" aria-label="Instagram" target="_blank" rel="noopener noreferrer">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <rect x="2" y="2" width="20" height="20" rx="5.5"/>
                        <circle cx="12" cy="12" r="5"/>
                        <circle cx="17.5" cy="6.5" r="0.8" fill="currentColor" stroke="none"/>
                    </svg>
                </a>

                <a href="#" class="site-nav-social-link" aria-label="LinkedIn" target="_blank" rel="noopener noreferrer">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"/>
                        <rect x="2" y="9" width="4" height="12"/>
                        <circle cx="4" cy="4" r="2"/>
                    </svg>
                </a>

                <a href="https://vimeo.com/user260222135" class="site-nav-social-link" aria-label="Vimeo" target="_blank" rel="noopener noreferrer">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                        <path d="M23.977 6.416c-.105 2.338-1.739 5.543-4.894 9.609-3.268 4.247-6.026 6.371-8.29 6.371-1.409 0-2.578-1.294-3.553-3.881L5.322 11.4C4.603 8.816 3.834 7.522 3.01 7.522c-.179 0-.806.378-1.881 1.132L0 7.197c1.185-1.044 2.351-2.084 3.501-3.128C5.08 2.701 6.266 1.983 7.055 1.91c1.867-.18 3.016 1.1 3.447 3.838.465 2.953.789 4.789.971 5.507.539 2.45 1.131 3.674 1.776 3.674.502 0 1.256-.796 2.265-2.385 1.004-1.589 1.54-2.797 1.612-3.628.144-1.371-.395-2.061-1.614-2.061-.574 0-1.167.121-1.777.391 1.186-3.868 3.434-5.757 6.762-5.637 2.473.06 3.628 1.664 3.48 4.807z"/>
                    </svg>
                </a>

                {{-- YouTube link — add channel URL when ready
                <a href="#" class="site-nav-social-link" aria-label="YouTube" target="_blank" rel="noopener noreferrer">
                    <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <path d="M22.54 6.42a2.78 2.78 0 0 0-1.95-1.95C18.88 4 12 4 12 4s-6.88 0-8.59.46a2.78 2.78 0 0 0-1.95 1.96A29 29 0 0 0 1 12a29 29 0 0 0 .46 5.58A2.78 2.78 0 0 0 3.41 19.6C5.12 20 12 20 12 20s6.88 0 8.59-.46a2.78 2.78 0 0 0 1.95-1.96A29 29 0 0 0 23 12a29 29 0 0 0-.46-5.58z"/>
                        <polygon points="9.75 15.02 15.5 12 9.75 8.98 9.75 15.02" fill="currentColor" stroke="none"/>
                    </svg>
                </a>
                --}}

            </div>

            {{-- Mobile hamburger --}}
            <button class="site-nav-toggle" aria-label="Toggle navigation" aria-expanded="false" aria-controls="siteNavMobile">
                <span class="site-nav-bar"></span>
                <span class="site-nav-bar"></span>
            </button>

        </div>

    </div>

    {{-- Mobile dropdown --}}
    <div class="site-nav-mobile" id="siteNavMobile" aria-hidden="true">
        <ul role="list">
            <li><a href="#about"    class="site-nav-link">About</a></li>
            <li><a href="#work"     class="site-nav-link">Work</a></li>
            <li><a href="#services" class="site-nav-link">Services</a></li>
            <li><a href="#contact"  class="site-nav-link">Contact</a></li>
        </ul>
    </div>
</nav>
