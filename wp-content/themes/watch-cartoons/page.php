<?php
/**
 * The template for displaying all pages
 *
 * @package WatchCartoons
 */

declare(strict_types=1);

get_header(); ?>

<main id="main" class="site-main">
    <div class="container">
        <div class="content-wrapper">
            <?php
            while (have_posts()) :
                the_post();
            ?>
            <article id="page-<?php the_ID(); ?>" <?php post_class('single-page'); ?>>
                <header class="page-header">
                    <h1 class="page-title"><?php the_title(); ?></h1>
                    
                    <?php if (has_post_thumbnail()) : ?>
                    <div class="featured-image">
                        <?php the_post_thumbnail('large', array('class' => 'img-responsive')); ?>
                    </div>
                    <?php endif; ?>
                    
                    <?php if (has_excerpt()) : ?>
                    <div class="page-excerpt">
                        <?php the_excerpt(); ?>
                    </div>
                    <?php endif; ?>
                </header>

                <div class="page-content">
                    <?php
                    the_content();
                    
                    wp_link_pages(array(
                        'before' => '<div class="page-links">' . esc_html__('Pages:', 'watch-cartoons'),
                        'after'  => '</div>',
                    ));
                    ?>
                </div>

                <?php if (comments_open() || get_comments_number()) : ?>
                <div class="page-comments">
                    <?php comments_template(); ?>
                </div>
                <?php endif; ?>
            </article>

            <!-- Featured Cartoon Sites Section -->
            <?php if (is_front_page() || is_page('home')) : ?>
            <section class="featured-sites">
                <h2 class="section-title"><?php esc_html_e('Featured Cartoon Sites', 'watch-cartoons'); ?></h2>
                <p class="section-description">
                    <?php esc_html_e('Discover the best places to watch cartoons online for free. Our curated list includes safe and reliable streaming platforms.', 'watch-cartoons'); ?>
                </p>
                
                <div class="cartoon-sites">
                    <?php
                    $featured_sites = array_slice(get_cartoon_sites_data(), 0, 6);
                    foreach ($featured_sites as $site) :
                    ?>
                    <div class="site-card featured">
                        <div class="site-image">
                            <div class="site-icon"><?php echo esc_html(substr($site['name'], 0, 3)); ?></div>
                            <div class="site-badge"><?php echo esc_html($site['type']); ?></div>
                        </div>
                        <div class="site-content">
                            <h3 class="site-title"><?php echo esc_html($site['name']); ?></h3>
                            <div class="site-meta">
                                <span class="site-platform"><?php echo esc_html($site['platform']); ?></span>
                                <span class="site-rating">⭐ <?php echo esc_html($site['rating']); ?></span>
                            </div>
                            <p class="site-description"><?php echo esc_html(wp_trim_words($site['description'], 15)); ?></p>
                            <div class="site-features">
                                <?php foreach (array_slice($site['features'], 0, 3) as $feature) : ?>
                                <span class="feature-tag"><?php echo esc_html($feature); ?></span>
                                <?php endforeach; ?>
                            </div>
                            <a href="<?php echo esc_url($site['url']); ?>" class="visit-btn" target="_blank" rel="noopener noreferrer">
                                <?php esc_html_e('Visit Site', 'watch-cartoons'); ?>
                                <span class="btn-icon">→</span>
                            </a>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </section>
            <?php endif; ?>

            <!-- About Section for specific pages -->
            <?php if (is_page(array('about', 'about-us'))) : ?>
            <section class="about-section">
                <div class="about-grid">
                    <div class="about-card">
                        <div class="card-icon">🎬</div>
                        <h3><?php esc_html_e('Our Mission', 'watch-cartoons'); ?></h3>
                        <p><?php esc_html_e('To provide a comprehensive directory of safe and reliable cartoon streaming websites, making it easy for viewers to find their favorite animated content.', 'watch-cartoons'); ?></p>
                    </div>
                    
                    <div class="about-card">
                        <div class="card-icon">🔒</div>
                        <h3><?php esc_html_e('Safety First', 'watch-cartoons'); ?></h3>
                        <p><?php esc_html_e('We carefully review and recommend only legitimate streaming platforms that prioritize user safety and provide quality viewing experiences.', 'watch-cartoons'); ?></p>
                    </div>
                    
                    <div class="about-card">
                        <div class="card-icon">🌟</div>
                        <h3><?php esc_html_e('Quality Content', 'watch-cartoons'); ?></h3>
                        <p><?php esc_html_e('Our curated list includes platforms offering high-quality streams, diverse content libraries, and user-friendly interfaces.', 'watch-cartoons'); ?></p>
                    </div>
                </div>
            </section>
            <?php endif; ?>

            <!-- Contact Section for contact pages -->
            <?php if (is_page(array('contact', 'contact-us'))) : ?>
            <section class="contact-info">
                <div class="contact-grid">
                    <div class="contact-card">
                        <div class="contact-icon">📧</div>
                        <h3><?php esc_html_e('Email Us', 'watch-cartoons'); ?></h3>
                        <p><?php esc_html_e('Have questions or suggestions? Send us an email and we\'ll get back to you as soon as possible.', 'watch-cartoons'); ?></p>
                        <a href="mailto:info@watchcartoons.com" class="contact-link">info@watchcartoons.com</a>
                    </div>
                    
                    <div class="contact-card">
                        <div class="contact-icon">💬</div>
                        <h3><?php esc_html_e('Feedback', 'watch-cartoons'); ?></h3>
                        <p><?php esc_html_e('Your feedback helps us improve our directory and provide better recommendations for cartoon streaming sites.', 'watch-cartoons'); ?></p>
                        <a href="#comments" class="contact-link"><?php esc_html_e('Leave Feedback', 'watch-cartoons'); ?></a>
                    </div>
                    
                    <div class="contact-card">
                        <div class="contact-icon">🚀</div>
                        <h3><?php esc_html_e('Suggest a Site', 'watch-cartoons'); ?></h3>
                        <p><?php esc_html_e('Know a great cartoon streaming site we should include? Let us know and we\'ll review it for our directory.', 'watch-cartoons'); ?></p>
                        <a href="#suggest-form" class="contact-link"><?php esc_html_e('Suggest Site', 'watch-cartoons'); ?></a>
                    </div>
                </div>
            </section>
            <?php endif; ?>

            <?php endwhile; ?>
        </div>
    </div>
