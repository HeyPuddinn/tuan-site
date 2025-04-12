(function($) {
    'use strict';
    
    /**
     * Portfolio Banner Widget
     */
    var PortfolioBannerHandler = function($scope, $) {
        if (!window.gsap) return;
        
        var $banner = $scope.find('.portfolio-banner-widget');
        if (!$banner.length) return;
        
        var tl = gsap.timeline({
            defaults: {
                ease: "power3.out",
                duration: 1
            }
        });
        
        // Animation for the greeting
        tl.from($banner.find('.portfolio-banner-greeting'), {
            y: 50,
            opacity: 0,
            duration: 1.2
        });
        
        // Animation for the message container (staggered)
        tl.from($banner.find('.portfolio-banner-message'), {
            y: 30,
            opacity: 0,
            duration: 0.8
        }, "-=0.7");
        
        tl.from($banner.find('.portfolio-banner-subtext'), {
            y: 30,
            opacity: 0,
            duration: 0.8
        }, "-=0.6");
        
        // Animation for the footer elements
        tl.from($banner.find('.portfolio-banner-footer'), {
            y: 20,
            opacity: 0,
            duration: 0.8
        }, "-=0.5");
    };
    
    // Initialize the widget when Elementor frontend is loaded
    $(window).on('elementor/frontend/init', function() {
        elementorFrontend.hooks.addAction('frontend/element_ready/widget-portfolio-banner.default', PortfolioBannerHandler);
    });
    
})(jQuery); 