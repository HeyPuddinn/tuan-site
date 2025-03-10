jQuery(document).ready(function($) {
    function initPortfolioHero() {
        const portfolioTexts = $('.portfolio-text');
        let ticking = false;
        
        // Handle scroll animation with requestAnimationFrame
        $(window).on('scroll', function() {
            if (!ticking) {
                window.requestAnimationFrame(function() {
                    const windowScrollTop = $(window).scrollTop();
                    const windowHeight = $(window).height();

                    // Animate Portfolio Texts with different opacity ranges
                    portfolioTexts.each(function(index) {
                        const opacityMax = 0.2 * (index + 1); // 0.2, 0.4, 0.6, 0.8
                        animatePortfolioText($(this), windowScrollTop, windowHeight, opacityMax);
                    });

                    ticking = false;
                });

                ticking = true;
            }
        });

        function animatePortfolioText($element, windowScrollTop, windowHeight, maxOpacity) {
            const elementOffset = $element.offset().top;
            // Start animation when viewport is very close to the element
            const viewportOffset = windowScrollTop;
            
            let opacity = maxOpacity;
            let translateY = 0;

            console.log(viewportOffset, elementOffset);

            if (viewportOffset > elementOffset - 170) {
                // Calculate progress based on very short distance (0.1vh)
                const totalDistance = windowHeight * 0.15; // Very short distance for quick animation
                const scrollPast = viewportOffset - (elementOffset - windowHeight);
                const progress = Math.min(1, scrollPast / totalDistance);
                
                // Quick fade out
                opacity = Math.max(0, maxOpacity * (1 - progress));
                
                // Quick upward movement of -50px
                translateY = Math.max(-50, -progress * 50);
            } else {
                // Reset to initial state when scrolling back up
                opacity = maxOpacity;
                translateY = 0;
            }

            $element.css({
                'opacity': opacity,
                'transform': `translateY(${translateY}px)`,
                'transition': 'opacity 0.4s cubic-bezier(0.4, 0, 0.2, 1), transform 0.4s cubic-bezier(0.34, 1.56, 0.64, 1)'
            });
        }

        // Initial animation on page load with delay
        setTimeout(() => {
            $(window).trigger('scroll');
        }, 200);

        // Add smooth scroll behavior to the page
        $('html').css('scroll-behavior', 'smooth');
    }

    // Initialize when Elementor frontend is ready
    $(window).on('elementor/frontend/init', function() {
        elementorFrontend.hooks.addAction('frontend/element_ready/widget-portfolio-hero.default', function($scope) {
            initPortfolioHero();
        });
    });

    // Initialize immediately if not in Elementor
    if (!window.elementorFrontend) {
        initPortfolioHero();
    }
}); 