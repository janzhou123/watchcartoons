<?php
/**
 * The main template file for Watch Cartoons Online theme
 *
 * @package WatchCartoons
 */

declare(strict_types=1);

get_header(); ?>

<main id="main" class="site-main">
    <div class="container">
        <!-- Hero Section -->
        <section class="hero">
            <h1><?php esc_html_e('Watch Cartoons Online Free', 'watch-cartoons'); ?></h1>
            <p><?php esc_html_e('Discover the best sites for watching cartoons online. Find your favorite animated shows and movies from trusted platforms.', 'watch-cartoons'); ?></p>
        </section>

        <!-- Main Content -->
        <div class="content-wrapper">
            <h2 class="section-title"><?php esc_html_e('Best Cartoon Streaming Sites', 'watch-cartoons'); ?></h2>
            
            <div class="cartoon-sites">
                <?php
                // Get cartoon sites data
                $cartoon_sites = get_cartoon_sites_data();
                
                foreach ($cartoon_sites as $site) :
                ?>
                <div class="site-card">
                    <div class="site-image">
                        <?php echo esc_html(substr($site['name'], 0, 3)); ?>
                    </div>
                    <div class="site-content">
                        <h3 class="site-title"><?php echo esc_html($site['name']); ?></h3>
                        <div class="site-type"><?php echo esc_html($site['type']); ?></div>
                        <div class="site-platform"><?php esc_html_e('Platform:', 'watch-cartoons'); ?> <?php echo esc_html($site['platform']); ?></div>
                        <p class="site-description"><?php echo esc_html($site['description']); ?></p>
                        <a href="<?php echo esc_url($site['url']); ?>" class="visit-btn" target="_blank" rel="noopener noreferrer">
                            <?php esc_html_e('Visit Site', 'watch-cartoons'); ?>
                        </a>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>

            <!-- SEO Keywords Section -->
            <section class="seo-keywords">
                <h3 class="section-title"><?php esc_html_e('Popular Search Terms', 'watch-cartoons'); ?></h3>
                <div class="keywords-grid">
                    <?php
                    $keywords = get_seo_keywords();
                    foreach ($keywords as $keyword) :
                    ?>
                    <div class="keyword-tag">
                        <?php echo esc_html($keyword); ?>
                    </div>
                    <?php endforeach; ?>
                </div>
            </section>

            <!-- Additional Content for SEO -->
            <section class="seo-content">
                <h3><?php esc_html_e('Why Choose Our Cartoon Directory?', 'watch-cartoons'); ?></h3>
                <p><?php esc_html_e('Our comprehensive directory helps you find the best places to watch cartoons online for free. We carefully curate safe and legal streaming platforms that offer high-quality animated content for viewers of all ages.', 'watch-cartoons'); ?></p>
                
                <h4><?php esc_html_e('Features of Top Cartoon Sites:', 'watch-cartoons'); ?></h4>
                <ul>
                    <li><?php esc_html_e('Free streaming with minimal ads', 'watch-cartoons'); ?></li>
                    <li><?php esc_html_e('HD quality video playback', 'watch-cartoons'); ?></li>
                    <li><?php esc_html_e('Large collection of classic and modern cartoons', 'watch-cartoons'); ?></li>
                    <li><?php esc_html_e('User-friendly interface and easy navigation', 'watch-cartoons'); ?></li>
                    <li><?php esc_html_e('Regular updates with new content', 'watch-cartoons'); ?></li>
                </ul>
            </section>
        </div>
    </div>
</main>

<?php get_footer(); ?>