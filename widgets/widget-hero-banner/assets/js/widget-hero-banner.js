/**
 * Hero Banner Widget Scripts
 */
(function($) {
    'use strict';

    // Function to set glitch image from avatar
    var setGlitchImage = function() {
        var avatarImg = $('.hero-banner-avatar img');
        var glitchLayers = $('.glitch__layer');
        
        if (avatarImg.length && glitchLayers.length) {
            var imgSrc = avatarImg.attr('src');
            glitchLayers.each(function() {
                $(this).css('background-image', 'url(' + imgSrc + ')');
            });
        }
    };

    // Initialize hero banner widget functionality
    var initHeroBanner = function() {
        $('.hero-banner-button a').on('click', function(e) {
            // Track download event if analytics is available
            if (typeof ga !== 'undefined') {
                ga('send', 'event', 'Download', 'CV', 'Hero Banner CV Download');
            }
        });

        // Set glitch image
        setGlitchImage();
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