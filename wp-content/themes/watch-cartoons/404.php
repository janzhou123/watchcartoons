<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package WatchCartoons
 */

declare(strict_types=1);

get_header(); ?>

<main id="main" class="site-main">
    <div class="container">
        <div class="content-wrapper">
            <section class="error-404 not-found">
                <header class="page-header">
                    <h1 class="page-title"><?php esc_html_e('Oops! Page Not Found', 'watch-cartoons'); ?></h1>
                    <div class="error-code">404</div>
                </header>

                <div class="page-content">
                    <p class="error-message">
                        <?php esc_html_e('It looks like the page you\'re looking for doesn\'t exist. But don\'t worry, we have plenty of great cartoon sites for you to explore!', 'watch-cartoons'); ?>
                    </p>

                    <div class="error-actions">
                        <div class="search-section">
                            <h3><?php esc_html_e('Try searching for cartoons:', 'watch-cartoons'); ?></h3>
                            <?php get_search_form(); ?>
                        </div>

                        <div class="quick-links">
                            <h3><?php esc_html_e('Quick Links:', 'watch-cartoons'); ?></h3>
                            <div class="link-buttons">
                                <a href="<?php echo esc_url(home_url('/')); ?>" class="visit-btn">
                                    <?php esc_html_e('Go Home', 'watch-cartoons'); ?>
                                </a>
                                <a href="#popular-sites" class="visit-btn secondary">
                                    <?php esc_html_e('Browse Sites', 'watch-cartoons'); ?>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="helpful-suggestions">
                        <h3><?php esc_html_e('Popular Searches:', 'watch-cartoons'); ?></h3>
                        <div class="suggestion-tags">
                            <?php
                            $popular_searches = array(
                                'free cartoons online',
                                'watch anime',
                                'classic cartoons',
                                'kids shows',
                                'cartoon streaming',
                                'animated movies'
                            );
                            
                            foreach ($popular_searches as $search) :
                            ?>
                            <a href="<?php echo esc_url(home_url('/?s=' . urlencode($search))); ?>" class="suggestion-tag">
                                <?php echo esc_html($search); ?>
                            </a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Popular Cartoon Sites -->
            <section id="popular-sites" class="popular-sites">
                <h2 class="section-title"><?php esc_html_e('Popular Cartoon Sites', 'watch-cartoons'); ?></h2>
                <p class="section-description">
                    <?php esc_html_e('Since you\'re here, why not check out some of the most popular cartoon streaming sites?', 'watch-cartoons'); ?>
                </p>
                
                <div class="cartoon-sites">
                    <?php
                    $popular_sites = array_slice(get_cartoon_sites_data(), 0, 6);
                    foreach ($popular_sites as $site) :
                    ?>
                    <div class="site-card">
                        <div class="site-image">
                            <?php echo esc_html(substr($site['name'], 0, 3)); ?>
                        </div>
                        <div class="site-content">
                            <h3 class="site-title"><?php echo esc_html($site['name']); ?></h3>
                            <div class="site-type"><?php echo esc_html($site['type']); ?></div>
                            <p class="site-description"><?php echo esc_html(wp_trim_words($site['description'], 15)); ?></p>
                            <a href="<?php echo esc_url($site['url']); ?>" class="visit-btn" target="_blank" rel="noopener noreferrer">
                                <?php esc_html_e('Visit Site', 'watch-cartoons'); ?>
                            </a>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </section>

            <!-- SEO Content -->
            <section class="seo-content">
                <h3><?php esc_html_e('About Watching Cartoons Online', 'watch-cartoons'); ?></h3>
                <p>
                    <?php esc_html_e('Watching cartoons online has become increasingly popular, offering viewers access to both classic and modern animated content. Our directory helps you find legitimate streaming platforms where you can watch cartoons free and safely.', 'watch-cartoons'); ?>
                </p>
                <p>
                    <?php esc_html_e('Whether you\'re looking for nostalgic childhood favorites or the latest animated series, these platforms provide high-quality streaming experiences with minimal interruptions.', 'watch-cartoons'); ?>
                </p>
            </section>
        </div>
    </div>
</main>

