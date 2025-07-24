<?php
/**
 * Functions and definitions for Watch Cartoons Online theme
 *
 * @package WatchCartoons
 */

declare(strict_types=1);

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Theme setup
 */
function watch_cartoons_setup(): void {
    // Add theme support for various features
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ));
    
    // Register navigation menus
    register_nav_menus(array(
        'primary' => esc_html__('Primary Menu', 'watch-cartoons'),
    ));
}
add_action('after_setup_theme', 'watch_cartoons_setup');

/**
 * Enqueue scripts and styles
 */
function watch_cartoons_scripts(): void {
    wp_enqueue_style('watch-cartoons-style', get_stylesheet_uri(), array(), '1.0.0');
    wp_enqueue_script('watch-cartoons-script', get_template_directory_uri() . '/js/main.js', array('jquery'), '1.0.0', true);
}
add_action('wp_enqueue_scripts', 'watch_cartoons_scripts');

/**
 * Get cartoon sites data
 *
 * @return array Array of cartoon sites information
 */
function get_cartoon_sites_data(): array {
    return array(
        array(
            'name' => 'Tubi',
            'type' => 'Free Streaming',
            'platform' => 'Web, Mobile Apps',
            'description' => 'Large collection of cartoons from classics like Scooby-Doo to modern favorites. No account required to start watching.',
            'url' => 'https://tubi.tv',
        ),
        array(
            'name' => 'Plex',
            'type' => 'Free Streaming',
            'platform' => 'Web, Mobile, TV Apps',
            'description' => 'Huge selection of free cartoons from 1940s to 2020s, including classic hand-drawn animation and modern 3D content.',
            'url' => 'https://plex.tv',
        ),
        array(
            'name' => 'Crunchyroll',
            'type' => 'Anime Streaming',
            'platform' => 'Web, Mobile, Gaming Consoles',
            'description' => 'Best place for Japanese anime with subbed and dubbed shows. Free tier available with limited content.',
            'url' => 'https://crunchyroll.com',
        ),
        array(
            'name' => 'Pluto TV',
            'type' => 'Live TV & On-Demand',
            'platform' => 'Web, Mobile, Smart TV',
            'description' => 'Hundreds of classic and modern cartoons with both live TV channels and on-demand library.',
            'url' => 'https://pluto.tv',
        ),
        array(
            'name' => 'WCO.tv',
            'type' => 'Cartoon Streaming',
            'platform' => 'Web Browser',
            'description' => 'Dedicated cartoon streaming site with HD quality videos and extensive collection of animated series.',
            'url' => 'https://wco.tv',
        ),
        array(
            'name' => 'YouTube',
            'type' => 'Video Platform',
            'platform' => 'Web, Mobile, TV Apps',
            'description' => 'Large collection of free cartoons, many organized in playlists. Official channels and classic content available.',
            'url' => 'https://youtube.com',
        ),
        array(
            'name' => 'Cartoon Network',
            'type' => 'Official Network',
            'platform' => 'Web, Mobile Apps',
            'description' => 'Official Cartoon Network content including Adventure Time, Steven Universe, and other popular shows.',
            'url' => 'https://cartoonnetwork.com',
        ),
        array(
            'name' => 'Disney Junior',
            'type' => 'Kids Content',
            'platform' => 'Web, Mobile Apps',
            'description' => 'Disney\'s official platform for younger audiences with educational and entertaining animated content.',
            'url' => 'https://disneyjunior.disney.com',
        ),
        array(
            'name' => 'ToonJet',
            'type' => 'Classic Cartoons',
            'platform' => 'Web Browser',
            'description' => 'Specializes in classic cartoons like Popeye, Betty Boop, and Looney Tunes from decades past.',
            'url' => 'https://toonjet.com',
        ),
    );
}

/**
 * Get SEO keywords
 *
 * @return array Array of SEO keywords
 */
