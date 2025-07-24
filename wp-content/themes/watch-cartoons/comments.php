<?php
/**
 * The template for displaying comments
 *
 * @package WatchCartoons
 */

declare(strict_types=1);

if (post_password_required()) {
    return;
}
?>

<div id="comments" class="comments-area">
    <?php if (have_comments()) : ?>
        <h2 class="comments-title">
            <?php
            $comments_number = get_comments_number();
            if ($comments_number === 1) {
                printf(
                    /* translators: 1: title. */
                    esc_html__('One thought on &ldquo;%1$s&rdquo;', 'watch-cartoons'),
                    '<span>' . wp_kses_post(get_the_title()) . '</span>'
                );
            } else {
                printf(
                    /* translators: 1: comment count number, 2: title. */
                    esc_html(_nx('%1$s thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', $comments_number, 'comments title', 'watch-cartoons')),
                    number_format_i18n($comments_number), // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                    '<span>' . wp_kses_post(get_the_title()) . '</span>'
                );
            }
            ?>
        </h2>

        <?php the_comments_navigation(); ?>

        <ol class="comment-list">
            <?php
            wp_list_comments(
                array(
                    'style'       => 'ol',
                    'short_ping'  => true,
                    'avatar_size' => 60,
                    'callback'    => 'watch_cartoons_comment_callback',
                )
            );
            ?>
        </ol>

        <?php the_comments_navigation(); ?>

        <?php if (!comments_open()) : ?>
            <p class="no-comments"><?php esc_html_e('Comments are closed.', 'watch-cartoons'); ?></p>
        <?php endif; ?>

    <?php endif; ?>

    <?php
    comment_form(
        array(
            'title_reply_before' => '<h2 id="reply-title" class="comment-reply-title">',
            'title_reply_after'  => '</h2>',
            'class_form'         => 'comment-form',
            'class_submit'       => 'submit-btn',
            'label_submit'       => esc_html__('Post Comment', 'watch-cartoons'),
            'comment_field'      => '<p class="comment-form-comment"><label for="comment">' . esc_html__('Comment', 'watch-cartoons') . ' <span class="required">*</span></label><textarea id="comment" name="comment" cols="45" rows="8" maxlength="65525" required="required" placeholder="' . esc_attr__('Share your thoughts about cartoon streaming sites...', 'watch-cartoons') . '"></textarea></p>',
            'fields'             => array(
                'author' => '<p class="comment-form-author"><label for="author">' . esc_html__('Name', 'watch-cartoons') . ' <span class="required">*</span></label><input id="author" name="author" type="text" value="' . esc_attr($commenter['comment_author']) . '" size="30" maxlength="245" autocomplete="name" required="required" placeholder="' . esc_attr__('Your name', 'watch-cartoons') . '" /></p>',
                'email'  => '<p class="comment-form-email"><label for="email">' . esc_html__('Email', 'watch-cartoons') . ' <span class="required">*</span></label><input id="email" name="email" type="email" value="' . esc_attr($commenter['comment_author_email']) . '" size="30" maxlength="100" aria-describedby="email-notes" autocomplete="email" required="required" placeholder="' . esc_attr__('your.email@example.com', 'watch-cartoons') . '" /></p>',
                'url'    => '<p class="comment-form-url"><label for="url">' . esc_html__('Website', 'watch-cartoons') . '</label><input id="url" name="url" type="url" value="' . esc_attr($commenter['comment_author_url']) . '" size="30" maxlength="200" autocomplete="url" placeholder="' . esc_attr__('https://yourwebsite.com (optional)', 'watch-cartoons') . '" /></p>',
            ),
        )
    );
    ?>
</div>

<style>
/* Comments Styles */
.comments-area {
    background: white;
    border-radius: 20px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    padding: 3rem 2rem;
    margin: 3rem 0;
}

.comments-title {
    color: #333;
    font-size: 2rem;
    margin-bottom: 2rem;
    padding-bottom: 1rem;
    border-bottom: 3px solid #667eea;
    position: relative;
}

.comments-title::after {
    content: '💬';
    position: absolute;
    right: 0;
    top: 0;
    font-size: 1.5rem;
}

.comments-title span {
    color: #667eea;
    font-style: italic;
}

