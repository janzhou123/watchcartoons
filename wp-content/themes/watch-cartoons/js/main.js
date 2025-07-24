/**
 * Main JavaScript file for Watch Cartoons Online theme
 * 
 * @package WatchCartoons
 */

(function($) {
    'use strict';

    // DOM Ready
    $(document).ready(function() {
        initializeTheme();
    });

    /**
     * Initialize theme functionality
     */
    function initializeTheme() {
        setupSearchFunctionality();
        setupCardAnimations();
        setupSmoothScrolling();
        setupLazyLoading();
        trackUserInteractions();
    }

    /**
     * Enhanced search functionality
     */
    function setupSearchFunctionality() {
        const searchBox = $('.search-box');
        const siteCards = $('.site-card');
        
        if (searchBox.length && siteCards.length) {
            searchBox.on('input', function() {
                const searchTerm = $(this).val().toLowerCase().trim();
                
                siteCards.each(function() {
                    const card = $(this);
                    const title = card.find('.site-title').text().toLowerCase();
                    const type = card.find('.site-type').text().toLowerCase();
                    const description = card.find('.site-description').text().toLowerCase();
                    
                    const isMatch = title.includes(searchTerm) || 
                                   type.includes(searchTerm) || 
                                   description.includes(searchTerm);
                    
                    if (isMatch || searchTerm === '') {
                        card.fadeIn(300);
                    } else {
                        card.fadeOut(300);
                    }
                });
                
                // Show "no results" message if needed
                setTimeout(function() {
                    const visibleCards = siteCards.filter(':visible');
                    const noResultsMsg = $('.no-results-message');
                    
                    if (visibleCards.length === 0 && searchTerm !== '') {
                        if (noResultsMsg.length === 0) {
                            $('.cartoon-sites').after('<div class="no-results-message"><p>No cartoon sites found matching your search. Try different keywords.</p></div>');
                        }
                    } else {
                        noResultsMsg.remove();
                    }
                }, 350);
            });
        }
    }

    /**
     * Setup card hover animations
     */
    function setupCardAnimations() {
        $('.site-card').each(function() {
            const card = $(this);
            
            card.hover(
                function() {
                    $(this).find('.visit-btn').addClass('pulse');
                },
                function() {
                    $(this).find('.visit-btn').removeClass('pulse');
                }
            );
        });
        
        // Add CSS for pulse animation
        if (!$('#card-animations-css').length) {
            $('head').append(`
                <style id="card-animations-css">
                    .visit-btn.pulse {
                        animation: pulse 1s infinite;
                    }
                    
                    @keyframes pulse {
                        0% { transform: scale(1); }
                        50% { transform: scale(1.05); }
                        100% { transform: scale(1); }
                    }
                    
                    .no-results-message {
                        text-align: center;
                        padding: 2rem;
                        background: #f8f9fa;
                        border-radius: 10px;
                        margin: 2rem 0;
                        color: #666;
                    }
                </style>
            `);
        }
    }

    /**
     * Setup smooth scrolling for anchor links
     */
    function setupSmoothScrolling() {
        $('a[href^="#"]').on('click', function(e) {
            const target = $(this.getAttribute('href'));
            
            if (target.length) {
                e.preventDefault();
                $('html, body').animate({
                    scrollTop: target.offset().top - 100
                }, 800);
            }
        });
    }

    /**
     * Setup lazy loading for images (if any are added later)
     */
    function setupLazyLoading() {
        if ('IntersectionObserver' in window) {
            const imageObserver = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const img = entry.target;
                        img.src = img.dataset.src;
                        img.classList.remove('lazy');
                        imageObserver.unobserve(img);
                    }
                });
            });

            document.querySelectorAll('img[data-src]').forEach(img => {
                imageObserver.observe(img);
            });
        }
    }

    /**
     * Track user interactions for analytics
     */
    function trackUserInteractions() {
        // Track site card clicks
        $('.visit-btn').on('click', function() {
            const siteName = $(this).closest('.site-card').find('.site-title').text();
            
            // Send event to Google Analytics if available
            if (typeof gtag !== 'undefined') {
                gtag('event', 'click', {
                    'event_category': 'Cartoon Site',
                    'event_label': siteName,
                    'value': 1
                });
            }
            
            // Console log for debugging
            console.log('User clicked on:', siteName);
        });
        
        // Track search usage
        $('.search-box').on('focus', function() {
            if (typeof gtag !== 'undefined') {
                gtag('event', 'search_focus', {
                    'event_category': 'Search',
                    'event_label': 'Search Box Focused'
                });
            }
        });
    }

    /**
     * Add scroll-to-top functionality
     */
    function addScrollToTop() {
        // Add scroll to top button
        $('body').append('<button id="scroll-to-top" title="Back to top">↑</button>');
        
        const scrollBtn = $('#scroll-to-top');
        
        // Show/hide button based on scroll position
        $(window).scroll(function() {
            if ($(this).scrollTop() > 300) {
                scrollBtn.fadeIn();
            } else {
                scrollBtn.fadeOut();
            }
        });
        
        // Scroll to top when clicked
        scrollBtn.on('click', function() {
            $('html, body').animate({scrollTop: 0}, 600);
        });
        
        // Add CSS for scroll to top button
        if (!$('#scroll-to-top-css').length) {
            $('head').append(`
                <style id="scroll-to-top-css">
                    #scroll-to-top {
                        position: fixed;
                        bottom: 30px;
                        right: 30px;
                        background: linear-gradient(45deg, #667eea, #764ba2);
                        color: white;
                        border: none;
                        border-radius: 50%;
                        width: 50px;
                        height: 50px;
                        font-size: 20px;
                        cursor: pointer;
                        display: none;
                        z-index: 1000;
                        box-shadow: 0 4px 15px rgba(0,0,0,0.3);
                        transition: all 0.3s ease;
                    }
                    
                    #scroll-to-top:hover {
                        transform: translateY(-3px);
                        box-shadow: 0 6px 20px rgba(0,0,0,0.4);
                    }
                </style>
            `);
        }
    }

    // Initialize scroll to top
    addScrollToTop();

    /**
     * Add keyboard navigation support
     */
    function setupKeyboardNavigation() {
        $(document).on('keydown', function(e) {
            // ESC key to clear search
            if (e.key === 'Escape') {
                $('.search-box').val('').trigger('input');
            }
            
            // Enter key on cards to visit site
            if (e.key === 'Enter' && $(e.target).hasClass('site-card')) {
                $(e.target).find('.visit-btn')[0].click();
            }
        });
        
        // Make cards focusable
        $('.site-card').attr('tabindex', '0');
    }

    setupKeyboardNavigation();

})(jQuery);