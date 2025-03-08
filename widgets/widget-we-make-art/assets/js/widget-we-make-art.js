jQuery(document).ready(function($) {
    // Initialize gallery items
    function initWeMakeArtGallery() {
        $('.widget-we-make-art .gallery-item').each(function() {
            $(this).on('mouseenter', function() {
                $(this).addClass('hover');
            }).on('mouseleave', function() {
                $(this).removeClass('hover');
            });
        });
    }

    // Initialize when Elementor frontend is ready
    $(window).on('elementor/frontend/init', function() {
        elementorFrontend.hooks.addAction('frontend/element_ready/widget-we-make-art.default', function($scope) {
            initWeMakeArtGallery();
        });
    });
}); 