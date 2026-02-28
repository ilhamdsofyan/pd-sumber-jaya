<?php
/**
 * Generic Page Template
 * @package sumberkayu
 */

get_header();
?>

<section class="bg-gradient-to-r from-primary to-blue-600 text-white py-12">
    <div class="max-w-[1280px] mx-auto px-6 lg:px-20">
        <h1 class="text-4xl md:text-5xl font-black mb-4"><?php echo esc_html( sumberkayu_get_h1() ); ?></h1>
    </div>
</section>

<section class="py-20">
    <div class="max-w-[1280px] mx-auto px-6 lg:px-20">
        <div class="prose prose-lg max-w-none dark:prose-invert">
            <?php
            while ( have_posts() ) : the_post();
                the_content();
            endwhile;
            ?>
        </div>
    </div>
</section>

<?php
get_template_part( 'template-parts/cta-block', null, array(
    'title'   => 'Butuh Informasi Lebih Lanjut?',
    'message' => 'Tim kami siap membantu Anda. Hubungi kami sekarang.',
) );

get_footer();
?>
