<?php
$events = schabracke_get_upcoming_events(5);

if (!empty($events)) : ?>
  <div class="card">
    <div class="card-header">
      <h3 class="card-title flex items-center space-x-2">📅 TERMINE</h3>
    </div>
    <div class="card-content space-y-4">
      <?php foreach ($events as $event) :
        $event_date = get_post_meta($event->ID, '_event_date', true);
        $event_time = get_post_meta($event->ID, '_event_time', true);

        // Format date
        $date_obj = DateTime::createFromFormat('Y-m-d', $event_date);
        $date_display = $date_obj ? $date_obj->format('M d') : '';
        $day_display  = $date_obj ? $date_obj->format('D') : '';
      ?>
        <div class="border-l-4 border-blue-500 pl-4 mb-4">
          <div class="flex items-center space-x-2 mb-2">
            <span class="badge outline text-blue-600">
              <?php echo esc_html($date_display . ' ' . $day_display); ?>
            </span>
          </div>
          <div class="flex items-start space-x-2">
            <span class="badge bg-blue-100 text-blue-800">
              <?php echo esc_html($event_time); ?>
            </span>
            <div class="flex-1">
              <h4 class="font-medium text-sm">
                <a href="<?php echo get_permalink($event->ID); ?>" class="hover:underline">
                  <?php echo esc_html(get_the_title($event->ID)); ?>
                </a>
              </h4>
              <p class="text-xs text-gray-600 mt-1">
                <?php echo esc_html(wp_trim_words($event->post_excerpt, 20)); ?>
              </p>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
<?php endif; ?>
