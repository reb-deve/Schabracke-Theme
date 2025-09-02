<?php
/**
 * Template Name: Events Calendar
 *
 * The template for displaying the events calendar page
 */

get_header();
?>

<div class="container">
    <div class="main-content">
        <!-- Page Title -->
        <div class="card mb-4">
            <div class="card-header">
                <h1 class="card-title"><?php _e('Veranstaltungskalender', 'schabracke'); ?></h1>
                <p><?php _e('Hier findest Du unsere Veranstaltungsangebote.', 'schabracke'); ?></p>
            </div>
            <div class="card-content">
                <!-- Calendar Controls -->
                <div class="calendar-controls" style="display: flex; flex-wrap: wrap; gap: 1rem; margin-bottom: 1.5rem;">
                    <div style="display: flex; gap: 0.5rem;">
                        <button class="btn btn-outline btn-sm"><?php _e('Agenda', 'schabracke'); ?></button>
                        <button class="btn btn-outline btn-sm"><?php _e('Day', 'schabracke'); ?></button>
                        <button class="btn btn-outline btn-sm"><?php _e('Month', 'schabracke'); ?></button>
                        <button class="btn btn-outline btn-sm"><?php _e('Week', 'schabracke'); ?></button>
                    </div>

                    <div style="display: flex; align-items: center; gap: 0.5rem;">
                        <button class="btn btn-outline btn-sm">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M15.41 7.41L14 6l-6 6 6 6 1.41-1.41L10.83 12z"/>
                            </svg>
                        </button>
                        <span style="padding: 0.5rem 1rem; border: 1px solid #d1d5db; border-radius: 0.375rem;">
                            <?php echo date('F Y'); ?>
                        </span>
                        <button class="btn btn-outline btn-sm">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M10 6L8.59 7.41 13.17 12l-4.58 4.59L10 18l6-6z"/>
                            </svg>
                        </button>
                    </div>

                    <div style="display: flex; gap: 0.5rem;">
                        <button class="btn btn-outline btn-sm"><?php _e('Collapse All', 'schabracke'); ?></button>
                        <button class="btn btn-outline btn-sm"><?php _e('Expand All', 'schabracke'); ?></button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Events List -->
        <div class="events-calendar">
            <?php
            $events = new WP_Query(array(
                'post_type' => 'event',
                'posts_per_page' => -1,
                'meta_key' => '_event_date',
                'orderby' => 'meta_value',
                'order' => 'ASC',
                'meta_query' => array(
                    array(
                        'key' => '_event_date',
                        'value' => date('Y-m-d'),
                        'compare' => '>='
                    )
                )
            ));

            if ($events->have_posts()) :
                while ($events->have_posts()) : $events->the_post();
                    $event_date = get_post_meta(get_the_ID(), '_event_date', true);
                    $event_time = get_post_meta(get_the_ID(), '_event_time', true);
                    $event_location = get_post_meta(get_the_ID(), '_event_location', true);

                    if ($event_date) :
                        $date_obj = DateTime::createFromFormat('Y-m-d', $event_date);
                        $day_month = $date_obj ? $date_obj->format('M j') : '';
                        $day_name = $date_obj ? $date_obj->format('D') : '';
            ?>
                <div class="card event-card" style="margin-bottom: 1rem;">
                    <div class="card-header">
                        <div style="display: flex; align-items: flex-start; gap: 1rem;">
                            <div style="display: flex; flex-direction: column; align-items: center; min-width: 0;">
                                <div class="event-date-badge">
                                    <?php echo esc_html($day_month . ' ' . $day_name); ?>
                                </div>
                            </div>
                            <div style="flex: 1; min-width: 0;">
                                <h3 style="margin: 0 0 0.5rem 0; font-size: 1.25rem; font-weight: 700;">
                                    <?php the_title(); ?>
                                </h3>
                                <button class="btn btn-outline btn-sm" style="margin-bottom: 0.75rem;">
                                    <?php _e('Tickets', 'schabracke'); ?>
                                </button>
                                <?php if ($event_time) : ?>
                                    <div style="display: flex; align-items: center; gap: 0.5rem; font-size: 0.875rem; color: #6b7280; margin-bottom: 0.75rem;">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                            <path d="M11.99 2C6.47 2 2 6.48 2 12s4.47 10 9.99 10C17.52 22 22 17.52 22 12S17.52 2 11.99 2zM12 20c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8z"/><path d="M12.5 7H11v6l5.25 3.15.75-1.23-4.5-2.67z"/>
                                        </svg>
                                        <span><?php echo esc_html($event_time); ?></span>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <div class="card-content">
                        <?php if (has_post_thumbnail()) : ?>
                            <div style="margin-bottom: 1rem;">
                                <?php the_post_thumbnail('medium', array('style' => 'width: 8rem; height: 8rem; object-fit: cover; border-radius: 0.5rem;')); ?>
                            </div>
                        <?php endif; ?>

                        <div style="color: #4b5563; line-height: 1.6; margin-bottom: 1rem;">
                            <?php the_content(); ?>
                        </div>

                        <button class="btn btn-outline btn-sm">
                            <?php _e('Read more', 'schabracke'); ?>
                        </button>
                    </div>
                </div>
            <?php
                    endif;
                endwhile;
                wp_reset_postdata();
            else :
            ?>
                <div class="card">
                    <div class="card-content">
                        <p><?php _e('No upcoming events scheduled.', 'schabracke'); ?></p>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <!-- Calendar Navigation -->
        <div style="display: flex; align-items: center; justify-content: center; gap: 0.5rem; padding: 1rem 0;">
            <button class="btn btn-outline btn-sm">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M15.41 7.41L14 6l-6 6 6 6 1.41-1.41L10.83 12z"/>
                </svg>
                <?php _e('Previous', 'schabracke'); ?>
            </button>
            <span style="padding: 0.5rem 1rem; border: 1px solid #d1d5db; border-radius: 0.375rem;">
                <?php echo date('F Y'); ?>
            </span>
            <button class="btn btn-outline btn-sm">
                <?php _e('Next', 'schabracke'); ?>
                <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M10 6L8.59 7.41 13.17 12l-4.58 4.59L10 18l6-6z"/>
                </svg>
            </button>
        </div>

        <!-- Calendar Subscription -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><?php _e('Subscribe', 'schabracke'); ?></h3>
            </div>
            <div class="card-content">
                <div style="display: flex; flex-direction: column; gap: 0.5rem; font-size: 0.875rem;">
                    <a href="#" style="color: #3b82f6; text-decoration: none;"><?php _e('Add to Timely Calendar', 'schabracke'); ?></a>
                    <a href="#" style="color: #3b82f6; text-decoration: none;"><?php _e('Add to Google', 'schabracke'); ?></a>
                    <a href="#" style="color: #3b82f6; text-decoration: none;"><?php _e('Add to Outlook', 'schabracke'); ?></a>
                    <a href="#" style="color: #3b82f6; text-decoration: none;"><?php _e('Add to Apple Calendar', 'schabracke'); ?></a>
                    <a href="#" style="color: #3b82f6; text-decoration: none;"><?php _e('Add to other calendar', 'schabracke'); ?></a>
                    <a href="#" style="color: #3b82f6; text-decoration: none;"><?php _e('Export to XML', 'schabracke'); ?></a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
get_footer();
?>
