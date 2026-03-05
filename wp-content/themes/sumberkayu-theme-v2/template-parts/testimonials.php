<?php
/**
 * Testimonials Section
 * @package sumberkayu
 */

$testimonials = new WP_Query([
    'post_type'      => 'testimonial',
    'posts_per_page' => 6,
    'post_status'    => 'publish',
    'orderby'        => 'menu_order',
    'order'          => 'ASC'
]);
?>
<section class="py-12 bg-[#f8fafc] dark:bg-background-dark/40">
    <div class="max-w-[1280px] mx-auto px-6 lg:px-20">
        <h3 class="text-primary text-sm font-black uppercase tracking-wider mb-6">Testimoni</h3>
        <div class="relative overflow-hidden">
            <div class="testimonials-track flex gap-6 transition-transform duration-500" style="transform: translateX(0)">
                <?php 
                if ($testimonials->have_posts()):
                    while ($testimonials->have_posts()): $testimonials->the_post(); 
                        $client_role = get_post_meta(get_the_ID(), '_testimonial_role', true);
                ?>
                    <div class="bg-white dark:bg-background-dark p-6 rounded shadow-md min-w-[280px] flex-1">
                        <div class="text-gray-700 dark:text-gray-300 mb-4 italic">
                            <?php the_content(); ?>
                        </div>
                        <p class="font-bold">
                            — <?php the_title(); ?><?php echo $client_role ? ', ' . esc_html($client_role) : ''; ?>
                        </p>
                    </div>
                <?php 
                    endwhile;
                    wp_reset_postdata();
                else: 
                ?>
                    <div class="bg-white dark:bg-background-dark p-6 rounded shadow-md min-w-[280px]">
                        <p class="text-gray-500">Belum ada testimoni.</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