function get_seo_keywords(): array {
    return array(
        'watch cartoons online',
        'watch cartoons',
        'watch cartoons free',
        'where can i watch cartoons online',
        'best sites for watching cartoons online',
        'best sites for watching cartoons free',
        'free cartoon streaming',
        'cartoon websites',
        'animated series online',
        'kids cartoons free',
        'classic cartoons online',
        'anime streaming free',
    );
}

/**
 * Add custom meta tags for SEO
 */
function watch_cartoons_add_meta_tags(): void {
    if (is_home() || is_front_page()) {
        echo '<meta name="description" content="' . esc_attr('Find the best free cartoon streaming sites online. Watch cartoons, anime, and animated series from trusted platforms with our comprehensive directory.') . '">' . "\n";
        echo '<meta name="keywords" content="' . esc_attr('watch cartoons online, free cartoons, cartoon streaming, anime online, animated series, kids cartoons') . '">' . "\n";
        echo '<meta property="og:title" content="' . esc_attr('Watch Cartoons Online - Best Free Streaming Sites Directory') . '">' . "\n";
        echo '<meta property="og:description" content="' . esc_attr('Discover the best places to watch cartoons online for free. Our directory features safe and legal streaming platforms.') . '">' . "\n";
        echo '<meta property="og:type" content="website">' . "\n";
    }
}
add_action('wp_head', 'watch_cartoons_add_meta_tags');

/**
 * Add structured data for SEO
 */
function watch_cartoons_structured_data(): void {
    if (is_home() || is_front_page()) {
        $structured_data = array(
            '@context' => 'https://schema.org',
            '@type' => 'WebSite',
            'name' => 'Watch Cartoons Online',
            'description' => 'Directory of the best free cartoon streaming websites',
            'url' => home_url(),
            'potentialAction' => array(
                '@type' => 'SearchAction',
                'target' => home_url('/?s={search_term_string}'),
                'query-input' => 'required name=search_term_string'
            )
        );
        
        echo '<script type="application/ld+json">' . wp_json_encode($structured_data) . '</script>' . "\n";
    }
}
add_action('wp_head', 'watch_cartoons_structured_data');

/**
 * Customize the search form
 */
function watch_cartoons_search_form($form): string {
    $form = '<form role="search" method="get" class="search-form" action="' . esc_url(home_url('/')) . '">
';
    $form .= '<div class="search-container">
';
    $form .= '<input type="search" class="search-box" placeholder="' . esc_attr__('Search cartoons...', 'watch-cartoons') . '" value="' . get_search_query() . '" name="s" />
';
    $form .= '</div>
';
    $form .= '</form>
';
    
    return $form;
}
add_filter('get_search_form', 'watch_cartoons_search_form');

/**
 * Add security headers
 */
function watch_cartoons_security_headers(): void {
    if (!is_admin()) {
        header('X-Content-Type-Options: nosniff');
        header('X-Frame-Options: SAMEORIGIN');
        header('X-XSS-Protection: 1; mode=block');
    }
}
add_action('send_headers', 'watch_cartoons_security_headers');

/**
 * Optimize performance - remove unnecessary WordPress features
 */
function watch_cartoons_optimize_performance(): void {
    // Remove emoji scripts
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('wp_print_styles', 'print_emoji_styles');
    
    // Remove unnecessary meta tags
    remove_action('wp_head', 'wp_generator');
    remove_action('wp_head', 'wlwmanifest_link');
    remove_action('wp_head', 'rsd_link');
}
add_action('init', 'watch_cartoons_optimize_performance');

/**
 * Custom excerpt length
 */
function watch_cartoons_excerpt_length($length): int {
    return 30;
}
add_filter('excerpt_length', 'watch_cartoons_excerpt_length');

/**
 * Custom excerpt more text
 */
function watch_cartoons_excerpt_more($more): string {
    return '...';
}
add_filter('excerpt_more', 'watch_cartoons_excerpt_more');