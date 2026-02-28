<?php
/**
 * Single Blog Post Template
 * @package sumberkayu
 */

get_header();

while ( have_posts() ) : the_post();
?>

<section class="py-16">
    <div class="max-w-[800px] mx-auto px-6 lg:px-20">
        <h1 class="text-4xl md:text-5xl font-black mb-6"><?php the_title(); ?></h1>
        <div class="flex items-center gap-4 text-sm text-gray-500 mb-8">
            <time datetime="<?php echo get_the_date( 'Y-m-d' ); ?>"><?php echo get_the_date(); ?></time>
            <?php if ( has_category() ) : ?>
            <span>&bull;</span>
            <span><?php the_category( ', ' ); ?></span>
            <?php endif; ?>
        </div>

        <?php if ( has_post_thumbnail() ) : ?>
        <div class="mb-8 rounded overflow-hidden">
            <?php the_post_thumbnail( 'large', array( 'class' => 'w-full h-auto' ) ); ?>
        </div>
        <?php endif; ?>

        <div class="prose prose-lg max-w-none dark:prose-invert">
            <?php the_content(); ?>
        </div>

        <!-- Internal Links to Money Pages -->
        <div class="mt-12 p-6 bg-[#e7ebf3] dark:bg-background-dark/50 rounded">
            <h3 class="text-lg font-black mb-4">Produk Kayu Unggulan Kami</h3>
            <div class="flex flex-wrap gap-3">
                <?php
                $money_pages = array(
                    'Harga Kayu' => '/harga-kayu/',
                    'Kayu Meranti' => '/products/kayu-meranti/',
                    'Kayu Kamper' => '/products/kayu-kamper/',
                    'Kayu Bengkirai' => '/products/kayu-bengkirai/',
                    'Kayu Merbau' => '/products/kayu-merbau/',
                    'Kayu Ulin' => '/products/kayu-ulin/',
                );
                foreach ( $money_pages as $label => $path ) :
                ?>
                <a href="<?php echo esc_url( home_url( $path ) ); ?>" class="bg-white dark:bg-background-dark px-4 py-2 rounded text-sm font-bold text-primary hover:bg-primary hover:text-white transition-colors">
                    <?php echo esc_html( $label ); ?>
                </a>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>

<?php endwhile; ?>

<?php
get_template_part( 'template-parts/cta-block', null, array(
    'title'   => 'Butuh Material Kayu?',
    'message' => 'PD Sumber Jaya siap membantu kebutuhan kayu konstruksi Anda.',
    'wa_text' => '',
) );

get_footer();
?>
