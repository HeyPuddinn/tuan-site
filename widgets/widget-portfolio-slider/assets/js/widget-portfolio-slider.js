jQuery(document).ready(function($) {
    function initPortfolioSlider() {
        $('.portfolio-slider-widget').each(function(index) {
            // Thêm unique ID cho mỗi instance
            const uniqueId = `portfolio-slider-${index}`;
            $(this).attr('id', uniqueId);
            
            const $sliderContainer = $(this).find('.swiper-container');
            
            // Đảm bảo mỗi instance có class unique
            $sliderContainer.addClass(uniqueId);
            
            const slidesDesktop = parseInt($sliderContainer.data('slides-desktop')) || 3;
            const slidesTablet = parseInt($sliderContainer.data('slides-tablet')) || 2;
            const slidesMobile = parseInt($sliderContainer.data('slides-mobile')) || 1;
            
            const $prevButton = $(this).find('.portfolio-prev');
            const $nextButton = $(this).find('.portfolio-next');
            const $current = $(this).find('.portfolio-pagination .current');
            const $total = $(this).find('.portfolio-pagination .total');
            const $progressBar = $(this).find('.progress-bar');
            
            // Get count of portfolio items cho instance này
            const slideCount = $(this).find('.portfolio-slide').length;
            
            // Initialize Swiper với container cụ thể
            const swiper = new Swiper($sliderContainer[0], {
                slidesPerView: 1,
                spaceBetween: 20,
                loop: false,
                grabCursor: true,
                speed: 800,
                effect: 'slide',
                // Show all slides at once on larger screens
                breakpoints: {
                    768: {
                        slidesPerView: Math.min(slidesTablet, slideCount),
                        spaceBetween: 20,
                    },
                    1024: {
                        slidesPerView: Math.min(slidesDesktop, slideCount),
                        spaceBetween: 20,
                    }
                },
                on: {
                    init: function() {
                        // Sử dụng closure để đảm bảo các biến đúng cho mỗi instance
                        let maxSlidesPerView = slidesMobile;
                        
                        if (window.innerWidth >= 1024) {
                            maxSlidesPerView = Math.min(slidesDesktop, slideCount);
                        } else if (window.innerWidth >= 768) {
                            maxSlidesPerView = Math.min(slidesTablet, slideCount);
                        }
                        
                        const totalScreens = Math.max(1, Math.ceil((slideCount - maxSlidesPerView) / 1) + 1);
                        
                        // Update UI elements cho instance này
                        $total.text(totalScreens < 10 ? '0' + totalScreens : totalScreens);
                        $current.text('01');
                        
                        if (totalScreens <= 1) {
                            $progressBar.css('width', '100%');
                        } else {
                            $progressBar.css('width', `${(1 / totalScreens) * 100}%`);
                        }
                    },
                    slideChange: function() {
                        let maxSlidesPerView = slidesMobile; // Default for mobile
                        
                        if (window.innerWidth >= 1024) {
                            maxSlidesPerView = Math.min(slidesDesktop, slideCount); // Desktop
                        } else if (window.innerWidth >= 768) {
                            maxSlidesPerView = Math.min(slidesTablet, slideCount); // Tablet
                        }
                        
                        // Calculate total screens
                        const totalScreens = Math.max(1, Math.ceil((slideCount - maxSlidesPerView) / 1) + 1);
                        
                        // Current position (starting from 1)
                        const currentPosition = Math.min(this.activeIndex + 1, totalScreens);
                        
                        // Update current slide position
                        $current.text(currentPosition < 10 ? '0' + currentPosition : currentPosition);
                        
                        // Update progress bar
                        if (totalScreens <= 1) {
                            $progressBar.css('width', '100%');
                        } else {
                            const progress = ((currentPosition) / (totalScreens)) * 100;
                            $progressBar.css('width', `${progress}%`);
                        }
                    },
                    resize: function() {
                        let maxSlidesPerView = slidesMobile; // Default for mobile
                        
                        if (window.innerWidth >= 1024) {
                            maxSlidesPerView = Math.min(slidesDesktop, slideCount); // Desktop
                        } else if (window.innerWidth >= 768) {
                            maxSlidesPerView = Math.min(slidesTablet, slideCount); // Tablet
                        }
                        
                        // Calculate total screens
                        const totalScreens = Math.max(1, Math.ceil((slideCount - maxSlidesPerView) / 1) + 1);
                        
                        // Update the total number display
                        $total.text(totalScreens < 10 ? '0' + totalScreens : totalScreens);
                        
                        // Current position (starting from 1)
                        const currentPosition = Math.min(this.activeIndex + 1, totalScreens);
                        
                        // Update progress bar
                        if (totalScreens <= 1) {
                            $progressBar.css('width', '100%');
                        } else {
                            const progress = ((currentPosition - 1) / (totalScreens - 1)) * 100;
                            $progressBar.css('width', `${progress}%`);
                        }
                    }
                }
            });
            
            // Navigation buttons cho instance cụ thể
            $prevButton.on('click', function(e) {
                e.preventDefault();
                swiper.slidePrev();
            });
            
            $nextButton.on('click', function(e) {
                e.preventDefault();
                swiper.slideNext();
            });
            
            // Cleanup khi widget bị destroy
            return function cleanup() {
                if (swiper) {
                    swiper.destroy(true, true);
                }
                $prevButton.off('click');
                $nextButton.off('click');
            };
        });
    }

    // Initialize when Elementor frontend is ready
    $(window).on('elementor/frontend/init', function() {
        if (typeof elementorFrontend !== 'undefined') {
            elementorFrontend.hooks.addAction('frontend/element_ready/widget-portfolio-slider.default', function($scope) {
                initPortfolioSlider();
            });
        }
    });

    // Initialize immediately if not in Elementor
    if (!window.elementorFrontend) {
        initPortfolioSlider();
    }
}); 