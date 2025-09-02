<?php
/**
 * Template for Category: Aktuelles
 *
 * @package Schabracke
 */

get_header(); ?>

<main id="primary" class="flex-1 bg-gray-50">
  <div class="container mx-auto px-4 py-8">

    <!-- Page Header -->
    <div class="mb-8">
      <h1 class="text-3xl font-bold text-gray-800 mb-4">
        <?php single_cat_title(__('Category: ', 'schabracke')); ?>
      </h1>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

      <!-- Main Content -->
      <div class="lg:col-span-2 space-y-8">
        <?php if (have_posts()) : ?>
          <?php while (have_posts()) : the_post(); ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class("bg-white p-6 rounded-lg shadow-sm"); ?>>
              <header class="mb-4">
                <h2 class="text-xl font-semibold mb-2">
                  <a href="<?php the_permalink(); ?>" class="hover:underline"><?php the_title(); ?></a>
                </h2>
                <p class="text-sm text-gray-500">
                  <?php echo get_the_date(); ?> • <?php the_author(); ?>
                </p>
              </header>

              <div class="text-gray-700 text-sm mb-4">
                <?php the_excerpt(); ?>
              </div>

              <a href="<?php the_permalink(); ?>" class="inline-block px-3 py-1 border rounded text-sm hover:bg-gray-100">
                <?php esc_html_e('Read more', 'schabracke'); ?>
              </a>
            </article>
          <?php endwhile; ?>

          <!-- Pagination -->
          <div class="mt-8">
            <?php the_posts_pagination([
              'mid_size'  => 2,
              'prev_text' => __('« Previous', 'schabracke'),
              'next_text' => __('Next »', 'schabracke'),
            ]); ?>
          </div>

        <?php else : ?>
          <p><?php esc_html_e('No posts found in this category.', 'schabracke'); ?></p>
        <?php endif; ?>
      </div>

      <!-- Sidebar -->
      <div class="lg:col-span-1">
        <?php get_sidebar(); ?>
      </div>
    </div>

  </div>
</main>

<?php get_footer(); ?>
