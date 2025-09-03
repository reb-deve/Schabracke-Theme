<?php
/*
Template Name: Datenschutzerklärung Page
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
                <div class="bg-white shadow rounded-lg p-6 text-gray-700 leading-relaxed">
                    <?php
                    if (have_posts()):
                        while (have_posts()): the_post();
                            the_content();
                        endwhile;
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
