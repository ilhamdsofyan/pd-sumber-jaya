<?php
/**
 * Render template for the Partner Logos block
 */

// Fetch Partner CPTs
$partners = new WP_Query([
    'post_type'      => 'partner',
    'posts_per_page' => -1,
    'post_status'    => 'publish',
    'orderby'        => 'menu_order',
    'order'          => 'ASC'
]);
?>

<section class="py-12 bg-white dark:bg-background-dark" <?php echo get_block_wrapper_attributes(); ?>>
    <div class="max-w-[1280px] mx-auto px-6 lg:px-20">
        <div class="flex items-center justify-between mb-8">
            <h3 class="text-primary text-sm font-black uppercase tracking-wider">Partners</h3>
            
            <?php if ($partners->have_posts() && $partners->post_count > 4): ?>
            <div class="flex items-center gap-3">
                <button id="partners-prev" class="hidden md:inline-flex bg-gray-100 p-2 rounded hover:bg-gray-200 transition" aria-label="Previous partners">&#8249;</button>
                <button id="partners-next" class="hidden md:inline-flex bg-gray-100 p-2 rounded hover:bg-gray-200 transition" aria-label="Next partners">&#8250;</button>
            </div>
            <?php endif; ?>
        </div>
        
        <div class="partners-track overflow-x-auto scroll-smooth flex gap-6 py-4 items-center">
            <?php 
            if ($partners->have_posts()):
                while ($partners->have_posts()): $partners->the_post(); 
                    if (has_post_thumbnail()):
            ?>
                <?php the_post_thumbnail('medium', [
                    'class' => 'h-16 mr-5 object-contain opacity-70 hover:opacity-100 transition-opacity flex-shrink-0', 
                    'loading' => 'lazy',
                    'title' => get_the_title(),
                    'alt' => get_the_title()
                ]); ?>
            <?php 
                    endif;
                endwhile;
                wp_reset_postdata();
            else: 
            ?>
                <p class="text-gray-500">Logo partner akan muncul di sini setelah ditambahkan ke sistem.</p>
            <?php endif; ?>
        </div>
    </div>
</section>
