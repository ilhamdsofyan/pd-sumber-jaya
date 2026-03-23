<?php
/**
 * Template Name: Harga Kayu
 * Pillar SEO Page Template
 * @package sumberkayu
 */

get_header();

$product_query_args = array(
    'post_type'      => 'product',
    'post_status'    => 'publish',
    'posts_per_page' => -1,
    'orderby'        => 'title',
    'order'          => 'ASC',
);

$price_sections = array();
$price_terms    = get_terms(
    array(
        'taxonomy'   => 'kategori_harga',
        'hide_empty' => true,
        'orderby'    => 'name',
        'order'      => 'ASC',
    )
);

if ( ! is_wp_error( $price_terms ) && ! empty( $price_terms ) ) {
    foreach ( $price_terms as $price_term ) {
        $price_sections[] = array(
            'title' => sprintf( 'Daftar Harga Kayu %s', $price_term->name ),
            'query' => new WP_Query(
                array_merge(
                    $product_query_args,
                    array(
                        'tax_query' => array(
                            array(
                                'taxonomy' => 'kategori_harga',
                                'field'    => 'term_id',
                                'terms'    => $price_term->term_id,
                            ),
                        ),
                    )
                )
            ),
        );
    }
} else {
    $price_sections[] = array(
        'title' => 'Daftar Produk Kayu Tersedia',
        'query' => new WP_Query( $product_query_args ),
    );
}
?>

<!-- Hero Section -->
<section class="bg-gradient-to-r from-primary to-blue-600 text-white py-16">
    <div class="max-w-[1280px] mx-auto px-6 lg:px-20">
        <h1 class="text-5xl md:text-6xl font-black mb-6"><?php echo esc_html( sumberkayu_get_h1() ); ?></h1>
        <p class="text-lg text-blue-100 max-w-3xl">Pusat informasi harga kayu konstruksi terlengkap dan terbaru di Jakarta. Update harga periodik untuk mendukung estimasi anggaran proyek Anda.</p>
    </div>
</section>

