jQuery(document).ready(function($) {
    function initFAQ() {
        $('.faq-item-title').on('click', function() {
            var $item = $(this).closest('.faq-item');
            var $content = $item.find('.faq-item-content');
            
            // Close all other items
            $('.faq-item').not($item).removeClass('active');
            $('.faq-item').not($item).find('.faq-item-content').slideUp(300);
            
            // Toggle current item
            $item.toggleClass('active');
            
            if ($item.hasClass('active')) {
                $content.slideDown(300);
            } else {
                $content.slideUp(300);
            }
        });
    }

    // Initialize when Elementor frontend is ready
    $(window).on('elementor/frontend/init', function() {
        if (typeof elementorFrontend !== 'undefined') {
            elementorFrontend.hooks.addAction('frontend/element_ready/widget-faq.default', function($scope) {
                initFAQ();
            });
        }
    });

    // Initialize immediately if not in Elementor
    if (!window.elementorFrontend) {
        initFAQ();
    }
}); 