<?php
/**
 * Archive Template
 *
 * Used for displaying archive pages (events, categories, tags, authors, etc.)
 *
 * @package Schabracke
 */

get_header(); ?>

<div class="container mx-auto px-4 py-8 flex flex-col md:flex-row gap-8">

  <!-- Main Content -->
  <main id="primary" class="flex-1">

    <?php if (have_posts()) : ?>

      <header class="page-header mb-6">
        <h1 class="text-2xl font-bold">
          <?php
          if (is_post_type_archive('event')) {
              esc_html_e('Upcoming Events', 'schabracke');
          } else {
              the_archive_title();
          }
          ?>
        </h1>
        <?php the_archive_description('<div class="archive-description text-gray-600 mt-2">', '</div>'); ?>
      </header>

      <div class="space-y-6">
        <?php
        while (have_posts()) :
          the_post();

          if (get_post_type() === 'event') {
              // Event custom display
              $event_date = get_post_meta(get_the_ID(), '_event_date', true);
              $event_time = get_post_meta(get_the_ID(), '_event_time', true);
              $event_location = get_post_meta(get_the_ID(), '_event_location', true);

              $date_obj = DateTime::createFromFormat('Y-m-d', $event_date);
              $date_display = $date_obj ? $date_obj->format('d M Y') : '';
              ?>
              
              <article id="post-<?php the_ID(); ?>" <?php post_class("p-4 border rounded-lg shadow-sm"); ?>>
                <header class="mb-2">
                  <h2 class="text-xl font-semibold">
                    <a href="<?php the_permalink(); ?>" class="hover:underline"><?php the_title(); ?></a>
                  </h2>
                  <p class="text-sm text-gray-600">
                    <?php if ($date_display) : ?>
                      📅 <?php echo esc_html($date_display); ?>
                    <?php endif; ?>
                    <?php if ($event_time) : ?>
                      ⏰ <?php echo esc_html($event_time); ?>
                    <?php endif; ?>
                    <?php if ($event_location) : ?>
                      📍 <?php echo esc_html($event_location); ?>
                    <?php endif; ?>
                  </p>
                </header>
                <div class="text-gray-700 text-sm">
                  <?php the_excerpt(); ?>
                </div>
              </article>
              
          <?php } else { 
              // Default for blog posts, categories, etc.
              get_template_part('template-parts/content', get_post_type());
          }
        endwhile; ?>
      </div>

      <!-- Pagination -->
      <div class="mt-8">
        <?php the_posts_pagination([
          'mid_size'  => 2,
          'prev_text' => __('« Previous', 'schabracke'),
          'next_text' => __('Next »', 'schabracke'),
        ]); ?>
      </div>

    <?php else : ?>

      <section class="no-results not-found">
        <h2 class="text-xl font-semibold mb-2"><?php esc_html_e('Nothing Found', 'schabracke'); ?></h2>
        <p><?php esc_html_e('It seems we can’t find what you’re looking for.', 'schabracke'); ?></p>
      </section>

    <?php endif; ?>
  </main>

  <!-- Sidebar -->
  <?php get_sidebar(); ?>

</div>

<?php get_footer(); ?>