<!-- Content Intro -->
<section class="py-16">
    <div class="max-w-[1280px] mx-auto px-6 lg:px-20">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16">
            <div>
                <div class="prose prose-lg max-w-none dark:prose-invert">
                    <?php while ( have_posts() ) : the_post(); the_content(); endwhile; ?>
                </div>

                <?php foreach ( $price_sections as $price_section ) : ?>
                <div class="mt-12">
                    <h2 class="text-3xl font-black mb-6"><?php echo esc_html( $price_section['title'] ); ?></h2>
                    <div class="overflow-x-auto bg-white dark:bg-background-dark rounded shadow-lg border border-gray-200 dark:border-white/10">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-gray-100 dark:bg-white/5">
                                    <th class="p-4 font-black uppercase text-sm border-b border-gray-200 dark:border-white/10 text-primary">Nama Produk</th>
                                    <th class="p-4 font-black uppercase text-sm border-b border-gray-200 dark:border-white/10 text-primary">Jenis Kayu</th>
                                    <th class="p-4 font-black uppercase text-sm border-b border-gray-200 dark:border-white/10 text-primary">Kategori</th>
                                    <th class="p-4 font-black uppercase text-sm border-b border-gray-200 dark:border-white/10 text-primary">Link</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if ( $price_section['query']->have_posts() ) : ?>
                                    <?php while ( $price_section['query']->have_posts() ) : $price_section['query']->the_post(); ?>
                                        <?php
                                        $jenis_kayu_terms = get_the_terms( get_the_ID(), 'jenis_kayu' );
                                        $kategori_terms   = get_the_terms( get_the_ID(), 'kategori_harga' );

                                        $jenis_kayu_label = ! empty( $jenis_kayu_terms ) && ! is_wp_error( $jenis_kayu_terms )
                                            ? implode( ', ', wp_list_pluck( $jenis_kayu_terms, 'name' ) )
                                            : 'Belum diatur';
                                        $kategori_label   = ! empty( $kategori_terms ) && ! is_wp_error( $kategori_terms )
                                            ? implode( ', ', wp_list_pluck( $kategori_terms, 'name' ) )
                                            : 'Hubungi kami';
                                        ?>
                                <tr class="hover:bg-gray-50 dark:hover:bg-white/5 transition-colors">
                                    <td class="p-4 font-bold border-b border-gray-200 dark:border-white/10"><?php the_title(); ?></td>
                                    <td class="p-4 text-sm text-gray-600 dark:text-gray-400 border-b border-gray-200 dark:border-white/10 italic"><?php echo esc_html( $jenis_kayu_label ); ?></td>
                                    <td class="p-4 border-b border-gray-200 dark:border-white/10">
                                        <span class="bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-400 px-3 py-1 rounded-full text-xs font-black"><?php echo esc_html( strtoupper( $kategori_label ) ); ?></span>
                                    </td>
                                    <td class="p-4 border-b border-gray-200 dark:border-white/10">
                                        <a href="<?php the_permalink(); ?>" class="text-primary font-bold hover:underline">Detail &rarr;</a>
                                    </td>
                                </tr>
                                    <?php endwhile; ?>
                                    <?php wp_reset_postdata(); ?>
                                <?php else : ?>
                                <tr><td colspan="4" class="p-4 text-center">Data tidak ditemukan.</td></tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <?php endforeach; ?>

                <!-- Note on Prices -->
                <div class="mt-8 p-6 bg-yellow-50 dark:bg-yellow-900/10 border-l-4 border-yellow-400 rounded">
                    <p class="text-sm text-yellow-800 dark:text-yellow-400 font-bold">PENTING:</p>
                    <p class="text-sm text-yellow-800 dark:text-yellow-400">Harga kayu sangat fluktuatif mengikuti ketersediaan stok dan biaya logistik. Untuk mendapatkan harga fix dan diskon volume khusus proyek, silakan hubungi tim sales kami melalui WhatsApp atau Telepon.</p>
                </div>
            </div>

            <!-- Sidebar -->
            <aside>
                <div class="space-y-8 lg:w-1/2">
                    <div class="bg-primary text-white p-8 rounded shadow-lg">
                        <h3 class="text-2xl font-black mb-4">Request Penawaran</h3>
                        <p class="mb-6 opacity-90">Kirimkan spesifikasi dan volume kayu yang Anda butuhkan (BOQ). Kami akan menghitungkan harga terbaik dalam 1x24 jam.</p>
                        <a href="<?php echo esc_url( sumberkayu_whatsapp_url() ); ?>" target="_blank" rel="noopener" class="block bg-white text-primary text-center py-4 rounded font-bold hover:bg-gray-100 transition-colors uppercase tracking-wider text-sm" data-tracking="whatsapp-click">
                            Chat via WhatsApp
                        </a>
                    </div>

                    <div class="bg-white dark:bg-background-dark p-8 rounded shadow border border-gray-200 dark:border-white/10">
                        <h3 class="text-xl font-black mb-4 underline decoration-primary decoration-4">Kenapa Beli di Kami?</h3>
                        <ul class="space-y-4">
                            <li class="flex items-start gap-3">
                                <span class="material-symbols-outlined text-primary">check_circle</span>
                                <span class="text-sm font-bold">Harga Supplier Langsung</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <span class="material-symbols-outlined text-primary">check_circle</span>
                                <span class="text-sm font-bold">Stok Selalu Ready</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <span class="material-symbols-outlined text-primary">check_circle</span>
                                <span class="text-sm font-bold">Siap Kirim se-Jabodetabek</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <span class="material-symbols-outlined text-primary">check_circle</span>
                                <span class="text-sm font-bold">Kualitas Terjamin</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </aside>
        </div>
    </div>
</section>

<?php get_template_part( 'template-parts/gudang-visit' ); ?>

<?php
get_template_part( 'template-parts/cta-block', null, array(
    'title'   => 'Dapatkan Harga Khusus Proyek',
    'message' => 'Segera hubungi kami untuk mendiskusikan volume pemesanan Anda dan dapatkan harga spesialis kontraktor.',
) );

get_footer();
?>
