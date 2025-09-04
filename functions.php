<?php
/*
Theme Name: Schabracke Modern
Description: Modern WordPress theme for KJFE Schabracke youth center. Features responsive design, event calendar, and comprehensive content management.
Version: 1.0
Author: Schabracke Team
Text Domain: schabracke
*/

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// Theme setup
function schabracke_setup() {
    // Add theme support
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption'));
    add_theme_support('custom-logo');
    add_theme_support('menus');

    // Register navigation menus
    register_nav_menus(array(
        'primary' => __('Primary Menu', 'schabracke'),
        'service' => __('Service Menu', 'schabracke'),
        'footer' => __('Footer Menu', 'schabracke'),
    ));

    // Set content width
    $GLOBALS['content_width'] = 1200;
}
add_action('after_setup_theme', 'schabracke_setup');
// Redirect /events/ archive to /veranstaltungen/
/* add_action('template_redirect', function() {
    if (is_post_type_archive('event')) {
        wp_redirect(home_url('/veranstaltungen/'));
        exit;
    }
}); */


// Enqueue scripts and styles
function schabracke_scripts() {
    // Main stylesheet
    wp_enqueue_style('schabracke-style', get_stylesheet_uri(), array(), '1.0');

    // Main CSS (converted from Tailwind)
    wp_enqueue_style('schabracke-main', get_template_directory_uri() . '/assets/css/main.css', array(), '1.0');

    // JavaScript
    wp_enqueue_script('schabracke-main', get_template_directory_uri() . '/assets/js/main.js', array('jquery'), '1.0', true);

    // Localize script for AJAX
    wp_localize_script('schabracke-main', 'schabracke_ajax', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('schabracke_nonce')
    ));
}
add_action('wp_enqueue_scripts', 'schabracke_scripts');

// Custom post types
function schabracke_custom_post_types() {
    // Events post type
    register_post_type('event', array(
        'labels' => array(
            'name' => __('Events', 'schabracke'),
            'singular_name' => __('Event', 'schabracke'),
            'add_new' => __('Add New Event', 'schabracke'),
            'add_new_item' => __('Add New Event', 'schabracke'),
            'edit_item' => __('Edit Event', 'schabracke'),
            'new_item' => __('New Event', 'schabracke'),
            'view_item' => __('View Event', 'schabracke'),
            'search_items' => __('Search Events', 'schabracke'),
            'not_found' => __('No events found', 'schabracke'),
            'not_found_in_trash' => __('No events found in trash', 'schabracke')
        ),
        'public' => true,
        'has_archive' => true,
        'supports' => array('title', 'editor', 'excerpt', 'thumbnail'),
        'show_in_rest' => true,
        'menu_icon' => 'dashicons-calendar-alt',
        'rewrite' => array('slug' => 'events')
    ));
}
add_action('init', 'schabracke_custom_post_types');