</main>

<style>
/* Page Styles */
.single-page {
    background: white;
    border-radius: 20px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    overflow: hidden;
    margin-bottom: 3rem;
}

.page-header {
    padding: 3rem 2rem;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    text-align: center;
    position: relative;
}

.page-header::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="dots" width="20" height="20" patternUnits="userSpaceOnUse"><circle cx="10" cy="10" r="1" fill="%23ffffff" opacity="0.2"/></pattern></defs><rect width="100" height="100" fill="url(%23dots)"/></svg>') repeat;
    pointer-events: none;
}

.page-title {
    font-size: 3rem;
    margin: 0 0 1rem 0;
    line-height: 1.2;
    position: relative;
    z-index: 1;
}

.featured-image {
    margin: 2rem auto 0;
    max-width: 600px;
    border-radius: 15px;
    overflow: hidden;
    position: relative;
    z-index: 1;
}

.featured-image img {
    width: 100%;
    height: auto;
    display: block;
}

.page-excerpt {
    font-size: 1.2rem;
    margin-top: 1.5rem;
    opacity: 0.9;
    max-width: 800px;
    margin-left: auto;
    margin-right: auto;
    position: relative;
    z-index: 1;
}

.page-content {
    padding: 3rem 2rem;
    line-height: 1.8;
    color: #333;
}

.page-content h1,
.page-content h2,
.page-content h3,
.page-content h4,
.page-content h5,
.page-content h6 {
    color: #2c3e50;
    margin-top: 2.5rem;
    margin-bottom: 1rem;
}

.page-content h2 {
    font-size: 2rem;
    border-bottom: 3px solid #667eea;
    padding-bottom: 0.5rem;
}

.page-content p {
    margin-bottom: 1.5rem;
}

.page-content a {
    color: #667eea;
    text-decoration: none;
    border-bottom: 1px solid transparent;
    transition: all 0.3s ease;
}

.page-content a:hover {
    color: #764ba2;
    border-bottom-color: #764ba2;
}

.page-content ul,
.page-content ol {
    margin: 1.5rem 0;
    padding-left: 2rem;
}

.page-content li {
    margin-bottom: 0.5rem;
}

