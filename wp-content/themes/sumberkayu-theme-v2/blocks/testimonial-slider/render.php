<?php
/**
 * Render template for the Testimonial Slider block
 */

// Fetch Testimonial CPTs
$testimonials = new WP_Query([
    'post_type'      => 'testimonial',
    'posts_per_page' => 6,
    'post_status'    => 'publish',
    'orderby'        => 'menu_order',
    'order'          => 'ASC'
]);

// Fallback logic for demo/UI if no posts exist
$has_posts = $testimonials->have_posts();
?>

<section class="py-20 bg-background-light dark:bg-background-dark/50" <?php echo get_block_wrapper_attributes(); ?>>
    <div class="max-w-[1280px] mx-auto px-6 lg:px-20 relative">
        <h2 class="text-3xl font-black mb-12 text-center text-[#0e121b] dark:text-white">Apa Kata Klien Kami?</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php if ($has_posts): while ($testimonials->have_posts()): $testimonials->the_post(); 
                $client_role = get_post_meta(get_the_ID(), '_testimonial_role', true);
            ?>
                <div class="bg-white dark:bg-background-dark p-8 rounded-xl shadow-md border border-[#e7ebf3] dark:border-white/10 relative">
                    <span class="material-symbols-outlined text-primary/20 text-6xl absolute top-6 right-6">format_quote</span>
                    
                    <div class="flex text-yellow-500 mb-6">
                        <?php for($i=1; $i<=5; $i++) echo '<span class="material-symbols-outlined" style="font-variation-settings: \'FILL\' 1">star</span>'; ?>
                    </div>
                    
                    <div class="text-gray-700 dark:text-gray-300 mb-8 italic">
                        <?php the_content(); ?>
                    </div>
                    
                    <div class="flex items-center gap-4">
                        <?php if (has_post_thumbnail()): ?>
                            <?php the_post_thumbnail('thumbnail', ['class' => 'w-12 h-12 rounded-full object-cover', 'loading' => 'lazy']); ?>
                        <?php else: ?>
                            <div class="w-12 h-12 bg-primary text-white rounded-full flex items-center justify-center font-bold text-xl">
                                <?php echo substr(get_the_title(), 0, 1); ?>
                            </div>
                        <?php endif; ?>
                        
                        <div>
                            <h4 class="font-bold text-[#0e121b] dark:text-white text-sm"><?php the_title(); ?></h4>
                            <?php if ($client_role): ?>
                                <p class="text-xs text-primary font-bold uppercase tracking-wider"><?php echo esc_html($client_role); ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endwhile; wp_reset_postdata(); else: ?>
                <!-- Fallback Mock Data -->
                <div class="bg-white dark:bg-background-dark p-8 rounded-xl shadow-md border border-[#e7ebf3] dark:border-white/10 relative">
                    <span class="material-symbols-outlined text-primary/20 text-6xl absolute top-6 right-6">format_quote</span>
                    <div class="flex text-yellow-500 mb-6">★★★★★</div>
                    <p class="text-gray-700 dark:text-gray-300 mb-8 italic">"Kualitas kayu sangat baik dan presisi. Pengiriman juga selalu tepat waktu sesuai jadwal proyek kami."</p>
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-primary text-white rounded-full flex items-center justify-center font-bold text-xl">A</div>
                        <div>
                            <h4 class="font-bold text-[#0e121b] dark:text-white text-sm">Bpk. Ahmad</h4>
                            <p class="text-xs text-primary font-bold uppercase tracking-wider">Kontraktor Sipil</p>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>
