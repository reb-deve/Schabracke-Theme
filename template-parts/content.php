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
