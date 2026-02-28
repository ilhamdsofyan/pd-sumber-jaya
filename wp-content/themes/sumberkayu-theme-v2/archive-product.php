<?php
/**
 * Product Archive Template
 * Converts products.html
 * @package sumberkayu
 */

get_header();
?>

<!-- Header Section -->
<section class="bg-gradient-to-r from-primary to-blue-600 text-white py-12">
    <div class="max-w-[1280px] mx-auto px-6 lg:px-20">
        <h1 class="text-4xl md:text-5xl font-black mb-4">Katalog Produk Kayu</h1>
        <p class="text-lg text-blue-100 max-w-2xl">Jelajahi koleksi lengkap kayu konstruksi berkualitas tinggi dengan spesifikasi terperinci dan harga kompetitif.</p>
    </div>
</section>

<!-- Products Grid -->
<section class="py-20">
    <div class="max-w-[1280px] mx-auto px-6 lg:px-20">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php
            if ( have_posts() ) :
                while ( have_posts() ) : the_post();
                    $image_path = get_post_meta( get_the_ID(), '_product_image_path', true );
                    $img_url = $image_path ? SUMBERKAYU_URI . '/' . $image_path : ( has_post_thumbnail() ? get_the_post_thumbnail_url( null, 'product-card' ) : SUMBERKAYU_URI . '/assets/images/placeholder.webp' );
            ?>
            <div class="group bg-white dark:bg-background-dark rounded shadow-md overflow-hidden hover:shadow-xl transition-shadow">
                <div class="relative h-64 bg-gray-200 overflow-hidden">
                    <img src="<?php echo esc_url( $img_url ); ?>" alt="<?php the_title_attribute(); ?>" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300" loading="lazy" />
                    <div class="absolute top-4 right-4 bg-primary text-white px-3 py-1 text-xs font-bold rounded">TERSEDIA</div>
                </div>
                <div class="p-6">
                    <h3 class="text-2xl font-black text-[#0e121b] dark:text-white mb-2"><?php the_title(); ?></h3>
                    <p class="text-gray-600 dark:text-gray-400 text-sm mb-4">
                        <?php echo esc_html( get_post_meta( get_the_ID(), '_product_subtitle', true ) ); ?>
                    </p>
                    <div class="flex items-center justify-between mb-4">
                        <div class="text-xs font-bold text-primary uppercase">Tersedia</div>
                        <span class="text-lg font-black text-gray-400">&rarr;</span>
                    </div>
                    <a href="<?php the_permalink(); ?>" class="block w-full bg-primary hover:bg-blue-700 text-white p-3 rounded font-bold text-sm transition-colors text-center">
                        Lihat Detail
                    </a>
                </div>
            </div>
            <?php
                endwhile;
            else :
                echo '<p class="col-span-3 text-center text-gray-500">Belum ada produk.</p>';
            endif;
            ?>
        </div>
    </div>
</section>

<?php
get_template_part( 'template-parts/cta-block', null, array(
    'title'   => 'Butuh Konsultasi Produk?',
    'message' => 'Tim profesional kami siap membantu Anda memilih kayu yang tepat untuk proyek Anda.',
    'wa_text' => '',
) );

get_footer();
?>
