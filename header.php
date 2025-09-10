<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div id="page" class="site">
    <a class="sr-only" href="#main"><?php _e('Skip to content', 'schabracke'); ?></a>

    <header id="masthead" class="site-header ">
        <!-- Top Header with Contact Info -->
        <div class="header-top">
            <div class="container">
                <div class="contact-info">
                    <a href="mailto:<?php echo esc_attr(get_theme_mod('schabracke_email', 'post@schabracke.net')); ?>">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.89 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/>
                        </svg>
                        <?php echo esc_html(get_theme_mod('schabracke_email', 'post@schabracke.net')); ?>
                    </a>
                    <a href="tel:<?php echo esc_attr(str_replace(array(' ', '-'), '', get_theme_mod('schabracke_phone', '030-485-5080'))); ?>">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z"/>
                        </svg>
                        <?php echo esc_html(get_theme_mod('schabracke_phone', '030-485-5080')); ?>
                    </a>
                </div>

                <!-- <div class="service-menu">
                    <button class="service-dropdown" onclick="toggleServiceMenu()">
                        <?php _e('Servicebereich', 'schabracke'); ?>
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M7 10l5 5 5-5z"/>
                        </svg>
                    </button>
                    <div id="service-dropdown" class="service-dropdown-content" style="display: none;">
                        <?php
                        wp_nav_menu(array(
                            'theme_location' => 'service',
                            'menu_class' => 'service-nav-menu',
                            'container' => false,
                            'fallback_cb' => false,
                        ));
                        ?>
                    </div> -->
                </div>
            </div>
        </div>

        <!-- Main Header with Logo and Search -->
        <div class="container ">
            <div class=" main-header">
                <div class="header-content">
                    <div class="site-branding">
                       <?php if (has_custom_logo()) : ?>
    <div class="site-logo">
        <?php the_custom_logo(); ?>
    </div>
<?php else : ?>
    <div class="site-logo">
        <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/logo.png"
             alt="<?php bloginfo('name'); ?>">
    </div>
<?php endif; ?>


                        <div class="site-title-group">
                            <?php if (is_front_page() && is_home()) : ?>
                                <h1 class="site-title">
                                    <a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
                                        <?php bloginfo('name'); ?>
                                    </a>
                                </h1>
                            <?php else : ?>
                                <p class="site-title">
                                    <a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
                                        <?php bloginfo('name'); ?>
                                    </a>
                                </p>
                            <?php endif; ?>

                            <?php
                            $description = get_bloginfo('description', 'display');
                            if ($description || is_customize_preview()) :
                            ?>
                                <p class="site-description"><?php echo $description; ?></p>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="search-form">
                        <?php get_search_form(); ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Navigation Menu -->
        <div class="container">
            <nav id="site-navigation" class="main-navigation">
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'primary',
                    'menu_id' => 'primary-menu',
                    'menu_class' => 'nav-menu',
                    'container' => false,
                    'fallback_cb' => 'schabracke_default_menu',
                ));
                ?>
            </nav>
        </div>
    </header>

    <main id="main" class="site-content">

<?php
// Default menu fallback
function schabracke_default_menu() {
    echo '<ul class="nav-menu">';
    echo '<li><a href="' . home_url('/category/aktuelles/') . '">' . __('AKTUELLES', 'schabracke') . '</a></li>';
    echo '<li><a href="' . home_url('/events/') . '">' . __('VERANSTALTUNGSKALENDER', 'schabracke') . '</a></li>';
    echo '<li><a href="' . home_url('/angebote/') . '">' . __('ANGEBOTE/HAUS', 'schabracke') . '</a></li>';
    echo '<li><a href="' . home_url('/jugend-links/') . '">' . __('JUGEND-LINKS', 'schabracke') . '</a></li>';
    echo '<li><a href="' . home_url('/kontakt/') . '">' . __('IMPRESSUM/KONTAKT', 'schabracke') . '</a></li>';
    echo '</ul>';
}
?>

<script>
function toggleServiceMenu() {
    var dropdown = document.getElementById('service-dropdown');
    dropdown.style.display = dropdown.style.display === 'none' ? 'block' : 'none';
}

// Close dropdown when clicking outside
document.addEventListener('click', function(event) {
    var dropdown = document.getElementById('service-dropdown');
    var button = document.querySelector('.service-dropdown');

    if (!button.contains(event.target) && !dropdown.contains(event.target)) {
        dropdown.style.display = 'none';
    }
});
</script>
