<?php
/**
 * Render template for the Product Grid block
 */

$posts_to_show = isset($attributes['postsToShow']) ? $attributes['postsToShow'] : 3;
$display_tag   = isset($attributes['displayTag']) ? $attributes['displayTag'] : '';
$display_category = isset($attributes['displayCategory']) ? $attributes['displayCategory'] : '';

$args = [
    'post_type'      => 'product',
    'posts_per_page' => $posts_to_show,
    'post_status'    => 'publish',
    'orderby'        => 'menu_order',
    'order'          => 'ASC',
];

if (!empty($display_tag)) {
    $args['tax_query'][] = [
        'taxonomy' => 'product_tag',
        'field'    => 'slug',
        'terms'    => $display_tag,
    ];
}

if (!empty($display_category)) {
    $args['tax_query'][] = [
        'taxonomy' => 'product_category',
        'field'    => 'slug',
        'terms'    => $display_category,
    ];
}

$products = new WP_Query($args);
?>

<section class="py-20 bg-white dark:bg-background-dark" <?php echo get_block_wrapper_attributes(); ?>>
    <div class="max-w-[1280px] mx-auto px-6 lg:px-20">
        <div class="flex flex-col md:flex-row justify-between items-end mb-12 gap-6">
            <div class="max-w-xl">
                <h2 class="text-primary text-sm font-black uppercase tracking-[0.2em] mb-4">Katalog Material</h2>
                <h3 class="text-[#0e121b] dark:text-white text-4xl font-black tracking-tight">Produk Kayu Unggulan</h3>
            </div>
            <a href="<?php echo esc_url(get_post_type_archive_link('product')); ?>" class="text-primary font-bold uppercase tracking-wider hover:underline flex items-center gap-2">
                Lihat Semua
                <span class="material-symbols-outlined">arrow_forward</span>
            </a>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <?php if ($products->have_posts()): while ($products->have_posts()): $products->the_post(); 
                $subtitle = get_post_meta(get_the_ID(), '_product_subtitle', true);
                $image_path = get_post_meta(get_the_ID(), '_product_image_path', true);
                $img_url = $image_path ? SUMBERKAYU_URI . '/' . $image_path : (has_post_thumbnail() ? get_the_post_thumbnail_url(null, 'product-card') : SUMBERKAYU_URI . '/assets/images/placeholder.webp');
            ?>
                <a href="<?php the_permalink(); ?>" class="group relative overflow-hidden aspect-[4/5] bg-gray-200 block cursor-pointer">
                    <img alt="<?php the_title_attribute(); ?>" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" loading="lazy" src="<?php echo esc_url($img_url); ?>" />
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent"></div>
                    <div class="absolute bottom-0 left-0 p-8">
                        <p class="text-white text-2xl font-bold mb-2"><?php the_title(); ?></p>
                        <?php if ($subtitle): ?>
                            <p class="text-gray-300 text-xs uppercase tracking-widest font-bold"><?php echo esc_html($subtitle); ?></p>
                        <?php endif; ?>
                    </div>
                </a>
            <?php endwhile; wp_reset_postdata(); else: ?>
                <p class="col-span-3 text-gray-500 text-center">Belum ada produk untuk ditampilkan.</p>
            <?php endif; ?>
        </div>
    </div>
</section>
