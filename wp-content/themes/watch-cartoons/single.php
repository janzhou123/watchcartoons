<?php
/**
 * The template for displaying all single posts
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
            <article id="post-<?php the_ID(); ?>" <?php post_class('single-post'); ?>>
                <header class="entry-header">
                    <div class="post-meta">
                        <span class="post-date">
                            <i class="icon-calendar"></i>
                            <?php echo get_the_date(); ?>
                        </span>
                        <span class="post-author">
                            <i class="icon-user"></i>
                            <?php the_author(); ?>
                        </span>
                        <?php if (has_category()) : ?>
                        <span class="post-category">
                            <i class="icon-folder"></i>
                            <?php the_category(', '); ?>
                        </span>
                        <?php endif; ?>
                    </div>
                    
                    <h1 class="entry-title"><?php the_title(); ?></h1>
                    
                    <?php if (has_post_thumbnail()) : ?>
                    <div class="featured-image">
                        <?php the_post_thumbnail('large', array('class' => 'img-responsive')); ?>
                    </div>
                    <?php endif; ?>
                </header>

                <div class="entry-content">
                    <?php
                    the_content();
                    
                    wp_link_pages(array(
                        'before' => '<div class="page-links">' . esc_html__('Pages:', 'watch-cartoons'),
                        'after'  => '</div>',
                    ));
                    ?>
                </div>

                <?php if (has_tag()) : ?>
                <footer class="entry-footer">
                    <div class="post-tags">
                        <h4><?php esc_html_e('Tags:', 'watch-cartoons'); ?></h4>
                        <?php the_tags('<div class="tag-list">', '', '</div>'); ?>
                    </div>
                </footer>
                <?php endif; ?>
            </article>

            <!-- Related Cartoon Sites -->
            <section class="related-content">
                <h2 class="section-title"><?php esc_html_e('Recommended Cartoon Sites', 'watch-cartoons'); ?></h2>
                <div class="cartoon-sites">
                    <?php
                    $related_sites = array_slice(get_cartoon_sites_data(), 0, 4);
                    foreach ($related_sites as $site) :
                    ?>
                    <div class="site-card">
                        <div class="site-image">
                            <?php echo esc_html(substr($site['name'], 0, 3)); ?>
                        </div>
                        <div class="site-content">
                            <h3 class="site-title"><?php echo esc_html($site['name']); ?></h3>
                            <div class="site-type"><?php echo esc_html($site['type']); ?></div>
                            <div class="site-platform"><?php echo esc_html($site['platform']); ?></div>
                            <p class="site-description"><?php echo esc_html(wp_trim_words($site['description'], 12)); ?></p>
                            <a href="<?php echo esc_url($site['url']); ?>" class="visit-btn" target="_blank" rel="noopener noreferrer">
                                <?php esc_html_e('Visit Site', 'watch-cartoons'); ?>
                            </a>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </section>

            <!-- Comments Section -->
            <?php
            if (comments_open() || get_comments_number()) :
                comments_template();
            endif;
            ?>

            <!-- Navigation -->
            <nav class="post-navigation" aria-label="<?php esc_attr_e('Post navigation', 'watch-cartoons'); ?>">
                <div class="nav-links">
                    <?php
                    $prev_post = get_previous_post();
                    $next_post = get_next_post();
                    
                    if ($prev_post) :
                    ?>
                    <div class="nav-previous">
                        <a href="<?php echo esc_url(get_permalink($prev_post)); ?>" rel="prev">
                            <span class="nav-subtitle"><?php esc_html_e('Previous Post', 'watch-cartoons'); ?></span>
                            <span class="nav-title"><?php echo esc_html(get_the_title($prev_post)); ?></span>
                        </a>
                    </div>
                    <?php endif; ?>
                    
                    <?php if ($next_post) : ?>
                    <div class="nav-next">
                        <a href="<?php echo esc_url(get_permalink($next_post)); ?>" rel="next">
                            <span class="nav-subtitle"><?php esc_html_e('Next Post', 'watch-cartoons'); ?></span>
                            <span class="nav-title"><?php echo esc_html(get_the_title($next_post)); ?></span>
                        </a>
                    </div>
                    <?php endif; ?>
                </div>
            </nav>

            <?php endwhile; ?>
        </div>
    </div>
</main>

<style>
/* Single Post Styles */
.single-post {
    background: white;
    border-radius: 20px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    overflow: hidden;
    margin-bottom: 3rem;
}

.entry-header {
    padding: 2rem;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    position: relative;
}

