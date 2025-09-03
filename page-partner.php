<?php


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
                
                <!-- Introduction -->
                <div class="bg-white shadow rounded-lg p-6 text-gray-700 leading-relaxed mb-6">
                    <?php
                    if (have_posts()):
                        while (have_posts()): the_post();
                            the_content();
                        endwhile;
                    endif;
                    ?>
                </div>

                <!-- Partner Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <?php
                    $partners = new WP_Query([
                        'post_type' => 'partner',
                        'posts_per_page' => -1,
                        'orderby' => 'title',
                        'order' => 'ASC'
                    ]);

                    if ($partners->have_posts()):
                        while ($partners->have_posts()): $partners->the_post();
                            $partner_url = get_post_meta(get_the_ID(), 'partner_url', true);
                            ?>
                            
                            <div class="bg-white shadow rounded-lg p-6 flex flex-col items-center text-center">
                                <div class="w-32 h-32 mb-4 flex items-center justify-center">
                                    <?php if (has_post_thumbnail()): ?>
                                        <?php the_post_thumbnail('medium', ['class' => 'object-contain max-h-32']); ?>
                                    <?php else: ?>
                                        <div class="bg-gray-200 w-full h-full flex items-center justify-center text-gray-500">
                                            Logo fehlt
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <h3 class="text-lg font-semibold text-gray-800 mb-2"><?php the_title(); ?></h3>
                                <p class="text-gray-600 text-sm mb-3"><?php the_excerpt(); ?></p>
                                <?php if ($partner_url): ?>
                                    <a href="<?= esc_url($partner_url); ?>" target="_blank" class="text-blue-600 hover:underline">
                                        Website besuchen
                                    </a>
                                <?php endif; ?>
                            </div>

                        <?php endwhile;
                        wp_reset_postdata();
                    else: ?>
                        <p class="text-gray-600">Noch keine Partner eingetragen.</p>
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
