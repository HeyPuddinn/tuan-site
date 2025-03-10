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
                            const text = node.textContent.trim();
                            if (text.length > 0) {
                                // Split into words
                                const words = text.split(/\s+/);
                                let processedHTML = '';
                                
                                words.forEach((word, wordIndex) => {
                                    if (word.length > 0) {
                                        // Start word span - keep words as meaningful units
                                        processedHTML += '<span class="about-me-word" data-index="' + wordIndex + '">';
                                        
                                        // Wrap each character in a span inside the word
                                        for (let i = 0; i < word.length; i++) {
                                            processedHTML += '<span class="about-me-char" data-char-index="' + i + '" data-word-index="' + wordIndex + '">' + word[i] + '</span>';
                                        }
                                        
                                        // Close word span
                                        processedHTML += '</span>';
                                        
                                        // Add space after word (except for the last word)
                                        if (wordIndex < words.length - 1) {
                                            processedHTML += '<span class="about-me-space"> </span>';
                                        }
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
                                const allCharsAnimated = wordChars.toArray().every(char => 
                                    parseInt($(char).index()) < charsToAnimate
                                );
                                
                                // Add a class to indicate if the word is fully animated
                                if (allCharsAnimated) {
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