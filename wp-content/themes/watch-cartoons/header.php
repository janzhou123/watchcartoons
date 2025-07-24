<?php
/**
 * The header for Watch Cartoons Online theme
 *
 * @package WatchCartoons
 */

declare(strict_types=1);

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="index, follow">
    <meta name="author" content="Watch Cartoons Team">
    
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header id="masthead" class="site-header">
    <div class="container">
        <div class="header-content">
            <a href="<?php echo esc_url(home_url('/')); ?>" class="logo" rel="home">
                <?php 
                $site_name = get_bloginfo('name');
                if ($site_name) {
                    echo esc_html($site_name);
                } else {
                    esc_html_e('Watch Cartoons Online', 'watch-cartoons');
                }
                ?>
            </a>
            
            <nav id="site-navigation" class="main-navigation" aria-label="<?php esc_attr_e('Primary Menu', 'watch-cartoons'); ?>">
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'primary',
                    'menu_id'        => 'primary-menu',
                    'container'      => false,
                    'fallback_cb'    => false,
                ));
                ?>
            </nav>
            
            <?php get_search_form(); ?>
        </div>
    </div>
</header>