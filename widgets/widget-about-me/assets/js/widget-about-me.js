jQuery(document).ready(function($) {
    function initAboutMe() {
        // Check if GSAP is available
        if (typeof gsap === 'undefined') {
            // Load GSAP from official CDN
            loadScript('https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js', function() {
                loadScript('https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js', initTextReveal);
            });
        } else {
            // If GSAP is already loaded, check for ScrollTrigger
            if (typeof ScrollTrigger === 'undefined') {
                loadScript('https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js', initTextReveal);
            } else {
                initTextReveal();
            }
        }

        // Helper function to load scripts dynamically
        function loadScript(url, callback) {
            const script = document.createElement('script');
            script.src = url;
            script.onload = callback;
            document.head.appendChild(script);
        }

        // Initialize text reveal animation without using SplitText
        function initTextReveal() {
            if (typeof gsap !== 'undefined' && typeof ScrollTrigger !== 'undefined') {
                gsap.registerPlugin(ScrollTrigger);

                // Apply to each about-me-content element (in case there are multiple widgets)
                $('.about-me-content').each(function(index) {
                    const contentElement = $(this);
                    const widgetElement = contentElement.closest('.about-me-widget');
                    
                    // Add a unique ID if not present
                    if (!contentElement.attr('id')) {
                        contentElement.attr('id', 'about-me-content-' + index);
                    }
                    
                    // Get the text content
                    const originalText = contentElement.html();
                    
                    // Preserve HTML structure by creating a temporary div
                    const tempDiv = document.createElement('div');
                    tempDiv.innerHTML = originalText;
                    
                    // Process text nodes within the HTML structure
                    const processNode = (node) => {
                        if (node.nodeType === Node.TEXT_NODE) {
                            // Process text content
                            const text = node.textContent;
                            if (text.trim().length > 0) {
                                // Improved regex pattern that works well with both English and Vietnamese
                                // This pattern captures words (including words with apostrophes and hyphens)
                                // and preserves whitespace
                                const pattern = /(\S+[-']\S+|\S+)|\s+/g;
                                const words = text.match(pattern) || [];
                                let processedHTML = '';
                                let wordIndex = 0;
                                
                                words.forEach((word) => {
                                    if (word.trim().length > 0) {
                                        // Start word span - keep words as meaningful units
                                        processedHTML += '<span class="about-me-word" data-index="' + wordIndex + '">';
                                        
                                        // Wrap each character in a span inside the word
                                        // Using Array.from to properly handle Unicode characters in both languages
                                        Array.from(word).forEach((char, charIndex) => {
                                            // Encode special HTML characters to prevent rendering issues
                                            const safeChar = char
                                                .replace(/&/g, '&amp;')
                                                .replace(/</g, '&lt;')
                                                .replace(/>/g, '&gt;')
                                                .replace(/"/g, '&quot;')
                                                .replace(/'/g, '&#039;');
                                            
                                            processedHTML += '<span class="about-me-char" data-char-index="' + charIndex + '" data-word-index="' + wordIndex + '">' + safeChar + '</span>';
                                        });
                                        
                                        // Close word span
                                        processedHTML += '</span>';
                                        wordIndex++;
                                    } else if (word.match(/\s+/)) {
                                        // Handle spaces separately - preserve original whitespace
                                        processedHTML += '<span class="about-me-space">' + word + '</span>';
                                    }
                                });
                                
                                // Replace text node with processed HTML
                                const replacementNode = document.createElement('span');
                                replacementNode.innerHTML = processedHTML;
                                node.parentNode.replaceChild(replacementNode, node);
                            }
                        } else if (node.nodeType === Node.ELEMENT_NODE) {
                            // Process child nodes recursively
                            Array.from(node.childNodes).forEach(processNode);
                        }
                    };
                    
                    // Process all nodes in the content
                    Array.from(tempDiv.childNodes).forEach(processNode);
                    
                    // Replace content with processed HTML
                    contentElement.html(tempDiv.innerHTML);
                    
                    // Get all character spans
                    const charElements = contentElement.find('.about-me-char');
                    const totalChars = charElements.length;
                    
                    // Set initial color
                    const initialColor = contentElement.data('initial-color') || '#626262';
                    const animatedColor = contentElement.data('animated-color') || '#ffffff';
                    
                    gsap.set(charElements, {
                        color: initialColor
                    });
                    
                    // Calculate the appropriate height for the widget to ensure animation completes
                    // We need enough scroll distance to animate all characters
                    // Get current widget height
                    const currentWidgetHeight = widgetElement.outerHeight();
                    
                    // Calculate required height based on character count and viewport height
                    // This ensures there's enough scroll distance to animate all characters
                    const viewportHeight = $(window).height();
                    const minRequiredHeight = Math.max(
                        currentWidgetHeight,
                        // Ensure at least 1.5x viewport height to provide enough scroll distance
                        // or scale based on character count for longer texts
                        viewportHeight * 2,
                        // For very long texts, scale height based on character count
                        // Each character needs some scroll distance to animate
                        Math.min(viewportHeight * 3, viewportHeight + (totalChars / 20) * 100)
                    );
                    
                    // Set the calculated height to the widget
                    widgetElement.css({
                        'height': minRequiredHeight + 'px',
                    });
                    
                    // Create scroll-triggered animation
                    ScrollTrigger.create({
                        trigger: '.about-me-widget',
                        start: "top center", // Start when the top of widget reaches top of viewport
                        end: "bottom center", // End after scrolling 100vh
                        scrub: 0.5, // Smooth animation with slight delay for better control
                        onUpdate: (self) => {
                            // Calculate which characters should be animated based on scroll progress
                            const progress = self.progress;
                            const charsToAnimate = Math.floor(progress * totalChars);
                            
                            // Update character colors character by character
                            charElements.each(function(index) {
                                if (index < charsToAnimate) {
                                    $(this).css('color', animatedColor);
                                } else {
                                    $(this).css('color', initialColor);
                                }
                            });
                            
                            // Ensure words are kept together visually by checking if all characters in a word are animated
                            contentElement.find('.about-me-word').each(function() {
                                const wordIndex = parseInt($(this).data('index'));
                                const wordChars = contentElement.find(`.about-me-char[data-word-index="${wordIndex}"]`);
                                
                                // More reliable way to check if all characters are animated
                                let allAnimated = true;
                                wordChars.each(function() {
                                    // Get computed style to ensure we're getting the actual rendered color
                                    const computedColor = window.getComputedStyle(this).color;
                                    if (computedColor !== animatedColor && 
                                        // RGB comparison as fallback
                                        computedColor !== animatedColor.replace('#', 'rgb(').replace(/([0-9a-f]{2})/gi, function(match) {
                                            return parseInt(match, 16) + ', ';
                                        }).replace(/, $/, ')')) {
                                        allAnimated = false;
                                        return false; // break the loop
                                    }
                                });
                                
                                // Add a class to indicate if the word is fully animated
                                if (allAnimated) {
                                    $(this).addClass('word-complete');
                                } else {
                                    $(this).removeClass('word-complete');
                                }
                            });
                        }
                    });
                });
            }
        }

        // Add animation class when element is in viewport
        function isInViewport(element) {
            const rect = element.getBoundingClientRect();
            return (
                rect.top <= (window.innerHeight || document.documentElement.clientHeight) &&
                rect.bottom >= 0
            );
        }

        function handleScrollAnimation() {
            const aboutMeWidget = $('.about-me-widget');
            const aboutMeTitle = $('.about-me-title');
            
            if (isInViewport(aboutMeWidget[0])) {
                aboutMeTitle.addClass('animate-in');
            }
        }

        // Add CSS for animations
        const animationCSS = `
            .about-me-title {
                opacity: 0;
                transform: translateY(20px);
                transition: opacity 0.6s ease, transform 0.6s ease;
            }
            
            .about-me-title.animate-in {
                opacity: 1;
                transform: translateY(0);
            }
            
            /* Style for words and characters */
            .about-me-word {
                display: inline-block;
                position: relative;
            }
            
            .about-me-char {
                display: inline-block;
                position: relative;
                transition: color 0.2s ease;
            }
            
            .about-me-space {
                display: inline-block;
                width: 0.25em;
            }
            
            /* Style for completed words */
            .about-me-word.word-complete {
                /* Optional: add any special styling for completed words */
            }
            
            /* Ensure the widget has smooth transition for height changes */
            .about-me-widget {
                transition: min-height 0.3s ease;
            }
        `;
        
        $('<style>').text(animationCSS).appendTo('head');
        
        // Handle scroll events
        $(window).on('scroll', function() {
            handleScrollAnimation();
        });
        
        // Initial check on page load
        setTimeout(function() {
            handleScrollAnimation();
            initTextReveal(); // Ensure text reveal is initialized
        }, 100);
        
        // Recalculate heights on window resize
        $(window).on('resize', function() {
            initTextReveal();
        });
    }

    // Initialize when Elementor frontend is ready
    $(window).on('elementor/frontend/init', function() {
        elementorFrontend.hooks.addAction('frontend/element_ready/widget-about-me.default', function($scope) {
            initAboutMe();
        });
    });

    // Initialize immediately if not in Elementor
    if (!window.elementorFrontend) {
        initAboutMe();
    }
}); 