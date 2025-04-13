(function($) {
    'use strict';

    /**
     * Portfolio Project Filter and Popup Gallery
     */
    var WidgetPortfolioProjectHandler = function($scope, $) {
        var $filterButtons = $scope.find('.portfolio-project-filter-button');
        var $portfolioItems = $scope.find('.portfolio-project-item');
        var $navButtons = $scope.find('.nav-button');
        var $dots = $scope.find('.dot');
        var $viewGalleryButtons = $scope.find('.view-gallery');
        var $popup = $scope.find('.portfolio-project-popup');
        var $popupClose = $scope.find('.popup-close');
        var $popupOverlay = $scope.find('.popup-overlay');
        var $videoPlayIcons = $scope.find('.video-play-icon');
        var swiper = null;
        
        // Initialize Swiper
        function initSwiper() {
            if (typeof Swiper === 'undefined') {
                console.error('Swiper not found. Please include Swiper library.');
                return;
            }
            
            // Initialize Swiper only once
            if (swiper === null) {
                swiper = new Swiper($scope.find('.portfolio-swiper')[0], {
                    slidesPerView: 1,
                    spaceBetween: 30,
                    loop: true,
                    navigation: {
                        nextEl: '.swiper-button-next',
                        prevEl: '.swiper-button-prev',
                    },
                    pagination: {
                        el: '.swiper-pagination',
                        clickable: true,
                    },
                    grabCursor: true,
                    keyboard: {
                        enabled: true,
                    },
                    autoHeight: true,
                    preloadImages: false,
                    lazy: true,
                    touchRatio: 1,
                    touchAngle: 45,
                    simulateTouch: true,
                    threshold: 5,
                    on: {
                        slideChangeTransitionEnd: function() {
                            // Pause all videos when slide changes except background videos
                            pausePopupVideos();
                        }
                    }
                });
            }
        }
        
        // Function to pause popup videos only (not background videos)
        function pausePopupVideos() {
            $popup.find('iframe').each(function() {
                // Skip if this is in a background video container
                if ($(this).closest('.video-background').length > 0) {
                    return;
                }
                
                // Get the current src
                var src = $(this).attr('src');
                
                // For YouTube videos
                if (src.includes('youtube.com')) {
                    // Remove autoplay parameter if present and add it again with value 0
                    src = src.replace(/autoplay=1/g, 'autoplay=0');
                    $(this).attr('src', src);
                }
                
                // For Vimeo videos
                if (src.includes('vimeo.com') && !src.includes('background=1')) {
                    // Remove autoplay parameter if present and add it again with value 0
                    src = src.replace(/autoplay=1/g, 'autoplay=0');
                    $(this).attr('src', src);
                }
            });
            
            // Pause HTML5 videos (that are not background videos)
            $popup.find('video').each(function() {
                // Skip if this is in a background video container
                if ($(this).closest('.video-background').length > 0) {
                    return;
                }
                
                if (typeof this.pause === 'function') {
                    this.pause();
                }
            });
        }
        
        // Open popup and initialize swiper
        function openPopup(index) {
            $popup.fadeIn(300);
            initSwiper();
            
            // Go to specific slide if index is provided
            if (typeof index !== 'undefined' && swiper !== null) {
                swiper.slideTo(parseInt(index) + 1); // +1 because of loop mode
            }
        }
        
        // Close popup
        function closePopup() {
            $popup.fadeOut(300);
            pausePopupVideos();
        }
        
        // Function to handle direct video play
        function handleVideoPlay(e) {
            e.preventDefault();
            e.stopPropagation();
            
            var $playIcon = $(this);
            var videoType = $playIcon.data('video-type');
            var $portfolioItem = $playIcon.closest('.portfolio-project-item');
            var index = $portfolioItems.index($portfolioItem);
            
            // Open the popup gallery
            openPopup(index);
            
            // Get the slide element
            var $slide = $popup.find('.swiper-slide[data-media-type="' + videoType + '"]').eq(0);
            
            // Handle video play based on type
            switch (videoType) {
                case 'youtube':
                    var videoId = $playIcon.data('video-id');
                    var $iframe = $slide.find('iframe');
                    if ($iframe.length) {
                        var src = $iframe.attr('src');
                        src = src.replace('autoplay=0', 'autoplay=1');
                        $iframe.attr('src', src);
                    }
                    break;
                    
                case 'vimeo':
                    var videoId = $playIcon.data('video-id');
                    var $iframe = $slide.find('iframe');
                    if ($iframe.length) {
                        var src = $iframe.attr('src');
                        src = src + (src.includes('?') ? '&' : '?') + 'autoplay=1';
                        $iframe.attr('src', src);
                    }
                    break;
                    
                case 'mp4':
                    var $video = $slide.find('video');
                    if ($video.length && typeof $video[0].play === 'function') {
                        $video[0].play();
                    }
                    break;
            }
        }
        
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
        
        // View Gallery button click event
        $viewGalleryButtons.on('click', function(e) {
            e.preventDefault();
            var index = $(this).data('index');
            openPopup(index);
        });
        
        // Video play icon click event
        $videoPlayIcons.on('click', handleVideoPlay);
        
        // Close popup events
        $popupClose.on('click', closePopup);
        $popupOverlay.on('click', closePopup);
        
        // Close popup on ESC key
        $(document).keyup(function(e) {
            if (e.key === "Escape") {
                closePopup();
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