<?php
/**
 * The footer for Watch Cartoons Online theme
 *
 * @package WatchCartoons
 */

declare(strict_types=1);

?>

<footer id="colophon" class="site-footer">
    <div class="container">
        <div class="footer-content">
            <div class="footer-section">
                <h3><?php esc_html_e('About Watch Cartoons Online', 'watch-cartoons'); ?></h3>
                <p><?php esc_html_e('Your trusted directory for finding the best free cartoon streaming websites. We help you discover safe and legal platforms to watch your favorite animated content.', 'watch-cartoons'); ?></p>
            </div>
            
            <div class="footer-section">
                <h3><?php esc_html_e('Popular Categories', 'watch-cartoons'); ?></h3>
                <ul class="footer-links">
                    <li><a href="#"><?php esc_html_e('Classic Cartoons', 'watch-cartoons'); ?></a></li>
                    <li><a href="#"><?php esc_html_e('Anime Series', 'watch-cartoons'); ?></a></li>
                    <li><a href="#"><?php esc_html_e('Kids Shows', 'watch-cartoons'); ?></a></li>
                    <li><a href="#"><?php esc_html_e('Adult Animation', 'watch-cartoons'); ?></a></li>
                </ul>
            </div>
            
            <div class="footer-section">
                <h3><?php esc_html_e('Quick Links', 'watch-cartoons'); ?></h3>
                <ul class="footer-links">
                    <li><a href="<?php echo esc_url(home_url('/')); ?>"><?php esc_html_e('Home', 'watch-cartoons'); ?></a></li>
                    <li><a href="#"><?php esc_html_e('Best Sites', 'watch-cartoons'); ?></a></li>
                    <li><a href="#"><?php esc_html_e('Free Streaming', 'watch-cartoons'); ?></a></li>
                    <li><a href="#"><?php esc_html_e('Contact', 'watch-cartoons'); ?></a></li>
                </ul>
            </div>
            
            <div class="footer-section">
                <h3><?php esc_html_e('Disclaimer', 'watch-cartoons'); ?></h3>
                <p class="disclaimer"><?php esc_html_e('We only recommend legal streaming platforms. Always respect copyright laws and terms of service of the websites you visit.', 'watch-cartoons'); ?></p>
            </div>
        </div>
        
        <div class="footer-bottom">
            <div class="copyright">
                <p>&copy; <?php echo esc_html(date('Y')); ?> <?php esc_html_e('Watch Cartoons Online. All rights reserved.', 'watch-cartoons'); ?></p>
            </div>
            
            <div class="footer-keywords">
                <p class="keywords-text">
                    <?php esc_html_e('Keywords:', 'watch-cartoons'); ?> 
                    <span class="keywords">
                        <?php echo esc_html(implode(', ', array_slice(get_seo_keywords(), 0, 6))); ?>
                    </span>
                </p>
            </div>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>

<style>
/* Footer Styles */
.site-footer {
    background: #2c3e50;
    color: #ecf0f1;
    padding: 3rem 0 1rem;
    margin-top: 4rem;
}

.footer-content {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 2rem;
    margin-bottom: 2rem;
}

.footer-section h3 {
    color: #3498db;
    margin-bottom: 1rem;
    font-size: 1.2rem;
}

.footer-section p {
    line-height: 1.6;
    color: #bdc3c7;
}

.footer-links {
    list-style: none;
    padding: 0;
}

.footer-links li {
    margin-bottom: 0.5rem;
}

.footer-links a {
    color: #bdc3c7;
    text-decoration: none;
    transition: color 0.3s ease;
}

.footer-links a:hover {
    color: #3498db;
}

.disclaimer {
    font-size: 0.9rem;
    font-style: italic;
}

.footer-bottom {
    border-top: 1px solid #34495e;
    padding-top: 1rem;
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 1rem;
}

.copyright p {
    margin: 0;
    color: #95a5a6;
}

.keywords-text {
    font-size: 0.8rem;
    color: #7f8c8d;
    margin: 0;
}

.keywords {
    font-style: italic;
}

@media (max-width: 768px) {
    .footer-content {
        grid-template-columns: 1fr;
        text-align: center;
    }
    
    .footer-bottom {
        flex-direction: column;
        text-align: center;
    }
}
</style>

</body>
</html>