/* Comment Navigation */
.comment-navigation {
    margin: 2rem 0;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.comment-navigation .nav-previous,
.comment-navigation .nav-next {
    background: #f8f9fa;
    padding: 0.75rem 1.5rem;
    border-radius: 25px;
    border: 1px solid #e9ecef;
    transition: all 0.3s ease;
}

.comment-navigation .nav-previous:hover,
.comment-navigation .nav-next:hover {
    background: #667eea;
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(102, 126, 234, 0.3);
}

.comment-navigation a {
    text-decoration: none;
    color: inherit;
    font-weight: 500;
}

/* Comment List */
.comment-list {
    list-style: none;
    padding: 0;
    margin: 2rem 0;
}

.comment-list .comment {
    background: #f8f9fa;
    border-radius: 15px;
    padding: 2rem;
    margin-bottom: 2rem;
    border-left: 4px solid #667eea;
    transition: all 0.3s ease;
    position: relative;
}

.comment-list .comment:hover {
    transform: translateX(5px);
    box-shadow: 0 5px 20px rgba(0,0,0,0.1);
}

.comment-list .bypostauthor {
    border-left-color: #e74c3c;
    background: linear-gradient(135deg, #fff5f5 0%, #fef2f2 100%);
}

.comment-list .bypostauthor::before {
    content: '👑';
    position: absolute;
    top: 1rem;
    right: 1rem;
    font-size: 1.2rem;
}

/* Comment Meta */
.comment-meta {
    display: flex;
    align-items: center;
    margin-bottom: 1rem;
    gap: 1rem;
}

.comment-author {
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.comment-author .avatar {
    border-radius: 50%;
    border: 3px solid white;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
}

.comment-author .fn {
    font-weight: 600;
    color: #333;
    text-decoration: none;
    font-size: 1.1rem;
}

.comment-author .fn:hover {
    color: #667eea;
}

.comment-metadata {
    color: #666;
    font-size: 0.9rem;
}

.comment-metadata a {
    color: inherit;
    text-decoration: none;
}

.comment-metadata a:hover {
    color: #667eea;
}

/* Comment Content */
.comment-content {
    margin: 1.5rem 0;
    line-height: 1.7;
    color: #333;
}

.comment-content p {
    margin-bottom: 1rem;
}

.comment-content a {
    color: #667eea;
    text-decoration: none;
    border-bottom: 1px solid transparent;
    transition: all 0.3s ease;
}

.comment-content a:hover {
    color: #764ba2;
    border-bottom-color: #764ba2;
}

/* Comment Reply */
.reply {
    margin-top: 1rem;
}

.comment-reply-link {
    background: #667eea;
    color: white;
    padding: 0.5rem 1rem;
    border-radius: 20px;
    text-decoration: none;
    font-size: 0.9rem;
    font-weight: 500;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
}

.comment-reply-link::before {
    content: '↩️';
    font-size: 0.8rem;
}

.comment-reply-link:hover {
    background: #764ba2;
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(102, 126, 234, 0.3);
    text-decoration: none;
    color: white;
}

/* Nested Comments */
.comment-list .children {
    list-style: none;
    padding-left: 2rem;
    margin-top: 2rem;
}

.comment-list .children .comment {
    background: white;
    border-left-color: #95a5a6;
}

/* Comment Form */
.comment-respond {
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    padding: 3rem 2rem;
    border-radius: 20px;
    margin-top: 3rem;
    border: 1px solid #dee2e6;
}

.comment-reply-title {
    color: #333;
    font-size: 1.8rem;
    margin-bottom: 2rem;
    text-align: center;
    position: relative;
}

.comment-reply-title::before {
    content: '✍️';
    margin-right: 0.5rem;
}

.comment-form {
    display: grid;
    gap: 1.5rem;
}

.comment-form p {
    margin: 0;
}

.comment-form label {
    display: block;
    margin-bottom: 0.5rem;
    font-weight: 600;
    color: #333;
}

.comment-form .required {
    color: #e74c3c;
}

.comment-form input[type="text"],
.comment-form input[type="email"],
.comment-form input[type="url"],
.comment-form textarea {
    width: 100%;
    padding: 1rem;
    border: 2px solid #e9ecef;
    border-radius: 10px;
    font-size: 1rem;
    transition: all 0.3s ease;
    background: white;
}

.comment-form input[type="text"]:focus,
.comment-form input[type="email"]:focus,
.comment-form input[type="url"]:focus,
.comment-form textarea:focus {
    outline: none;
    border-color: #667eea;
    box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
}

.comment-form textarea {
    resize: vertical;
    min-height: 120px;
    font-family: inherit;
}

.submit-btn {
    background: linear-gradient(45deg, #667eea, #764ba2);
    color: white;
    padding: 1rem 2rem;
    border: none;
    border-radius: 25px;
    font-size: 1rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    justify-self: center;
    min-width: 200px;
}

.submit-btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px 25px rgba(102, 126, 234, 0.3);
}

.submit-btn:active {
    transform: translateY(-1px);
}

/* Form Grid Layout */
@media (min-width: 768px) {
    .comment-form {
        grid-template-columns: 1fr 1fr;
        grid-template-areas:
            "author email"
            "url url"
            "comment comment"
            "submit submit";
    }
    
    .comment-form-author {
        grid-area: author;
    }
    
    .comment-form-email {
        grid-area: email;
    }
    
    .comment-form-url {
        grid-area: url;
    }
    
    .comment-form-comment {
        grid-area: comment;
    }
    
    .form-submit {
        grid-area: submit;
    }
}

/* No Comments Message */
.no-comments {
    text-align: center;
    color: #666;
    font-style: italic;
    padding: 2rem;
    background: #f8f9fa;
    border-radius: 10px;
    margin: 2rem 0;
}

/* Responsive Design */
@media (max-width: 768px) {
    .comments-area {
        padding: 2rem 1.5rem;
    }
    
    .comment-list .comment {
        padding: 1.5rem;
    }
    
    .comment-list .children {
        padding-left: 1rem;
    }
    
    .comment-respond {
        padding: 2rem 1.5rem;
    }
    
    .comment-navigation {
        flex-direction: column;
        gap: 1rem;
    }
}

@media (max-width: 480px) {
    .comments-area {
        padding: 1.5rem 1rem;
    }
    
    .comment-list .comment {
        padding: 1rem;
    }
    
    .comment-respond {
        padding: 1.5rem 1rem;
    }
    
    .comment-meta {
        flex-direction: column;
        align-items: flex-start;
        gap: 0.5rem;
    }
}
</style>

<?php
// Custom comment callback function
if (!function_exists('watch_cartoons_comment_callback')) :
    function watch_cartoons_comment_callback($comment, $args, $depth) {
        if ('div' === $args['style']) {
            $tag       = 'div';
            $add_below = 'comment';
        } else {
            $tag       = 'li';
            $add_below = 'div-comment';
        }
        ?>
        <<?php echo $tag; ?> <?php comment_class(empty($args['has_children']) ? '' : 'parent'); ?> id="comment-<?php comment_ID(); ?>">
        <?php if ('div' !== $args['style']) : ?>
            <div id="div-comment-<?php comment_ID(); ?>" class="comment-body">
        <?php endif; ?>
        
        <div class="comment-meta">
            <div class="comment-author vcard">
                <?php if ($args['avatar_size'] != 0) echo get_avatar($comment, $args['avatar_size']); ?>
                <?php
                $comment_author = get_comment_author_link();
                if (!empty($comment_author)) :
                ?>
                    <cite class="fn"><?php echo $comment_author; ?></cite>
                <?php endif; ?>
            </div>
            
            <div class="comment-metadata">
                <a href="<?php echo htmlspecialchars(get_comment_link($comment->comment_ID)); ?>">
                    <?php
                    printf(
                        esc_html__('%1$s at %2$s', 'watch-cartoons'),
                        get_comment_date(),
                        get_comment_time()
                    );
                    ?>
                </a>
                <?php edit_comment_link(esc_html__('(Edit)', 'watch-cartoons'), '  ', ''); ?>
            </div>
        </div>
        
        <?php if ($comment->comment_approved == '0') : ?>
            <em class="comment-awaiting-moderation"><?php esc_html_e('Your comment is awaiting moderation.', 'watch-cartoons'); ?></em>
            <br />
        <?php endif; ?>
        
        <div class="comment-content">
            <?php comment_text(); ?>
        </div>
        
        <div class="reply">
            <?php
            comment_reply_link(
                array_merge(
                    $args,
                    array(
                        'add_below' => $add_below,
                        'depth'     => $depth,
                        'max_depth' => $args['max_depth']
                    )
                )
            );
            ?>
        </div>
        
        <?php if ('div' !== $args['style']) : ?>
            </div>
        <?php endif; ?>
        <?php
    }
endif;
?>