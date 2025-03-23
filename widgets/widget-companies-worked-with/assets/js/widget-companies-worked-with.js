jQuery(document).ready(function($) {
    function initCompaniesSlider() {
        // Clone logos for continuous sliding effect
        $('.companies-logos').each(function() {
            const $slider = $(this);
            const $logos = $slider.children().clone(true);
            $slider.append($logos);
            
            // Adjust animation speed based on number of logos
            const logoCount = $slider.children().length / 2;
            const animationDuration = Math.max(logoCount * 3, 15); // Min 15s, or 3s per logo
            
            $slider.css('animation-duration', animationDuration + 's');
            
 
        });
    }

    // Initialize when Elementor frontend is ready
    $(window).on('elementor/frontend/init', function() {
        if (typeof elementorFrontend !== 'undefined') {
            elementorFrontend.hooks.addAction('frontend/element_ready/widget-companies-worked-with.default', function($scope) {
                initCompaniesSlider();
            });
        }
    });

    // Initialize immediately if not in Elementor
    if (!window.elementorFrontend) {
        initCompaniesSlider();
    }
}); 