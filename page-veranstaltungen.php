<?php
/**
 * Template Name: Veranstaltungen (Full Calendar)
 * Description: Veranstaltungskalender with controls, styled like React EventCalendar.
 *
 * @package Schabracke
 */

get_header(); ?>

<main id="primary" class="flex-1 bg-gray-50">
  <div class="container mx-auto px-4 py-8">

    <!-- Page Header -->
    <div class="bg-white p-6 rounded-lg shadow-sm mb-8">
      <h1 class="text-3xl font-bold text-gray-800 mb-4">
        <?php esc_html_e('Veranstaltungskalender', 'schabracke'); ?>
      </h1>
      <p class="text-gray-600 mb-6">
        <?php esc_html_e('Hier findest Du unsere Veranstaltungsangebote.', 'schabracke'); ?>
      </p>

      <!-- Calendar Controls -->
      <div class="flex flex-wrap items-center gap-4 mb-6">
        <!-- View buttons -->
        <div class="flex space-x-2">
          <button class="px-3 py-1 border rounded text-sm hover:bg-gray-100">Agenda</button>
          <button class="px-3 py-1 border rounded text-sm hover:bg-gray-100">Day</button>
          <button class="px-3 py-1 border rounded text-sm hover:bg-gray-100">Week</button>
          <button class="px-3 py-1 border rounded text-sm hover:bg-gray-100">Month</button>
        </div>

        <!-- Month navigation -->
        <div class="flex items-center space-x-2">
          <?php
          $month = isset($_GET['month']) ? intval($_GET['month']) : date('n');
          $year  = isset($_GET['year'])  ? intval($_GET['year'])  : date('Y');
          $first_day   = mktime(0, 0, 0, $month, 1, $year);
          ?>
          <a href="<?php echo add_query_arg(['month' => $month == 1 ? 12 : $month - 1, 'year' => $month == 1 ? $year - 1 : $year]); ?>"
             class="px-3 py-1 border rounded hover:bg-gray-100">«</a>
          <span class="px-4 py-2 border rounded">
            <?php echo date_i18n('F Y', $first_day); ?>
          </span>
          <a href="<?php echo add_query_arg(['month' => $month == 12 ? 1 : $month + 1, 'year' => $month == 12 ? $year + 1 : $year]); ?>"
             class="px-3 py-1 border rounded hover:bg-gray-100">»</a>
        </div>

        <!-- Expand / Collapse -->
        <div class="flex space-x-2">
          <button class="px-3 py-1 border rounded text-sm hover:bg-gray-100">Collapse All</button>
          <button class="px-3 py-1 border rounded text-sm hover:bg-gray-100">Expand All</button>
        </div>
      </div>
    </div>

    <?php
    // Fetch events
    $today = date('Y-m-d');
    $args = [
      'post_type'      => 'event',
      'posts_per_page' => -1,
      'meta_key'       => '_event_date',
      'orderby'        => 'meta_value',
      'order'          => 'ASC',
      'meta_query'     => [
        [
          'key'     => '_event_date',
          'value'   => $today,
          'compare' => '>=',
          'type'    => 'DATE'
        ]
      ]
    ];
    $events = new WP_Query($args);

    if ($events->have_posts()) : ?>
      <div class="space-y-4">
        <?php while ($events->have_posts()) : $events->the_post();
          $event_date     = get_post_meta(get_the_ID(), '_event_date', true);
          $event_time     = get_post_meta(get_the_ID(), '_event_time', true);
          $event_location = get_post_meta(get_the_ID(), '_event_location', true);

          $date_obj = DateTime::createFromFormat('Y-m-d', $event_date);
          $date_display = $date_obj ? $date_obj->format('M d') : '';
          $day_display  = $date_obj ? $date_obj->format('D') : '';
        ?>
          <!-- Event Card -->
          <div class="bg-white rounded-lg shadow-sm overflow-hidden">
            <div class="p-6 pb-4 flex items-start space-x-4">
              <!-- Date Badge -->
              <div class="flex flex-col items-center min-w-0">
                <span class="inline-block px-2 py-1 border border-blue-500 text-blue-600 rounded text-sm font-medium whitespace-nowrap">
                  <?php echo esc_html($date_display . ' ' . $day_display); ?>
                </span>
              </div>

              <!-- Event Info -->
              <div class="flex-1 min-w-0">
                <h2 class="text-xl font-semibold mb-2"><?php the_title(); ?></h2>
                <div class="flex items-center space-x-2 text-sm text-gray-600 mb-3">
                  <?php if ($event_time) : ?>
                    <span>⏰ <?php echo esc_html($event_time); ?></span>
                  <?php endif; ?>
                  <?php if ($event_location) : ?>
                    <span>📍 <?php echo esc_html($event_location); ?></span>
                  <?php endif; ?>
                </div>
              </div>
            </div>

            <!-- Event Description -->
            <div class="px-6 pb-6">
              <p class="text-gray-700 leading-relaxed mb-4">
                <?php echo esc_html(get_the_excerpt()); ?>
              </p>
              <a href="<?php the_permalink(); ?>"
                 class="inline-block px-3 py-1 border rounded text-sm hover:bg-gray-100">
                <?php esc_html_e('Read more', 'schabracke'); ?>
              </a>
            </div>
          </div>
        <?php endwhile; wp_reset_postdata(); ?>
      </div>
    <?php else : ?>
      <p class="text-gray-600">
        <?php esc_html_e('Zurzeit sind keine Veranstaltungen eingetragen.', 'schabracke'); ?>
      </p>
    <?php endif; ?>

    <!-- Calendar Subscription -->
    <div class="mt-8 bg-white p-6 rounded-lg shadow-sm">
      <h3 class="text-lg font-semibold mb-4"><?php esc_html_e('Subscribe', 'schabracke'); ?></h3>
      <div class="space-y-2 text-sm">
        <a href="#" class="text-blue-600 hover:underline block">Add to Timely Calendar</a>
        <a href="#" class="text-blue-600 hover:underline block">Add to Google</a>
        <a href="#" class="text-blue-600 hover:underline block">Add to Outlook</a>
        <a href="#" class="text-blue-600 hover:underline block">Add to Apple Calendar</a>
        <a href="#" class="text-blue-600 hover:underline block">Add to other calendar</a>
        <a href="#" class="text-blue-600 hover:underline block">Export to XML</a>
      </div>
    </div>

  </div>
</main>

<?php get_footer(); ?>
