<?php
/**
 * The template for displaying all pages
 */

get_header();
?>

<div class="container">
    <div class="content-grid">
        <!-- Main Content -->
        <div class="main-content">
            <?php while (have_posts()) : the_post(); ?>
                <article id="page-<?php the_ID(); ?>" <?php post_class('card'); ?>>
                    <div class="card-header">
                        <h1 class="card-title"><?php the_title(); ?></h1>
                    </div>

                    <div class="card-content">
                        <?php if (has_post_thumbnail()) : ?>
                            <div class="post-thumbnail">
                                <?php the_post_thumbnail('large', array('class' => 'img-responsive')); ?>
                            </div>
                        <?php endif; ?>

                        <div class="page-content">
                            <?php
                            the_content();

                            wp_link_pages(array(
                                'before' => '<div class="page-links">' . __('Pages:', 'schabracke'),
                                'after'  => '</div>',
                            ));
                            ?>
                        </div>
                    </div>
                </article>

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
            <!-- Child Pages (if any) -->
            <?php
            $child_pages = get_pages(array(
                'child_of' => get_the_ID(),
                'sort_order' => 'ASC',
                'sort_column' => 'menu_order'
            ));

            if (!empty($child_pages)) :
            ?>
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"><?php _e('Related Pages', 'schabracke'); ?></h3>
                    </div>
                    <div class="card-content">
                        <ul class="child-pages-list">
                            <?php foreach ($child_pages as $page) : ?>
                                <li>
                                    <a href="<?php echo get_permalink($page->ID); ?>">
                                        <?php echo esc_html($page->post_title); ?>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Contact Info Card -->
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

            <!-- Contact Information -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"><?php _e('KONTAKT', 'schabracke'); ?></h3>
                </div>
                <div class="card-content">
                    <div class="contact-info">
                        <p>
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z"/>
                            </svg>
                            <a href="tel:<?php echo esc_attr(str_replace(array(' ', '-'), '', get_theme_mod('schabracke_phone', '030-485-5080'))); ?>">
                                <?php echo esc_html(get_theme_mod('schabracke_phone', '030-485-5080')); ?>
                            </a>
                        </p>
                        <p>
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.89 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/>
                            </svg>
                            <a href="mailto:<?php echo esc_attr(get_theme_mod('schabracke_email', 'post@schabracke.net')); ?>">
                                <?php echo esc_html(get_theme_mod('schabracke_email', 'post@schabracke.net')); ?>
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        </aside>
    </div>
</div>

<?php
get_footer();
?>