// Custom fields for events
function schabracke_add_event_metaboxes() {
    add_meta_box(
        'event_details',
        __('Event Details', 'schabracke'),
        'schabracke_event_details_callback',
        'event',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'schabracke_add_event_metaboxes');

function schabracke_event_details_callback($post) {
    wp_nonce_field('schabracke_event_details', 'schabracke_event_details_nonce');

    $event_date = get_post_meta($post->ID, '_event_date', true);
    $event_time = get_post_meta($post->ID, '_event_time', true);
    $event_location = get_post_meta($post->ID, '_event_location', true);

    echo '<table class="form-table">';
    echo '<tr><th><label for="event_date">' . __('Event Date', 'schabracke') . '</label></th>';
    echo '<td><input type="date" id="event_date" name="event_date" value="' . esc_attr($event_date) . '" /></td></tr>';
    echo '<tr><th><label for="event_time">' . __('Event Time', 'schabracke') . '</label></th>';
    echo '<td><input type="time" id="event_time" name="event_time" value="' . esc_attr($event_time) . '" /></td></tr>';
    echo '<tr><th><label for="event_location">' . __('Location', 'schabracke') . '</label></th>';
    echo '<td><input type="text" id="event_location" name="event_location" value="' . esc_attr($event_location) . '" /></td></tr>';
    echo '</table>';
}

// Save event meta
function schabracke_save_event_details($post_id) {
    if (!isset($_POST['schabracke_event_details_nonce']) || !wp_verify_nonce($_POST['schabracke_event_details_nonce'], 'schabracke_event_details')) {
        return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    if (isset($_POST['event_date'])) {
        update_post_meta($post_id, '_event_date', sanitize_text_field($_POST['event_date']));
    }

    if (isset($_POST['event_time'])) {
        update_post_meta($post_id, '_event_time', sanitize_text_field($_POST['event_time']));
    }

    if (isset($_POST['event_location'])) {
        update_post_meta($post_id, '_event_location', sanitize_text_field($_POST['event_location']));
    }
}
add_action('save_post', 'schabracke_save_event_details');

// Widget areas
function schabracke_widgets_init() {
    register_sidebar(array(
        'name' => __('Sidebar', 'schabracke'),
        'id' => 'sidebar-1',
        'description' => __('Add widgets here to appear in your sidebar.', 'schabracke'),
        'before_widget' => '<div class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));
}
add_action('widgets_init', 'schabracke_widgets_init');

// Custom excerpt length
function schabracke_excerpt_length($length) {
    return 30;
}
add_filter('excerpt_length', 'schabracke_excerpt_length');

// Custom excerpt more
function schabracke_excerpt_more($more) {
    return '...';
}
add_filter('excerpt_more', 'schabracke_excerpt_more');




// Helper function to get events
/* function schabracke_get_upcoming_events($limit = 5) {
    $events = get_posts(array(
        'post_type' => 'event',
        'posts_per_page' => $limit,
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

    return $events;
} */
/* function schabracke_get_upcoming_events($limit = 5) {
    $events = get_posts(array(
        'post_type'      => 'tribe_events', // correct CPT name from The Events Calendar
        'posts_per_page' => $limit,
        'meta_key'       => '_EventStartDate',
        'orderby'        => 'meta_value',
        'order'          => 'ASC',
        'meta_query'     => array(
            array(
                'key'     => '_EventStartDate',
                'value'   => current_time('mysql'), // compare with current datetime
                'compare' => '>=',
                'type'    => 'DATETIME',
            )
        )
    ));

    return $events;
} */
// Get upcoming events from The Events Calendar
function schabracke_get_upcoming_events($limit = 5) {
    $events = get_posts(array(
        'post_type'      => 'tribe_events',
        'posts_per_page' => $limit,
        'meta_key'       => '_EventStartDate',
        'orderby'        => 'meta_value',
        'order'          => 'ASC',
        'suppress_filters' => false, // ensure WPML or theme filters don’t block events
        'meta_query'     => array(
            array(
                'key'     => '_EventStartDate',
                'value'   => current_time('mysql'),
                'compare' => '>=',
                'type'    => 'DATETIME',
            )
        )
    ));

    // Debug: see if events are being fetched
    if (empty($events)) {
        error_log('schabracke_get_upcoming_events: No events found');
    }

    return $events;
}


// Add custom contact info to customizer
function schabracke_customize_register($wp_customize) {
   $wp_customize->add_section('schabracke_opening_hours', array(
        'title'       => __('Öffnungszeiten', 'schabracke'),
        'priority'    => 30,
        'description' => __('Bearbeite hier die Öffnungszeiten für die Sidebar.', 'schabracke'),
    ));

    // Days array
    $days = array(
        'monday'    => __('Montag', 'schabracke'),
        'tuesday'   => __('Dienstag', 'schabracke'),
        'wednesday' => __('Mittwoch', 'schabracke'),
        'thursday'  => __('Donnerstag', 'schabracke'),
        'friday'    => __('Freitag', 'schabracke'),
        'sunday'    => __('Erster Sonntag im Monat', 'schabracke'),
    );

    foreach ($days as $key => $label) {
        $setting_id = 'schabracke_hours_' . $key;

        $wp_customize->add_setting($setting_id, array(
            'default'   => '',
            'transport' => 'refresh',
            'sanitize_callback' => 'sanitize_text_field',
        ));

        $wp_customize->add_control($setting_id, array(
            'label'   => $label,
            'section' => 'schabracke_opening_hours',
            'type'    => 'text',
        ));
    }

    // Contact section
    $wp_customize->add_section('schabracke_contact', array(
        'title' => __('Contact Information', 'schabracke'),
        'priority' => 30,
    ));

    // Phone
    $wp_customize->add_setting('schabracke_phone', array(
        'default' => '030-485-5080',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('schabracke_phone', array(
        'label' => __('Phone Number', 'schabracke'),
        'section' => 'schabracke_contact',
        'type' => 'text',
    ));

    // Email
    $wp_customize->add_setting('schabracke_email', array(
        'default' => 'post@schabracke.net',
        'sanitize_callback' => 'sanitize_email',
    ));

    $wp_customize->add_control('schabracke_email', array(
        'label' => __('Email Address', 'schabracke'),
        'section' => 'schabracke_contact',
        'type' => 'email',
    ));

    // Address
    $wp_customize->add_setting('schabracke_address', array(
        'default' => 'Pestalozzistraße 8a, 13187 Berlin (Pankow)',
        'sanitize_callback' => 'sanitize_textarea_field',
    ));

    $wp_customize->add_control('schabracke_address', array(
        'label' => __('Address', 'schabracke'),
        'section' => 'schabracke_contact',
        'type' => 'textarea',
    ));
}
add_action('customize_register', 'schabracke_customize_register');

// Get events for calendar
function schabracke_get_events_calendar() {
    $events = get_posts(array(
        'post_type' => 'event',
        'posts_per_page' => -1,
        'meta_key' => '_event_date',
        'orderby' => 'meta_value',
        'order' => 'ASC'
    ));

    $calendar_events = array();

    foreach ($events as $event) {
        $event_date = get_post_meta($event->ID, '_event_date', true);
        $event_time = get_post_meta($event->ID, '_event_time', true);
        $event_location = get_post_meta($event->ID, '_event_location', true);

        $calendar_events[] = array(
            'id' => $event->ID,
            'title' => $event->post_title,
            'content' => $event->post_content,
            'excerpt' => $event->post_excerpt,
            'date' => $event_date,
            'time' => $event_time,
            'location' => $event_location,
            'permalink' => get_permalink($event->ID)
        );
    }

    return $calendar_events;
}
function schabracke_enqueue_calendar() {
    wp_enqueue_style('fullcalendar-css', 'https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/main.min.css');
    wp_enqueue_script('fullcalendar-js', 'https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/main.min.js', ['jquery'], null, true);
    wp_enqueue_script('schabracke-calendar', get_template_directory_uri() . '/js/calendar.js', ['fullcalendar-js'], null, true);
}
add_action('wp_enqueue_scripts', 'schabracke_enqueue_calendar');

// TEMP: Load Tailwind via CDN to verify styling
function schabracke_tailwind_cdn_for_testing() {
    if (is_admin()) return; // front-end only
    wp_enqueue_script('tailwind-cdn', 'https://cdn.tailwindcss.com', [], null, false);
}
add_action('wp_enqueue_scripts', 'schabracke_tailwind_cdn_for_testing', 0);

// Register Facilities CPT
function create_facility_cpt() {
    register_post_type('facility', [
        'labels' => [
            'name' => 'Facilities',
            'singular_name' => 'Facility'
        ],
        'public' => true,
        'has_archive' => false,
        'supports' => ['title', 'editor', 'thumbnail'], // title = name, editor = description, thumbnail = image
    ]);
}
add_action('init', 'create_facility_cpt');

// Register Programs CPT (Café, Creative, Summer, Additional)
function create_program_cpt() {
    register_post_type('program', [
        'labels' => [
            'name' => 'Programs',
            'singular_name' => 'Program'
        ],
        'public' => true,
        'has_archive' => false,
        'supports' => ['title', 'editor', 'thumbnail'], // title = program name, editor = description/details, thumbnail = optional image
    ]);
}
add_action('init', 'create_program_cpt');
// Register Partner CPT
function create_partner_cpt() {
    register_post_type('partner', [
        'labels' => [
            'name' => 'Partner',
            'singular_name' => 'Partner'
        ],
        'public' => true,
        'has_archive' => false,
        'menu_icon' => 'dashicons-groups',
        'supports' => ['title', 'editor', 'thumbnail', 'custom-fields'], 
    ]);
}
add_action('init', 'create_partner_cpt');

function create_team_cpt() {
    register_post_type('team', [
        'labels' => [
            'name' => 'Team',
            'singular_name' => 'Teammitglied'
        ],
        'public' => true,
        'has_archive' => false,
        'menu_icon' => 'dashicons-id',
        'supports' => ['title', 'editor', 'thumbnail', 'custom-fields'],
    ]);
}
add_action('init', 'create_team_cpt');

add_filter ('wp_image_editors', 'wpse303391_change_graphic_editor');
function wpse303391_change_graphic_editor ($array) {
    return array( 'WP_Image_Editor_GD', 'WP_Image_Editor_Imagick' );
    }

?>