.page-links {
    margin: 2rem 0;
    text-align: center;
}

.page-links a {
    display: inline-block;
    padding: 0.75rem 1.5rem;
    margin: 0 0.25rem;
    background: #667eea;
    color: white;
    text-decoration: none;
    border-radius: 25px;
    transition: all 0.3s ease;
    font-weight: 500;
}

.page-links a:hover {
    background: #764ba2;
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(102, 126, 234, 0.3);
}

.page-comments {
    padding: 2rem;
    background: #f8f9fa;
    border-top: 1px solid #e9ecef;
}

/* Featured Sites Section */
.featured-sites {
    margin: 4rem 0;
}

.site-card.featured {
    position: relative;
    overflow: hidden;
}

.site-card.featured::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(90deg, #667eea, #764ba2);
}

.site-badge {
    position: absolute;
    top: 1rem;
    right: 1rem;
    background: rgba(102, 126, 234, 0.9);
    color: white;
    padding: 0.25rem 0.75rem;
    border-radius: 15px;
    font-size: 0.8rem;
    font-weight: 500;
}

.site-meta {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin: 0.5rem 0;
    font-size: 0.9rem;
    color: #666;
}

.site-features {
    display: flex;
    flex-wrap: wrap;
    gap: 0.5rem;
    margin: 1rem 0;
}

.feature-tag {
    background: #f8f9fa;
    color: #667eea;
    padding: 0.25rem 0.75rem;
    border-radius: 15px;
    font-size: 0.8rem;
    border: 1px solid #e9ecef;
}

.visit-btn .btn-icon {
    margin-left: 0.5rem;
    transition: transform 0.3s ease;
}

.visit-btn:hover .btn-icon {
    transform: translateX(3px);
}

/* About Section */
.about-section {
    margin: 4rem 0;
}

.about-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 2rem;
    margin-top: 2rem;
}

.about-card {
    background: white;
    padding: 2.5rem 2rem;
    border-radius: 20px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    text-align: center;
    transition: all 0.3s ease;
    border: 1px solid #f0f0f0;
}

.about-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 20px 40px rgba(0,0,0,0.15);
}

.card-icon {
    font-size: 3rem;
    margin-bottom: 1.5rem;
    display: block;
}

.about-card h3 {
    color: #333;
    margin-bottom: 1rem;
    font-size: 1.5rem;
}

.about-card p {
    color: #666;
    line-height: 1.6;
    margin: 0;
}

/* Contact Section */
.contact-info {
    margin: 4rem 0;
}

.contact-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 2rem;
    margin-top: 2rem;
}

.contact-card {
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    padding: 2.5rem 2rem;
    border-radius: 20px;
    text-align: center;
    transition: all 0.3s ease;
    border: 1px solid #dee2e6;
}

.contact-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 15px 35px rgba(0,0,0,0.1);
}

.contact-icon {
    font-size: 3rem;
    margin-bottom: 1.5rem;
    display: block;
}

.contact-card h3 {
    color: #333;
    margin-bottom: 1rem;
    font-size: 1.5rem;
}

.contact-card p {
    color: #666;
    line-height: 1.6;
    margin-bottom: 1.5rem;
}

.contact-link {
    display: inline-block;
    background: #667eea;
    color: white;
    padding: 0.75rem 1.5rem;
    border-radius: 25px;
    text-decoration: none;
    font-weight: 500;
    transition: all 0.3s ease;
}

.contact-link:hover {
    background: #764ba2;
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(102, 126, 234, 0.3);
    text-decoration: none;
    color: white;
}

/* Responsive Design */
@media (max-width: 768px) {
    .page-title {
        font-size: 2.5rem;
    }
    
    .page-header,
    .page-content {
        padding: 2rem 1.5rem;
    }
    
    .about-grid,
    .contact-grid {
        grid-template-columns: 1fr;
    }
    
    .site-meta {
        flex-direction: column;
        align-items: flex-start;
        gap: 0.5rem;
    }
}

@media (max-width: 480px) {
    .page-title {
        font-size: 2rem;
    }
    
    .page-header,
    .page-content {
        padding: 1.5rem 1rem;
    }
    
    .about-card,
    .contact-card {
        padding: 2rem 1.5rem;
    }
    
    .site-features {
        flex-direction: column;
    }
}
</style>

<?php get_footer(); ?>