<?php
/**
 * The template for displaying 404 pages (Not Found)
 *
 * @package Schabracke
 */

get_header(); ?>

<main id="primary" class="flex-1 bg-gray-50">
  <div class="container mx-auto px-4 py-16 text-center">

    <h1 class="text-6xl font-bold text-red-600 mb-4">404</h1>
    <h2 class="text-2xl font-semibold mb-4">
      <?php esc_html_e('Seite nicht gefunden', 'schabracke'); ?>
    </h2>

    <p class="text-gray-600 mb-8">
      <?php esc_html_e('Die Seite, die du suchst, existiert nicht oder wurde verschoben.', 'schabracke'); ?>
    </p>

    <a href="<?php echo esc_url(home_url('/')); ?>" 
       class="inline-block px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
      <?php esc_html_e('Zur Startseite', 'schabracke'); ?>
    </a>

    <div class="mt-8 max-w-md mx-auto">
      <?php get_search_form(); ?>
    </div>

  </div>
</main>

<?php get_footer(); ?>
