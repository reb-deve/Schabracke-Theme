<?php
/*
Template Name: Team Page
*/

get_header(); 
?>

<main class="flex-1 bg-gray-50">
    <div class="container mx-auto px-4 py-8">
        <!-- Page Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-800 mb-4"><?php the_title(); ?></h1>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Main Content -->
            <div class="lg:col-span-2 space-y-8">
                
                <!-- Introduction Text -->
                <div class="bg-white shadow rounded-lg p-6 text-gray-700 leading-relaxed mb-6">
                    <?php
                    if (have_posts()):
                        while (have_posts()): the_post();
                            the_content();
                        endwhile;
                    endif;
                    ?>
                </div>

                <!-- Team Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <?php
                    $team = new WP_Query([
                        'post_type' => 'team',
                        'posts_per_page' => -1,
                        'orderby' => 'menu_order',
                        'order' => 'ASC'
                    ]);

                    if ($team->have_posts()):
                        while ($team->have_posts()): $team->the_post();
                            $position = get_post_meta(get_the_ID(), 'position', true);
                            $email = get_post_meta(get_the_ID(), 'email', true);
                            $phone = get_post_meta(get_the_ID(), 'phone', true);
                            ?>
                            
                            <div class="bg-white shadow rounded-lg p-6 flex flex-col items-center text-center">
                                <!-- Profile Picture -->
                                <div class="w-32 h-32 mb-4 rounded-full overflow-hidden">
                                    <?php if (has_post_thumbnail()): ?>
                                        <?php the_post_thumbnail('medium', ['class' => 'object-cover w-full h-full']); ?>
                                    <?php else: ?>
                                        <div class="bg-gray-200 w-full h-full flex items-center justify-center text-gray-500">
                                            Kein Bild
                                        </div>
                                    <?php endif; ?>
                                </div>

                                <!-- Name -->
                                <h3 class="text-lg font-semibold text-gray-800"><?php the_title(); ?></h3>

                                <!-- Position -->
                                <?php if ($position): ?>
                                    <p class="text-sm text-gray-600 mb-2"><?= esc_html($position); ?></p>
                                <?php endif; ?>

                                <!-- Bio -->
                                <p class="text-gray-600 text-sm mb-3"><?php the_excerpt(); ?></p>

                                <!-- Contact -->
                                <div class="space-y-1 text-sm">
                                    <?php if ($email): ?>
                                        <p><a href="mailto:<?= esc_attr($email); ?>" class="text-blue-600 hover:underline"><?= esc_html($email); ?></a></p>
                                    <?php endif; ?>
                                    <?php if ($phone): ?>
                                        <p><a href="tel:<?= esc_attr($phone); ?>" class="text-gray-700"><?= esc_html($phone); ?></a></p>
                                    <?php endif; ?>
                                </div>
                            </div>

                        <?php endwhile;
                        wp_reset_postdata();
                    else: ?>
                        <p class="text-gray-600">Noch keine Teammitglieder eingetragen.</p>
                    <?php endif; ?>
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
