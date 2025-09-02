</main><!-- #main -->

    <footer id="colophon" class="site-footer">
        <div class="container">
            <!-- Footer Menu Links -->
            <div class="footer-content">
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'footer',
                    'menu_class' => 'footer-nav-menu',
                    'container' => false,
                    'fallback_cb' => 'schabracke_default_footer_menu',
                    'link_before' => '',
                    'link_after' => '',
                    'walker' => new Schabracke_Footer_Walker(),
                ));
                ?>
            </div>

            <!-- Social Media -->
            <div class="social-links">
                <a href="https://youtu.be/0GMOtY_CvPY" target="_blank" rel="noopener noreferrer" class="social-link" title="YouTube">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
                    </svg>
                </a>
            </div>

            <!-- Copyright -->
            <div class="footer-copyright">
                <p>
                    <span><?php printf(__('Copyright ©%s ', 'schabracke'), date('Y')); ?>
                        <a href="<?php echo esc_url(home_url('/')); ?>"><?php bloginfo('name'); ?></a>.
                    </span>
                    <span class="by">
                        <?php _e('Education Zone | Developed By', 'schabracke'); ?>
                        <a href="https://rarathemes.com/" target="_blank" rel="noopener noreferrer">Rara Themes</a>.
                        <?php _e('Powered by', 'schabracke'); ?>
                        <a href="https://wordpress.org/" target="_blank" rel="noopener noreferrer">WordPress</a>.
                    </span>
                    <a href="<?php echo get_privacy_policy_url(); ?>" class="privacy-policy-link">
                        <?php _e('Datenschutzerklärung', 'schabracke'); ?>
                    </a>
                </p>
            </div>
        </div>
    </footer><!-- #colophon -->

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>

<?php
// Default footer menu fallback
function schabracke_default_footer_menu() {
    $footer_links = array(
        array('title' => __('Impressum', 'schabracke'), 'url' => home_url('/impressum/')),
        array('title' => __('Datenschutzerklärung', 'schabracke'), 'url' => get_privacy_policy_url()),
        array('title' => __('Das Team', 'schabracke'), 'url' => home_url('/team/')),
        array('title' => __('Partner', 'schabracke'), 'url' => home_url('/partner/')),
        array('title' => __('Vermietung', 'schabracke'), 'url' => home_url('/vermietung/')),
    );

    foreach ($footer_links as $index => $link) {
        echo '<a href="' . esc_url($link['url']) . '" class="footer-link">' . esc_html($link['title']) . '</a>';
        if ($index < count($footer_links) - 1) {
            echo '<span class="footer-separator">|</span>';
        }
    }
}

// Custom walker for footer menu
class Schabracke_Footer_Walker extends Walker_Nav_Menu {
    function start_lvl(&$output, $depth = 0, $args = null) {
        // No sub-menus in footer
    }

    function end_lvl(&$output, $depth = 0, $args = null) {
        // No sub-menus in footer
    }

    function start_el(&$output, $item, $depth = 0, $args = null, $id = 0) {
        $output .= '<a href="' . esc_url($item->url) . '" class="footer-link">' . esc_html($item->title) . '</a>';

        // Add separator if not the last item
        $menu_items = wp_get_nav_menu_items($args->menu);
        $last_item = end($menu_items);
        if ($item->ID !== $last_item->ID) {
            $output .= '<span class="footer-separator">|</span>';
        }
    }

    function end_el(&$output, $item, $depth = 0, $args = null) {
        // Nothing needed here
    }
}
?>