.entry-header::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="1" fill="%23ffffff" opacity="0.1"/><circle cx="75" cy="75" r="1" fill="%23ffffff" opacity="0.1"/><circle cx="50" cy="10" r="0.5" fill="%23ffffff" opacity="0.1"/><circle cx="10" cy="50" r="0.5" fill="%23ffffff" opacity="0.1"/><circle cx="90" cy="30" r="0.5" fill="%23ffffff" opacity="0.1"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>') repeat;
    pointer-events: none;
}

.post-meta {
    display: flex;
    flex-wrap: wrap;
    gap: 1.5rem;
    margin-bottom: 1.5rem;
    font-size: 0.9rem;
    position: relative;
    z-index: 1;
}

.post-meta span {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    background: rgba(255,255,255,0.2);
    padding: 0.5rem 1rem;
    border-radius: 20px;
    backdrop-filter: blur(10px);
}

.post-meta .icon-calendar::before { content: '📅'; }
.post-meta .icon-user::before { content: '👤'; }
.post-meta .icon-folder::before { content: '📁'; }

.entry-title {
    font-size: 2.5rem;
    margin: 0;
    line-height: 1.2;
    position: relative;
    z-index: 1;
}

.featured-image {
    margin-top: 2rem;
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

.entry-content {
    padding: 3rem 2rem;
    line-height: 1.8;
    color: #333;
}

.entry-content h1,
.entry-content h2,
.entry-content h3,
.entry-content h4,
.entry-content h5,
.entry-content h6 {
    color: #2c3e50;
    margin-top: 2rem;
    margin-bottom: 1rem;
}

.entry-content p {
    margin-bottom: 1.5rem;
}

.entry-content a {
    color: #667eea;
    text-decoration: none;
    border-bottom: 1px solid transparent;
    transition: all 0.3s ease;
}

.entry-content a:hover {
    color: #764ba2;
    border-bottom-color: #764ba2;
}

.page-links {
    margin: 2rem 0;
    text-align: center;
}

.page-links a {
    display: inline-block;
    padding: 0.5rem 1rem;
    margin: 0 0.25rem;
    background: #667eea;
    color: white;
    text-decoration: none;
    border-radius: 5px;
    transition: all 0.3s ease;
}

.page-links a:hover {
    background: #764ba2;
    transform: translateY(-2px);
}

.entry-footer {
    padding: 2rem;
    background: #f8f9fa;
    border-top: 1px solid #e9ecef;
}

.post-tags h4 {
    color: #333;
    margin-bottom: 1rem;
    font-size: 1.2rem;
}

.tag-list {
    display: flex;
    flex-wrap: wrap;
    gap: 0.5rem;
}

.tag-list a {
    display: inline-block;
    background: white;
    color: #667eea;
    padding: 0.5rem 1rem;
    border-radius: 20px;
    text-decoration: none;
    border: 1px solid #667eea;
    font-size: 0.9rem;
    transition: all 0.3s ease;
}

.tag-list a:hover {
    background: #667eea;
    color: white;
    transform: translateY(-2px);
}

.related-content {
    margin: 4rem 0;
}

.post-navigation {
    background: white;
    border-radius: 15px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    padding: 2rem;
    margin: 3rem 0;
}

.nav-links {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 2rem;
}

.nav-previous,
.nav-next {
    padding: 1.5rem;
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    border-radius: 10px;
    transition: all 0.3s ease;
}

.nav-previous:hover,
.nav-next:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.15);
}

.nav-previous a,
.nav-next a {
    text-decoration: none;
    color: inherit;
    display: block;
}

.nav-subtitle {
    display: block;
    font-size: 0.9rem;
    color: #666;
    margin-bottom: 0.5rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.nav-title {
    display: block;
    font-size: 1.1rem;
    font-weight: 600;
    color: #333;
    line-height: 1.3;
}

.nav-next {
    text-align: right;
}

/* Responsive Design */
@media (max-width: 768px) {
    .entry-title {
        font-size: 2rem;
    }
    
    .entry-header,
    .entry-content,
    .entry-footer {
        padding: 1.5rem;
    }
    
    .post-meta {
        flex-direction: column;
        gap: 0.5rem;
    }
    
    .nav-links {
        grid-template-columns: 1fr;
    }
    
    .nav-next {
        text-align: left;
    }
}

@media (max-width: 480px) {
    .entry-title {
        font-size: 1.8rem;
    }
    
    .entry-header,
    .entry-content,
    .entry-footer {
        padding: 1rem;
    }
    
    .tag-list {
        flex-direction: column;
    }
}
</style>

<?php get_footer(); ?>