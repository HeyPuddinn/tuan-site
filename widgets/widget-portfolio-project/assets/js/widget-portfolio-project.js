(function($) {
    'use strict';

    /**
     * Portfolio Project Filter
     */
    var WidgetPortfolioProjectHandler = function($scope, $) {
        var $filterButtons = $scope.find('.portfolio-project-filter-button');
        var $portfolioItems = $scope.find('.portfolio-project-item');
        var $navButtons = $scope.find('.nav-button');
        var $dots = $scope.find('.dot');
        
        // Initial state - show all items
        $portfolioItems.show();
        
        // Handle filter button click
        $filterButtons.on('click', function() {
            var $this = $(this);
            var filterValue = $this.data('filter');
            
            // Update active button
            $filterButtons.removeClass('active');
            $this.addClass('active');
            
            if (filterValue === 'all') {
                // Show all items
                $portfolioItems.show();
            } else {
                // Filter items
                $portfolioItems.each(function() {
                    var $item = $(this);
                    var categories = $item.data('filter-categories');
                    
                    if (categories && categories.includes(filterValue)) {
                        $item.show();
                    } else {
                        $item.hide();
                    }
                });
            }
        });
        
        // Navigation buttons functionality (for demo purposes)
        // In a real implementation, this would control a slider
        $navButtons.on('click', function() {
            var $this = $(this);
            var currentDot = $scope.find('.dot.active');
            var dots = $scope.find('.dot');
            var currentIndex = dots.index(currentDot);
            var newIndex;
            
            if ($this.hasClass('prev')) {
                newIndex = (currentIndex - 1 + dots.length) % dots.length;
            } else {
                newIndex = (currentIndex + 1) % dots.length;
            }
            
            dots.removeClass('active');
            $(dots[newIndex]).addClass('active');
        });
        
        // Dots functionality
        $dots.on('click', function() {
            var $this = $(this);
            $dots.removeClass('active');
            $this.addClass('active');
        });
    };
    
    // Make sure you run this code under Elementor
    $(window).on('elementor/frontend/init', function() {
        elementorFrontend.hooks.addAction('frontend/element_ready/widget-portfolio-project.default', WidgetPortfolioProjectHandler);
    });
    
})(jQuery); 