jQuery(document).ready(function($) {
    function initPortfolioHero() {
        const portfolioTexts = $('.portfolio-text');
        const textContent = $('.text-content');
        
        // Reset all portfolio texts to their initial state
        function resetPortfolioTexts() {
            portfolioTexts.each(function() {
                $(this).css({
                    'transform': 'translateX(0)',
                    'opacity': 1,
                    'transition': 'transform 0.4s cubic-bezier(0.34, 1.56, 0.64, 1), opacity 0.4s cubic-bezier(0.4, 0, 0.2, 1)'
                });
            });
        }
        
        // Apply hover animation to portfolio texts
        function applyHoverAnimation() {
            portfolioTexts.each(function(index) {
                // Even indices (0, 2, 4...) move right, odd indices (1, 3, 5...) move left
                const direction = index % 2 === 0 ? 1 : -1;
                const translateDistance = 50; // pixels to move
                
                $(this).css({
                    'transform': `translateX(${direction * translateDistance}px)`,
                    'opacity': 0.7,
                    'transition': 'transform 0.4s cubic-bezier(0.34, 1.56, 0.64, 1), opacity 0.4s cubic-bezier(0.4, 0, 0.2, 1)'
                });
            });
        }
        
        // Add hover event listeners
        textContent.on('mouseenter', function() {
            applyHoverAnimation();
        });
        
        textContent.on('mouseleave', function() {
            resetPortfolioTexts();
        });
        
        // Initialize with all elements in their default position
        resetPortfolioTexts();
        
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