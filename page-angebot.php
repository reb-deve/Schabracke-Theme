<?php
/*
Template Name: Angebote Page
*/

get_header(); 
?>

<main class="flex-1 bg-gray-50">
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-8"><?php the_title(); ?></h1>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2 space-y-8">

                <!-- Introduction (use the page editor content) -->
                <div class="bg-white shadow rounded-lg p-6">
                    <div class="text-gray-700 leading-relaxed">
                        <?php
                        while (have_posts()): the_post();
                            the_content();
                        endwhile;
                        ?>
                    </div>
                </div>

                <!-- Facilities / Workshops -->
                <div class="space-y-6">
                    <h2 class="text-2xl font-bold text-gray-800">Werkstätten & Räume</h2>

                    <?php
                    $facilities = new WP_Query(['post_type' => 'facility', 'posts_per_page' => -1]);
                    if ($facilities->have_posts()):
                        while ($facilities->have_posts()): $facilities->the_post(); ?>
                            <div class="bg-white shadow rounded-lg p-6 flex items-start space-x-6">
                                <div class="w-48 h-32 bg-blue-100 rounded-lg flex-shrink-0 overflow-hidden">
                                    <?php if (has_post_thumbnail()): ?>
                                        <?php the_post_thumbnail('medium', ['class' => 'w-full h-full object-cover']); ?>
                                    <?php else: ?>
                                        <div class="w-full h-full flex items-center justify-center text-gray-600">
                                            <?php the_title(); ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div class="flex-1">
                                    <h3 class="text-lg font-semibold text-gray-800 mb-3"><?php the_title(); ?></h3>
                                    <p class="text-gray-700 leading-relaxed"><?php the_content(); ?></p>
                                </div>
                            </div>
                        <?php endwhile;
                        wp_reset_postdata();
                    endif;
                    ?>
                </div>

                <!-- Programs (Café, Creative, Summer, Additional) -->
                <div class="space-y-6">
                    <?php
                    $programs = new WP_Query(['post_type' => 'program', 'posts_per_page' => -1, 'orderby' => 'menu_order', 'order' => 'ASC']);
                    if ($programs->have_posts()):
                        while ($programs->have_posts()): $programs->the_post(); ?>
                            <div class="bg-white shadow rounded-lg p-6 flex items-start space-x-6">
                                <div class="w-48 h-32 bg-green-100 rounded-lg flex-shrink-0 overflow-hidden">
                                    <?php if (has_post_thumbnail()): ?>
                                        <?php the_post_thumbnail('medium', ['class' => 'w-full h-full object-cover']); ?>
                                    <?php else: ?>
                                        <div class="w-full h-full flex items-center justify-center text-gray-600">
                                            <?php the_title(); ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div class="flex-1">
                                    <h3 class="text-lg font-semibold text-gray-800 mb-3"><?php the_title(); ?></h3>
                                    <div class="text-gray-700 leading-relaxed"><?php the_content(); ?></div>
                                </div>
                            </div>
                        <?php endwhile;
                        wp_reset_postdata();
                    endif;
                    ?>
                </div>

            </div>

            <!-- Sidebar -->
           <div class="lg:col-span-1">
        <?php get_sidebar(); ?>
      </div>
        </div>
    </div>
</main>

<?php get_footer(); ?>
