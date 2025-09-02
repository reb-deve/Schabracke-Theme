<?php
/**
 * The template for displaying all single posts
 */

get_header();
?>

<div class="container">
    <div class="content-grid">
        <!-- Main Content -->
        <div class="main-content">
            <?php while (have_posts()) : the_post(); ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class('card'); ?>>
                    <div class="card-header">
                        <div class="news-card-header">
                            <?php
                            $categories = get_the_category();
                            if (!empty($categories)) :
                            ?>
                                <span class="news-category">
                                    <?php echo esc_html($categories[0]->name); ?>
                                </span>
                            <?php endif; ?>

                            <div class="news-date">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M19 3h-1V1h-2v2H8V1H6v2H5c-1.11 0-1.99.9-1.99 2L3 19c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H5V8h14v11zM7 10h5v5H7z"/>
                                </svg>
                                <?php echo get_the_date('j M, Y'); ?>
                            </div>
                        </div>

                        <h1 class="news-title"><?php the_title(); ?></h1>

                        <div class="news-author">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                            </svg>
                            <?php _e('By', 'schabracke'); ?> <?php the_author(); ?>
                        </div>
                    </div>

                    <div class="card-content">
                        <?php if (has_post_thumbnail()) : ?>
                            <div class="post-thumbnail">
                                <?php the_post_thumbnail('large', array('class' => 'img-responsive')); ?>
                            </div>
                        <?php endif; ?>

                        <div class="post-content">
                            <?php
                            the_content();

                            wp_link_pages(array(
                                'before' => '<div class="page-links">' . __('Pages:', 'schabracke'),
                                'after'  => '</div>',
                            ));
                            ?>
                        </div>

                        <?php if (has_tag()) : ?>
                            <div class="post-tags">
                                <strong><?php _e('Tags:', 'schabracke'); ?> </strong>
                                <?php the_tags('', ', ', ''); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </article>

                <!-- Navigation between posts -->
                <nav class="post-navigation">
                    <div class="nav-links">
                        <div class="nav-previous">
                            <?php previous_post_link('%link', '← %title'); ?>
                        </div>
                        <div class="nav-next">
                            <?php next_post_link('%link', '%title →'); ?>
                        </div>
                    </div>
                </nav>

                <?php
                // If comments are open or we have at least one comment, load up the comment template.
                if (comments_open() || get_comments_number()) :
                    comments_template();
                endif;
                ?>

            <?php endwhile; ?>
        </div>

        <!-- Sidebar -->
        <aside class="sidebar">
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
                        echo '<ul class="recent-posts-list">';
                        foreach ($recent_posts as $post) :
                            echo '<li><a href="' . get_permalink($post['ID']) . '">' . esc_html($post['post_title']) . '</a></li>';
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
                        echo '<ul class="categories-list">';
                        foreach ($categories as $category) :
                            echo '<li><a href="' . get_category_link($category->term_id) . '">' . esc_html($category->name) . ' (' . $category->count . ')</a></li>';
                        endforeach;
                        echo '</ul>';
                    endif;
                    ?>
                </div>
            </div>

            <!-- Events Section -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M19 3h-1V1h-2v2H8V1H6v2H5c-1.11 0-1.99.9-1.99 2L3 19c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H5V8h14v11zM7 10h5v5H7z"/>
                        </svg>
                        <?php _e('TERMINE', 'schabracke'); ?>
                    </h3>
                </div>
                <div class="card-content">
                    <div class="events-list">
                        <?php
                        $upcoming_events = schabracke_get_upcoming_events(3);
                        if (!empty($upcoming_events)) :
                            foreach ($upcoming_events as $event) :
                                $event_date = get_post_meta($event->ID, '_event_date', true);
                                $event_time = get_post_meta($event->ID, '_event_time', true);

                                if ($event_date) :
                                    $date_obj = DateTime::createFromFormat('Y-m-d', $event_date);
                                    $day_month = $date_obj ? $date_obj->format('M j') : '';
                                    $day_name = $date_obj ? $date_obj->format('D') : '';
                        ?>
                            <div class="event-item">
                                <div class="event-date-badge">
                                    <?php echo esc_html($day_month . ' ' . $day_name); ?>
                                </div>
                                <?php if ($event_time) : ?>
                                    <span class="event-time"><?php echo esc_html($event_time); ?></span>
                                <?php endif; ?>
                                <h4 class="event-title"><?php echo esc_html($event->post_title); ?></h4>
                                <?php if ($event->post_excerpt) : ?>
                                    <p class="event-description"><?php echo esc_html($event->post_excerpt); ?></p>
                                <?php endif; ?>
                            </div>
                        <?php
                                endif;
                            endforeach;
                        else :
                        ?>
                            <p><?php _e('No upcoming events scheduled.', 'schabracke'); ?></p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </aside>
    </div>
</div>

<?php
get_footer();
?>
