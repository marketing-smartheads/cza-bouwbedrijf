/**
 * Front-end JavaScript
 *
 * The JavaScript code you place here will be processed by esbuild. The output
 * file will be created at `../theme/js/script.min.js` and enqueued in
 * `../theme/functions.php`.
 *
 * For esbuild documentation, please see:
 * https://esbuild.github.io/
 */
document.addEventListener("DOMContentLoaded", () => {
    // Header
    const header = document.querySelector('header');
    window.addEventListener('scroll', () => {
        header?.classList.toggle('is-fixed', window.scrollY > 100);
    });

    if (window.matchMedia("(max-width: 1279px)").matches) {
        const upper = document.querySelector(".site-header__upper");
        const inner = document.querySelector(".site-header__inner");
        const menu = document.querySelector(".menu");
        if (upper && inner && menu) {
            menu.style.height = `calc(50vh - ${upper.offsetHeight}px - ${inner.offsetHeight}px)`;
        }
    }
    
    // Hamburger
    const tham = document.querySelector(".tham");
    const mainNav = document.querySelector(".main-nav");
    if (tham && mainNav) {
        tham.addEventListener("click", () => {
            tham.classList.toggle("tham-active");
            mainNav.classList.toggle("is-active");
            document.body.classList.toggle("lock-scroll");
        });
    }
    
    // Hero
    document.querySelectorAll('.hero__video').forEach(video => {
        const loader = video.closest('.hero__video-wrapper')?.querySelector('.hero__video-loader');

        function hideLoader() {
            if (loader) loader.style.opacity = '0';
        }

        video.addEventListener('loadeddata', hideLoader);
        video.addEventListener('canplay', hideLoader);

        // fallback na 3 sec
        setTimeout(hideLoader, 3000);
    });

    // Popup
    const popup = document.getElementById("popup");
    const overlay = document.getElementById("popup-overlay");
    const closeBtn = document.getElementById("popup-close");

    if (!popup || !overlay || !closeBtn) return;

    const showPopup = () => {
        popup.classList.add("active");
        overlay.classList.add("active");
    };

    const closePopup = () => {
        popup.classList.remove("active");
        overlay.classList.remove("active");
    };

    setTimeout(showPopup, 60000);

    closeBtn.addEventListener("click", closePopup);
    overlay.addEventListener("click", closePopup);

    document.addEventListener("keydown", (e) => {
        if (e.key === "Escape") closePopup();
    });


    // Carousel
    document.querySelectorAll('[data-carousel]').forEach((carousel) => {
        const hasNav = carousel.hasAttribute('data-nav');
        const itemSelector = carousel.id === 'carouselGrid' ? '.inspiration__item' : '.scroll-card';
        const items = carousel.querySelectorAll(itemSelector);
        const gap = parseFloat(getComputedStyle(carousel).columnGap || getComputedStyle(carousel).gap || 0);
        let currentIndex = 0;
        let isDragging = false;
        let startX = 0;
        let scrollStart = 0;

        function getVisibleCount() {
            const w = window.innerWidth;
            if (w < 640) return 1;
            if (w < 1024) return 2;
            return 3;
        }

        function getItemWidth() {
            const item = items[0];
            return item ? item.getBoundingClientRect().width + gap : 0;
        }

        function updateTransform() {
            const maxIndex = items.length - getVisibleCount();
            if (currentIndex > maxIndex) currentIndex = 0;
            if (currentIndex < 0) currentIndex = maxIndex;
            carousel.style.transition = 'transform 0.3s ease-in-out';
            carousel.style.transform = `translateX(-${currentIndex * getItemWidth()}px)`;
        }

        // --- Navigation buttons ---
        if (hasNav) {
            const prev = document.querySelector('[data-carousel-prev]');
            const next = document.querySelector('[data-carousel-next]');
            if (prev && next) {
            prev.addEventListener('click', () => {
                currentIndex--;
                updateTransform();
            });
            next.addEventListener('click', () => {
                currentIndex++;
                updateTransform();
            });
            }
            window.addEventListener('resize', updateTransform);
            updateTransform();
        }

        // --- Native scroll (wheel) ---
        carousel.addEventListener('wheel', (e) => {
            if (!hasNav) {
            e.preventDefault();
            carousel.scrollLeft += e.deltaY;
            }
        }, { passive: false });

        // --- Drag / swipe ---
        carousel.addEventListener('mousedown', (e) => {
            isDragging = true;
            startX = e.pageX;
            scrollStart = hasNav ? null : carousel.scrollLeft;
            carousel.classList.add('is-dragging');
        });

        window.addEventListener('mousemove', (e) => {
            if (!isDragging) return;
            const delta = e.pageX - startX;
            if (hasNav) {
            carousel.style.transform = `translateX(calc(-${currentIndex * getItemWidth()}px + ${delta}px))`;
            } else {
            carousel.scrollLeft = scrollStart - delta;
            }
        });

        window.addEventListener('mouseup', (e) => {
            if (!isDragging) return;
            isDragging = false;
            carousel.classList.remove('is-dragging');
            const delta = e.pageX - startX;
            const threshold = 50;
            if (hasNav && Math.abs(delta) > threshold) {
            currentIndex += delta < 0 ? 1 : -1;
            updateTransform();
            }
        });

        // --- Touch swipe ---
        carousel.addEventListener('touchstart', (e) => {
            startX = e.touches[0].pageX;
            scrollStart = hasNav ? null : carousel.scrollLeft;
        }, { passive: true });

        carousel.addEventListener('touchmove', (e) => {
            const delta = e.touches[0].pageX - startX;
            if (hasNav) {
            carousel.style.transform = `translateX(calc(-${currentIndex * getItemWidth()}px + ${delta}px))`;
            } else {
            carousel.scrollLeft = scrollStart - delta;
            }
        }, { passive: true });

        carousel.addEventListener('touchend', (e) => {
            const delta = e.changedTouches[0].pageX - startX;
            const threshold = 50;
            if (hasNav && Math.abs(delta) > threshold) {
            currentIndex += delta < 0 ? 1 : -1;
            updateTransform();
            }
        });
    });

   
    // Carousel(s)
    function scrollCarousel(direction) {
        const track = document.getElementById('projectCarouselTrack');
        if (!track) return;

        const slide = track.querySelector('.project-carousel__slide');
        if (!slide) return;

        const slideWidth = slide.offsetWidth;
        track.scrollBy({ left: direction * slideWidth, behavior: 'smooth' });
    }

    window.scrollCarousel = scrollCarousel;

    document.querySelectorAll('.team-swiper').forEach((carousel) => {
        const autoplay = carousel.dataset.autoplay === "true";
        const speed = parseInt(carousel.dataset.speed) || 9500;

        new Swiper(carousel, {
            slidesPerView: 1,
            spaceBetween: 35,
            loop: true,
            speed: speed,
            autoplay: autoplay ? {
            delay: 0,
            disableOnInteraction: false,
            pauseOnMouseEnter: true
            } : false,
            freeMode: true,
            freeModeMomentum: false,
            breakpoints: {
            768: {
                slidesPerView: 2
            },
            1280: {
                slidesPerView: 3
            }
            }
        });
    });

    document.querySelectorAll('.tips-swiper').forEach((carousel) => {
        const autoplay = carousel.dataset.autoplay === "true";
        
        new Swiper(carousel, {
            slidesPerView: 1,
            spaceBetween: 30,
            loop: false, 
            speed: 300, 
            autoplay: false, 
            freeMode: true,
            freeModeMomentum: true, 
            breakpoints: {
                768: {
                    slidesPerView: 2
                },
                1280: {
                    slidesPerView: 3
                }
            }
        });
    });

    // Reveal animation
    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                const el = entry.target;
                const delay = parseInt(el.dataset.delay) || 0;

                setTimeout(() => {
                    el.classList.add("is-visible");
                }, delay);
                
                // Stop observing once triggered
                observer.unobserve(el);
            }
        });
    }, { threshold: 0.2 });

    document.querySelectorAll("[data-animate]").forEach((el) => observer.observe(el));

    // Animation
    initHeroAnimation();
    initCompanyAnimation();
    initCompanyTooltip();
    initScrollAnimations();
    
});



