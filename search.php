<?php
/**
 * The template for displaying search results pages
 */

get_header();
?>

<div class="container">
    <div class="content-grid">
        <!-- Main Content -->
        <div class="main-content">
            <?php if (have_posts()) : ?>

                <header class="page-header">
                    <div class="card">
                        <div class="card-header">
                            <h1 class="card-title">
                                <?php
                                printf(
                                    esc_html__('Search Results for: %s', 'schabracke'),
                                    '<span>' . get_search_query() . '</span>'
                                );
                                ?>
                            </h1>
                        </div>
                    </div>
                </header>

                <?php while (have_posts()) : the_post(); ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class('card news-card'); ?>>
                        <div class="card-header">
                            <div class="news-card-header">
                                <?php
                                $post_type = get_post_type();
                                $post_type_obj = get_post_type_object($post_type);
                                if ($post_type_obj) :
                                ?>
                                    <span class="news-category">
                                        <?php echo esc_html($post_type_obj->labels->singular_name); ?>
                                    </span>
                                <?php endif; ?>

                                <div class="news-date">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M19 3h-1V1h-2v2H8V1H6v2H5c-1.11 0-1.99.9-1.99 2L3 19c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H5V8h14v11zM7 10h5v5H7z"/>
                                    </svg>
                                    <?php echo get_the_date('j M, Y'); ?>
                                </div>
                            </div>

                            <h2 class="news-title">
                                <a href="<?php the_permalink(); ?>" rel="bookmark">
                                    <?php the_title(); ?>
                                </a>
                            </h2>
                        </div>

                        <div class="card-content">
                            <div class="news-excerpt">
                                <?php the_excerpt(); ?>
                            </div>

                            <div class="news-footer">
                                <div class="news-author">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                                    </svg>
                                    <?php the_author(); ?>
                                </div>

                                <a href="<?php the_permalink(); ?>" class="btn btn-primary btn-sm">
                                    <?php _e('READ MORE', 'schabracke'); ?>
                                </a>
                            </div>
                        </div>
                    </article>
                <?php endwhile; ?>

                <!-- Pagination -->
                <div class="pagination">
                    <?php
                    $prev_text = '<svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M15.41 7.41L14 6l-6 6 6 6 1.41-1.41L10.83 12z"/></svg>' . __('Previous', 'schabracke');
                    $next_text = __('Next', 'schabracke') . '<svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M10 6L8.59 7.41 13.17 12l-4.58 4.59L10 18l6-6z"/></svg>';

                    echo paginate_links(array(
                        'prev_text' => $prev_text,
                        'next_text' => $next_text,
                        'type' => 'list',
                        'before_page_number' => '<span class="sr-only">' . __('Page', 'schabracke') . ' </span>',
                    ));
                    ?>
                </div>

            <?php else : ?>

                <section class="no-results not-found">
                    <div class="card">
                        <div class="card-header">
                            <h1 class="card-title"><?php _e('Nothing found', 'schabracke'); ?></h1>
                        </div>
                        <div class="card-content">
                            <p><?php _e('Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'schabracke'); ?></p>
                            <?php get_search_form(); ?>
                        </div>
                    </div>
                </section>

            <?php endif; ?>
        </div>

        <!-- Sidebar -->
        <aside class="sidebar">
            <!-- Search Again -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"><?php _e('Search Again', 'schabracke'); ?></h3>
                </div>
                <div class="card-content">
                    <?php get_search_form(); ?>
                </div>
            </div>

            <!-- Recent Posts -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"><?php _e('Recent Posts', 'schabracke'); ?></h3>
                </div>
                <div class="card-content">
                    <?php
                    $recent_posts = wp_get_recent_posts(array(
                        'numberposts' => 5,
                        'post_status' => 'publish'
                    ));

                    if (!empty($recent_posts)) :
                        echo '<ul class="recent-posts-list" style="list-style: none; padding: 0;">';
                        foreach ($recent_posts as $post) :
                            echo '<li style="margin-bottom: 0.5rem;"><a href="' . get_permalink($post['ID']) . '" style="color: #3b82f6; text-decoration: none; font-size: 0.875rem;">' . esc_html($post['post_title']) . '</a></li>';
                        endforeach;
                        echo '</ul>';
                    endif;
                    wp_reset_query();
                    ?>
                </div>
            </div>

            <!-- Categories -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"><?php _e('Categories', 'schabracke'); ?></h3>
                </div>
                <div class="card-content">
                    <?php
                    $categories = get_categories(array(
                        'orderby' => 'name',
                        'order'   => 'ASC',
                        'hide_empty' => true,
                    ));

                    if (!empty($categories)) :
                        echo '<ul class="categories-list" style="list-style: none; padding: 0;">';
                        foreach ($categories as $category) :
                            echo '<li style="margin-bottom: 0.5rem;"><a href="' . get_category_link($category->term_id) . '" style="color: #3b82f6; text-decoration: none; font-size: 0.875rem;">' . esc_html($category->name) . ' (' . $category->count . ')</a></li>';
                        endforeach;
                        echo '</ul>';
                    endif;
                    ?>
                </div>
            </div>
        </aside>
    </div>
</div>

<?php
get_footer();
?>
