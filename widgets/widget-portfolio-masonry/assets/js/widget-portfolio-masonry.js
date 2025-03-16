jQuery(document).ready(function($) {
    function initPortfolioMasonry() {
        // Check if GSAP is available
        if (typeof gsap === 'undefined') {
            console.warn('GSAP is not loaded. Loading from CDN...');
            loadScript('https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js', function() {
                loadScript('https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js', initAnimations);
            });
        } else {
            // If GSAP is already loaded, check for ScrollTrigger
            if (typeof ScrollTrigger === 'undefined') {
                console.warn('ScrollTrigger is not loaded. Loading from CDN...');
                loadScript('https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js', initAnimations);
            } else {
                initAnimations();
            }
        }
    }

    // Helper function to load scripts dynamically
    function loadScript(url, callback) {
        const script = document.createElement('script');
        script.src = url;
        script.onload = callback;
        document.head.appendChild(script);
    }

    function initAnimations() {
        if (typeof gsap !== 'undefined' && typeof ScrollTrigger !== 'undefined') {
            gsap.registerPlugin(ScrollTrigger);

            // Initialize GSAP animations for project cards with improved settings
            const projectCards = gsap.utils.toArray('.project-card');
            
            projectCards.forEach((card, index) => {
                // Make sure card is visible before animation
                gsap.set(card, { autoAlpha: 1 });

                let tl = gsap.timeline({
                    scrollTrigger: {
                        trigger: card,
                        start: "top center+=100",
                        end: "bottom center",
                        scrub: 1,
                        markers: false,
                        pin: false, // Disabled pinning to prevent content issues
                        onEnter: () => {
                            gsap.to(card, {
                                y: 0,
                                opacity: 1,
                                duration: 0.5,
                                ease: "power2.out"
                            });
                        },
                        onLeaveBack: () => {
                            gsap.to(card, {
                                y: 50,
                                opacity: 0.5,
                                duration: 0.5,
                                ease: "power2.in"
                            });
                        }
                    }
                });
            });
        }
    }

    // Initialize Portfolio Masonry
    initPortfolioMasonry();

    // Sticky tabs functionality
    const stickyTabs = document.getElementById('stickyTabs');
    if (stickyTabs) {
        const stickyOffset = stickyTabs.offsetTop;
        
        window.addEventListener('scroll', function() {
            if (window.pageYOffset > stickyOffset) {
                stickyTabs.classList.add('sticky');
            } else {
                stickyTabs.classList.remove('sticky');
            }
        });
    }
    
    // Tab functionality
    const tabBtns = document.querySelectorAll('.tab-btn');
    const tabContents = document.querySelectorAll('.tab-content');
    
    tabBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            tabBtns.forEach(btn => btn.classList.remove('active'));
            tabContents.forEach(content => content.classList.remove('active'));
            
            this.classList.add('active');
            const tabId = this.getAttribute('data-tab');
            document.getElementById(tabId).classList.add('active');
            
            const tabsContainer = document.querySelector('.tabs-container');
            const tabsContainerTop = tabsContainer.offsetTop - 20;
            // window.scrollTo({
            //     top: tabsContainerTop,
            //     behavior: 'smooth'
            // });
        });
    });
    
    // Initialize Swiper if it exists
    let swiper; // Declare swiper in outer scope
    if (typeof Swiper !== 'undefined') {
        swiper = new Swiper(".mySwiper", {
            slidesPerView: 1,
            spaceBetween: 30,
            keyboard: {
                enabled: true,
            },
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
                dynamicBullets: true,
            },
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
            effect: "fade",
            fadeEffect: {
                crossFade: true
            },
            speed: 0, // Set speed to 0 for instant transition
            grabCursor: true,
            watchSlidesProgress: true, // Add this to ensure slides are ready
            init: false // Prevent auto initialization
        });

        // Initialize swiper
        swiper.init();
    }
    
    // Modal functionality
    const modal = document.getElementById('imageModal');
    const closeModal = document.getElementById('closeModal');
    const galleryItems = document.querySelectorAll('.masonry-item');
    
    if (modal && closeModal && galleryItems.length > 0) {
        galleryItems.forEach(item => {
            item.addEventListener('click', function() {
                const img = item.querySelector('img');
                const index = parseInt(img.dataset.index);
                
                modal.style.display = 'block';
                document.body.style.overflow = 'hidden';
                
                // Check if swiper exists and is initialized
                if (swiper && typeof swiper.slideTo === 'function') {
                    // Set initial slide without animation
                    swiper.params.speed = 0;
                    swiper.slideTo(index, 0, false);
                    swiper.update();
                    // Reset speed for subsequent slides
                    swiper.params.speed = 500;
                }
            });
        });
        
        closeModal.addEventListener('click', function() {
            modal.style.display = 'none';
            document.body.style.overflow = 'auto';
        });
        
        modal.addEventListener('click', function(event) {
            if (event.target === modal) {
                modal.style.display = 'none';
                document.body.style.overflow = 'auto';
            }
        });
        
        document.addEventListener('keydown', function(event) {
            if (modal.style.display === 'block' && event.key === 'Escape') {
                modal.style.display = 'none';
                document.body.style.overflow = 'auto';
            }
        });
    }
}); 