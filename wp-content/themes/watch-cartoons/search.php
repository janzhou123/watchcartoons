<?php
/**
 * The template for displaying search results
 *
 * @package WatchCartoons
 */

declare(strict_types=1);

get_header(); ?>

<main id="main" class="site-main">
    <div class="container">
        <div class="content-wrapper">
            <header class="page-header">
                <h1 class="page-title">
                    <?php
                    printf(
                        /* translators: %s: search query. */
                        esc_html__('Search Results for: %s', 'watch-cartoons'),
                        '<span class="search-query">' . get_search_query() . '</span>'
                    );
                    ?>
                </h1>
            </header>

            <?php if (have_posts()) : ?>
                <div class="search-results">
                    <?php while (have_posts()) : the_post(); ?>
                        <article id="post-<?php the_ID(); ?>" <?php post_class('search-result-item'); ?>>
                            <header class="entry-header">
                                <h2 class="entry-title">
                                    <a href="<?php the_permalink(); ?>" rel="bookmark">
                                        <?php the_title(); ?>
                                    </a>
                                </h2>
                            </header>

                            <div class="entry-summary">
                                <?php the_excerpt(); ?>
                            </div>

                            <footer class="entry-footer">
                                <a href="<?php the_permalink(); ?>" class="read-more">
                                    <?php esc_html_e('Read More', 'watch-cartoons'); ?>
                                </a>
                            </footer>
                        </article>
                    <?php endwhile; ?>

                    <?php
                    the_posts_navigation(array(
                        'prev_text' => esc_html__('Previous Results', 'watch-cartoons'),
                        'next_text' => esc_html__('Next Results', 'watch-cartoons'),
                    ));
                    ?>
                </div>
            <?php else : ?>
                <div class="no-results">
                    <h2><?php esc_html_e('Nothing Found', 'watch-cartoons'); ?></h2>
                    <p><?php esc_html_e('Sorry, but nothing matched your search terms. Please try again with different keywords.', 'watch-cartoons'); ?></p>
                    
                    <div class="search-suggestions">
                        <h3><?php esc_html_e('Try searching for:', 'watch-cartoons'); ?></h3>
                        <ul class="suggestion-list">
                            <?php
                            $suggestions = array(
                                'free cartoons',
                                'anime streaming',
                                'classic cartoons',
                                'kids shows',
                                'cartoon network',
                                'disney cartoons'
                            );
                            
                            foreach ($suggestions as $suggestion) :
                            ?>
                            <li>
                                <a href="<?php echo esc_url(home_url('/?s=' . urlencode($suggestion))); ?>">
                                    <?php echo esc_html($suggestion); ?>
                                </a>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    
                    <div class="back-to-home">
                        <a href="<?php echo esc_url(home_url('/')); ?>" class="visit-btn">
                            <?php esc_html_e('Back to Home', 'watch-cartoons'); ?>
                        </a>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Related Cartoon Sites -->
            <section class="related-sites">
                <h3 class="section-title"><?php esc_html_e('Popular Cartoon Sites', 'watch-cartoons'); ?></h3>
                <div class="cartoon-sites">
                    <?php
                    $featured_sites = array_slice(get_cartoon_sites_data(), 0, 3);
                    foreach ($featured_sites as $site) :
                    ?>
                    <div class="site-card">
                        <div class="site-image">
                            <?php echo esc_html(substr($site['name'], 0, 3)); ?>
                        </div>
                        <div class="site-content">
                            <h4 class="site-title"><?php echo esc_html($site['name']); ?></h4>
                            <div class="site-type"><?php echo esc_html($site['type']); ?></div>
                            <p class="site-description"><?php echo esc_html($site['description']); ?></p>
                            <a href="<?php echo esc_url($site['url']); ?>" class="visit-btn" target="_blank" rel="noopener noreferrer">
                                <?php esc_html_e('Visit Site', 'watch-cartoons'); ?>
                            </a>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </section>
        </div>
    </div>
</main>

<style>
/* Search Results Styles */
.page-header {
    text-align: center;
    margin-bottom: 3rem;
    padding: 2rem 0;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    border-radius: 15px;
}

.page-title {
    font-size: 2.5rem;
    margin: 0;
}

.search-query {
    color: #ffd700;
    font-style: italic;
}

.search-results {
    margin-bottom: 3rem;
}

.search-result-item {
    background: white;
    border-radius: 10px;
    padding: 2rem;
    margin-bottom: 2rem;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    border: 1px solid #f0f0f0;
}

.entry-title {
    margin-bottom: 1rem;
}

.entry-title a {
    color: #333;
    text-decoration: none;
    transition: color 0.3s ease;
}

.entry-title a:hover {
    color: #667eea;
}

.entry-summary {
    color: #666;
    line-height: 1.6;
    margin-bottom: 1rem;
}

.read-more {
    display: inline-block;
    background: linear-gradient(45deg, #667eea, #764ba2);
    color: white;
    padding: 8px 20px;
    border-radius: 20px;
    text-decoration: none;
    font-size: 0.9rem;
    transition: all 0.3s ease;
}

.read-more:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
    color: white;
    text-decoration: none;
}

.no-results {
    text-align: center;
    padding: 3rem;
    background: #f8f9fa;
    border-radius: 15px;
    margin-bottom: 3rem;
}

.no-results h2 {
    color: #333;
    margin-bottom: 1rem;
}

.search-suggestions {
    margin: 2rem 0;
}

.search-suggestions h3 {
    color: #667eea;
    margin-bottom: 1rem;
}

.suggestion-list {
    list-style: none;
    padding: 0;
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 1rem;
}

.suggestion-list li a {
    display: block;
    background: white;
    color: #667eea;
    padding: 8px 16px;
    border-radius: 20px;
    text-decoration: none;
    border: 2px solid #667eea;
    transition: all 0.3s ease;
}

.suggestion-list li a:hover {
    background: #667eea;
    color: white;
}

.back-to-home {
    margin-top: 2rem;
}

.related-sites {
    margin-top: 3rem;
}

.posts-navigation {
    margin: 2rem 0;
    text-align: center;
}

.nav-links {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 1rem;
}

.nav-links a {
    background: linear-gradient(45deg, #667eea, #764ba2);
    color: white;
    padding: 12px 24px;
    border-radius: 25px;
    text-decoration: none;
    transition: all 0.3s ease;
}

.nav-links a:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
    color: white;
    text-decoration: none;
}

@media (max-width: 768px) {
    .page-title {
        font-size: 2rem;
    }
    
    .search-result-item {
        padding: 1.5rem;
    }
    
    .suggestion-list {
        flex-direction: column;
        align-items: center;
    }
    
    .nav-links {
        flex-direction: column;
    }
}
</style>

<?php get_footer(); ?>