function initHeroAnimation() {
    const heroTitle = document.querySelector('.hero__title');
    const termsContainer = document.querySelector('.hero__terms');
    const terms = termsContainer?.querySelectorAll('.hero__term');
    const subtitle = document.querySelector('.hero__subtitle');
    const button = document.querySelector('.hero--button');

    if (!heroTitle) return;

    const leadingNode = heroTitle.childNodes[0];
    const fullText = leadingNode?.textContent.trim();
    if (!fullText) return;

    leadingNode.textContent = '';
    let i = 0;
    const speed = 100;

    const type = () => {
        if (i < fullText.length) {
            leadingNode.textContent += fullText.charAt(i);
            i++;
            setTimeout(type, speed);
        } else {
            revealTerms();
            startTermsRotation();
            slideInSubtitle();
            slideInButton();
        }
    };
    type();

    function revealTerms() {
        if (termsContainer) {
            termsContainer.style.visibility = 'visible';
        }
    }

    function startTermsRotation() {
        if (!termsContainer || terms.length < 2) return;
        let index = 0;
        terms.forEach((term, i) => {
            term.style.opacity = i === 0 ? '1' : '0';
            term.style.height = i === 0 ? '1.5em' : '0';
        });

        setInterval(() => {
            terms.forEach((term, i) => {
                term.style.opacity = i === index ? '1' : '0';
                term.style.height = i === index ? '1.5em' : '0';
            });
            index = (index + 1) % terms.length;
        }, 2550);
    }

    function slideInSubtitle() {
        if (subtitle) {
            subtitle.classList.add('animate-in');
        }
    }

    function slideInButton() {
        if (button) {
            button.classList.add('animate-in');
        }
    }
}

