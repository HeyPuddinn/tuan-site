/**
 * Hero Banner Widget Scripts
 */
(function($) {
    'use strict';

    // Initialize hero banner widget functionality
    var initHeroBanner = function() {
        $('.hero-banner-button a').on('click', function(e) {
            // Track download event if analytics is available
            if (typeof ga !== 'undefined') {
                ga('send', 'event', 'Download', 'CV', 'Hero Banner CV Download');
            }
        });
    };

    // Initialize on document ready
    $(document).ready(function() {
        initHeroBanner();
    });

    // Initialize on Elementor frontend init
    $(window).on('elementor/frontend/init', function() {
        if (typeof elementorFrontend !== 'undefined' && elementorFrontend.hooks) {
            elementorFrontend.hooks.addAction('frontend/element_ready/widget-hero-banner.default', function($scope) {
                initHeroBanner();
            });
        }
    });

})(jQuery); 