<style>
/* 404 Page Styles */
.error-404 {
    text-align: center;
    padding: 2rem 0;
}

.page-header {
    background: linear-gradient(135deg, #e74c3c 0%, #c0392b 100%);
    color: white;
    padding: 3rem 2rem;
    border-radius: 20px;
    margin-bottom: 3rem;
    position: relative;
    overflow: hidden;
}

.page-header::before {
    content: '';
    position: absolute;
    top: -50%;
    left: -50%;
    width: 200%;
    height: 200%;
    background: repeating-linear-gradient(
        45deg,
        transparent,
        transparent 10px,
        rgba(255,255,255,0.05) 10px,
        rgba(255,255,255,0.05) 20px
    );
    animation: slide 20s linear infinite;
}

@keyframes slide {
    0% { transform: translateX(-50px) translateY(-50px); }
    100% { transform: translateX(50px) translateY(50px); }
}

.page-title {
    font-size: 3rem;
    margin-bottom: 1rem;
    position: relative;
    z-index: 1;
}

.error-code {
    font-size: 8rem;
    font-weight: bold;
    opacity: 0.3;
    line-height: 1;
    position: relative;
    z-index: 1;
}

.page-content {
    max-width: 800px;
    margin: 0 auto;
}

.error-message {
    font-size: 1.2rem;
    color: #666;
    margin-bottom: 3rem;
    line-height: 1.6;
}

.error-actions {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 2rem;
    margin-bottom: 3rem;
}

.search-section,
.quick-links {
    background: #f8f9fa;
    padding: 2rem;
    border-radius: 15px;
    border: 1px solid #e9ecef;
}

.search-section h3,
.quick-links h3 {
    color: #333;
    margin-bottom: 1rem;
    font-size: 1.3rem;
}

.link-buttons {
    display: flex;
    gap: 1rem;
    justify-content: center;
    flex-wrap: wrap;
}

.visit-btn.secondary {
    background: linear-gradient(45deg, #6c757d, #495057);
}

.visit-btn.secondary:hover {
    box-shadow: 0 5px 15px rgba(108, 117, 125, 0.4);
}

.helpful-suggestions {
    margin: 3rem 0;
}

.helpful-suggestions h3 {
    color: #333;
    margin-bottom: 1.5rem;
    font-size: 1.5rem;
}

.suggestion-tags {
    display: flex;
    flex-wrap: wrap;
    gap: 1rem;
    justify-content: center;
}

.suggestion-tag {
    display: inline-block;
    background: white;
    color: #667eea;
    padding: 10px 20px;
    border-radius: 25px;
    text-decoration: none;
    border: 2px solid #667eea;
    transition: all 0.3s ease;
    font-size: 0.9rem;
}

.suggestion-tag:hover {
    background: #667eea;
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(102, 126, 234, 0.3);
    text-decoration: none;
}

.popular-sites {
    margin: 4rem 0;
}

.section-description {
    text-align: center;
    color: #666;
    font-size: 1.1rem;
    margin-bottom: 2rem;
    max-width: 600px;
    margin-left: auto;
    margin-right: auto;
}

.seo-content {
    background: #f8f9fa;
    padding: 3rem;
    border-radius: 15px;
    margin: 3rem 0;
    text-align: left;
}

.seo-content h3 {
    color: #333;
    margin-bottom: 1.5rem;
    text-align: center;
}

.seo-content p {
    color: #666;
    line-height: 1.7;
    margin-bottom: 1rem;
}

/* Responsive Design */
@media (max-width: 768px) {
    .page-title {
        font-size: 2.5rem;
    }
    
    .error-code {
        font-size: 6rem;
    }
    
    .error-actions {
        grid-template-columns: 1fr;
    }
    
    .link-buttons {
        flex-direction: column;
        align-items: center;
    }
    
    .suggestion-tags {
        flex-direction: column;
        align-items: center;
    }
    
    .search-section,
    .quick-links {
        padding: 1.5rem;
    }
}

@media (max-width: 480px) {
    .page-title {
        font-size: 2rem;
    }
    
    .error-code {
        font-size: 4rem;
    }
    
    .page-header {
        padding: 2rem 1rem;
    }
}
</style>

<?php get_footer(); ?>