function initCompanyAnimation() {
    const companySection = document.querySelector('.company');
    const companyTitle = document.querySelector('.company__title');
    const companyImage = document.querySelector('.company__image');
    const companyDescription = document.querySelector('.company__description');
    const companyButton = document.querySelector('.company__cta-button');
    const originalText = companyTitle?.textContent || '';
    let typed = false;

    const activateCompany = () => {
        if (!companySection.classList.contains('company--active')) {
            companySection.classList.add('company--active');

            if (!typed && companyTitle) {
                companyTitle.textContent = '';
                companyTitle.style.opacity = '1';
                let i = 0;
                const interval = setInterval(() => {
                    companyTitle.textContent += originalText.charAt(i);
                    i++;
                    if (i >= originalText.length) {
                        clearInterval(interval);
                    }
                }, 120);
                typed = true;
            }
        }
    };

    // Desktop hover
    companySection?.addEventListener('mouseenter', activateCompany);

    // Mobiel scroll detectie
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                activateCompany();
            }
        });
    }, {
        threshold: 0.4 // pas aan voor eerder/later triggeren
    });

    if (companySection) {
        observer.observe(companySection);
    }
}

function initCompanyTooltip() {
    const labels = document.querySelectorAll('.label-trigger');
    const tooltip = document.getElementById('label-tooltip');
    const tooltipText = document.getElementById('label-tooltip-text');

    let lastClicked = null;
    let tooltipTimeout;

    labels.forEach(label => {
        label.addEventListener('click', function (e) {
            const isMobile = window.innerWidth < 640;
            const labelText = this.getAttribute('data-label');
            const linkUrl = this.getAttribute('href');
            const linkTarget = this.getAttribute('target') || '_self';

            if (isMobile) {
                e.preventDefault();

                if (lastClicked !== this) {
                    lastClicked = this;
                    tooltipText.textContent = labelText;
                    tooltip.classList.remove('opacity-0');

                    clearTimeout(tooltipTimeout);
                    tooltipTimeout = setTimeout(() => {
                        tooltip.classList.add('opacity-100');
                        lastClicked = null;
                    }, 3000);
                } else {
                    window.open(linkUrl, linkTarget);
                }
            }
        });
    });
}

function initScrollAnimations() {
  const elements = document.querySelectorAll('[data-animate]');
  const observer = new IntersectionObserver((entries, observer) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        const el = entry.target;
        const delay = parseFloat(el.dataset.delay) || 0;

        setTimeout(() => {
          el.classList.add('is-visible');
        }, delay * 1000);

        observer.unobserve(el);
      }
    });
  }, {
    threshold: 0.1,
    rootMargin: '0px 0px -10% 0px'
  });

  elements.forEach(el => observer.observe(el));
}

document.addEventListener('DOMContentLoaded', initScrollAnimations);
