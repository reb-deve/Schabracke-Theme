<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 */

get_header();
?>

<div class="container">
    <div class="content-grid">
        <!-- Main Content -->
        <div class="main-content">
            <?php if (have_posts()) : ?>

                <?php while (have_posts()) : the_post(); ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class('card news-card'); ?>>
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
                            <h1 class="card-title"><?php _e('Nothing here', 'schabracke'); ?></h1>
                        </div>
                        <div class="card-content">
                            <p><?php _e('It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'schabracke'); ?></p>
                            <?php get_search_form(); ?>
                        </div>
                    </div>
                </section>

            <?php endif; ?>
        </div>

        <!-- Sidebar -->
        <aside class="sidebar">
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
                        $upcoming_events = schabracke_get_upcoming_events(5);
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

            <!-- Location Section -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/>
                        </svg>
                        <?php _e('HIER FINDEST DU UNS', 'schabracke'); ?>
                    </h3>
                </div>
                <div class="card-content">
                    <div class="location-info">
                        <p><strong>Pestalozzistraße 8a</strong></p>
                        <p>13187 Berlin (Pankow)</p>
                        <a href="<?php echo home_url('/anfahrt/'); ?>">
                            <?php _e('direkt hinter dem Rathaus Center', 'schabracke'); ?>
                        </a>

                        <div style="padding-top: 0.5rem; border-top: 1px solid #e5e7eb; margin-top: 1rem;">
                            <h4><?php _e('ANFAHRT MIT ÖPNV', 'schabracke'); ?></h4>
                            <p><?php _e('Tram M1, Bus 107, 155, 250, 255', 'schabracke'); ?><br>
                               <?php _e('Haltestelle Rathaus Pankow', 'schabracke'); ?></p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Opening Hours -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M11.99 2C6.47 2 2 6.48 2 12s4.47 10 9.99 10C17.52 22 22 17.52 22 12S17.52 2 11.99 2zM12 20c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8z"/><path d="M12.5 7H11v6l5.25 3.15.75-1.23-4.5-2.67z"/>
                        </svg>
                        <?php _e('ÖFFNUNGSZEITEN', 'schabracke'); ?>
                    </h3>
                </div>
                <div class="card-content">
                    <div class="opening-hours">
                        <div class="hours-row">
                            <span class="hours-day"><?php _e('Montag', 'schabracke'); ?></span>
                            <span class="hours-time">13:00 – 20:00 Uhr</span>
                        </div>
                        <div class="hours-row">
                            <span class="hours-day"><?php _e('Dienstag', 'schabracke'); ?></span>
                            <span class="hours-time">13:00 – 20:00 Uhr</span>
                        </div>
                        <div class="hours-row">
                            <span class="hours-day"><?php _e('Mittwoch', 'schabracke'); ?></span>
                            <span class="hours-time">15:00 – 20:00 Uhr</span>
                        </div>
                        <div class="hours-row">
                            <span class="hours-day"><?php _e('Donnerstag', 'schabracke'); ?></span>
                            <span class="hours-time">13:00 – 20:00 Uhr</span>
                        </div>
                        <div class="hours-row">
                            <span class="hours-day"><?php _e('Freitag', 'schabracke'); ?></span>
                            <span class="hours-time">13:00 – 20:00 Uhr</span>
                        </div>
                        <div class="hours-row">
                            <span class="hours-day"><?php _e('ersten Sonntag im Monat', 'schabracke'); ?></span>
                            <span class="hours-time">12:00 – 19:00 Uhr</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sponsors Section -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"><?php _e('TRÄGER', 'schabracke'); ?></h3>
                </div>
                <div class="card-content">
                    <div class="sponsors">
                        <div class="sponsor-logo pankow">
                            <?php _e('Bezirksamt Pankow', 'schabracke'); ?>
                        </div>
                        <div class="sponsor-logo berlin">
                            be Berlin
                        </div>
                        <div class="sponsor-logo jugendamt">
                            <?php _e('Jugendamt Pankow', 'schabracke'); ?>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Webhosting -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"><?php _e('WEBHOSTING', 'schabracke'); ?></h3>
                </div>
                <div class="card-content">
                    <div class="sponsor-logo">
                        <?php _e('Jugendnetz Berlin', 'schabracke'); ?>
                    </div>
                </div>
            </div>
        </aside>
    </div>
</div>

<?php
get_footer();
?>
