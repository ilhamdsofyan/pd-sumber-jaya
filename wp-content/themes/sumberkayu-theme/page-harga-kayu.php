<?php
/**
 * Template Name: Harga Kayu
 * Pillar SEO Page Template
 * @package sumberkayu
 */

get_header();

// Fetch products for price tables
$meranti_query = new WP_Query(array(
    'post_type' => 'product',
    'posts_per_page' => -1,
    'tax_query' => array(
        array(
            'taxonomy' => 'jenis_kayu',
            'field'    => 'slug',
            'terms'    => 'kayu-sedang', // Meranti usually fallback here in my seeder
        ),
    ),
));

$keras_query = new WP_Query(array(
    'post_type' => 'product',
    'posts_per_page' => -1,
    'tax_query' => array(
        array(
            'taxonomy' => 'jenis_kayu',
            'field'    => 'slug',
            'terms'    => 'kayu-keras',
        ),
    ),
));
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
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
            <div class="lg:col-span-2">
                <div class="prose prose-lg max-w-none dark:prose-invert">
                    <?php while ( have_posts() ) : the_post(); the_content(); endwhile; ?>
                </div>

                <!-- Price Table: Kayu Keras -->
                <div class="mt-12">
                    <h2 class="text-3xl font-black mb-6">Daftar Harga Kayu Keras (Premium)</h2>
                    <div class="overflow-x-auto bg-white dark:bg-background-dark rounded shadow-lg border border-gray-200 dark:border-white/10">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-gray-100 dark:bg-white/5">
                                    <th class="p-4 font-black uppercase text-sm border-b border-gray-200 dark:border-white/10 text-primary">Nama Produk</th>
                                    <th class="p-4 font-black uppercase text-sm border-b border-gray-200 dark:border-white/10 text-primary">Karakteristik</th>
                                    <th class="p-4 font-black uppercase text-sm border-b border-gray-200 dark:border-white/10 text-primary">Status Stok</th>
                                    <th class="p-4 font-black uppercase text-sm border-b border-gray-200 dark:border-white/10 text-primary">Link</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if ( $keras_query->have_posts() ) : while ( $keras_query->have_posts() ) : $keras_query->the_post(); ?>
                                <tr class="hover:bg-gray-50 dark:hover:bg-white/5 transition-colors">
                                    <td class="p-4 font-bold border-b border-gray-200 dark:border-white/10"><?php the_title(); ?></td>
                                    <td class="p-4 text-sm text-gray-600 dark:text-gray-400 border-b border-gray-200 dark:border-white/10 italic">Premium / Keras</td>
                                    <td class="p-4 border-b border-gray-200 dark:border-white/10">
                                        <span class="bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400 px-3 py-1 rounded-full text-xs font-black">TERSEDIA</span>
                                    </td>
                                    <td class="p-4 border-b border-gray-200 dark:border-white/10">
                                        <a href="<?php the_permalink(); ?>" class="text-primary font-bold hover:underline">Detail &rarr;</a>
                                    </td>
                                </tr>
                                <?php endwhile; wp_reset_postdata(); else : ?>
                                <tr><td colspan="4" class="p-4 text-center">Data tidak ditemukan.</td></tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Price Table: Kayu Sedang -->
                <div class="mt-12">
                    <h2 class="text-3xl font-black mb-6">Daftar Harga Kayu Konstruksi Umum</h2>
                    <div class="overflow-x-auto bg-white dark:bg-background-dark rounded shadow-lg border border-gray-200 dark:border-white/10">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-gray-100 dark:bg-white/5">
                                    <th class="p-4 font-black uppercase text-sm border-b border-gray-200 dark:border-white/10 text-primary">Nama Produk</th>
                                    <th class="p-4 font-black uppercase text-sm border-b border-gray-200 dark:border-white/10 text-primary">Karakteristik</th>
                                    <th class="p-4 font-black uppercase text-sm border-b border-gray-200 dark:border-white/10 text-primary">Status Stok</th>
                                    <th class="p-4 font-black uppercase text-sm border-b border-gray-200 dark:border-white/10 text-primary">Link</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if ( $meranti_query->have_posts() ) : while ( $meranti_query->have_posts() ) : $meranti_query->the_post(); ?>
                                <tr class="hover:bg-gray-50 dark:hover:bg-white/5 transition-colors">
                                    <td class="p-4 font-bold border-b border-gray-200 dark:border-white/10"><?php the_title(); ?></td>
                                    <td class="p-4 text-sm text-gray-600 dark:text-gray-400 border-b border-gray-200 dark:border-white/10 italic">Konstruksi Umum</td>
                                    <td class="p-4 border-b border-gray-200 dark:border-white/10">
                                        <span class="bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-400 px-3 py-1 rounded-full text-xs font-black">VOLUME BESAR</span>
                                    </td>
                                    <td class="p-4 border-b border-gray-200 dark:border-white/10">
                                        <a href="<?php the_permalink(); ?>" class="text-primary font-bold hover:underline">Detail &rarr;</a>
                                    </td>
                                </tr>
                                <?php endwhile; wp_reset_postdata(); else : ?>
                                <tr><td colspan="4" class="p-4 text-center">Data tidak ditemukan.</td></tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Note on Prices -->
                <div class="mt-8 p-6 bg-yellow-50 dark:bg-yellow-900/10 border-l-4 border-yellow-400 rounded">
                    <p class="text-sm text-yellow-800 dark:text-yellow-400 font-bold">PENTING:</p>
                    <p class="text-sm text-yellow-800 dark:text-yellow-400">Harga kayu sangat fluktuatif mengikuti ketersediaan stok dan biaya logistik. Untuk mendapatkan harga fix dan diskon volume khusus proyek, silakan hubungi tim sales kami melalui WhatsApp atau Telepon.</p>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="space-y-8">
                <div class="bg-primary text-white p-8 rounded shadow-lg">
                    <h3 class="text-2xl font-black mb-4">Request Penawaran</h3>
                    <p class="mb-6 opacity-90">Kirimkan spesifikasi dan volume kayu yang Anda butuhkan (BOQ). Kami akan menghitungkan harga terbaik dalam 1x24 jam.</p>
                    <a href="<?php echo esc_url( sumberkayu_whatsapp_url( 'Halo, saya ingin request penawaran kayu untuk proyek' ) ); ?>" target="_blank" rel="noopener" class="block bg-white text-primary text-center py-4 rounded font-bold hover:bg-gray-100 transition-colors uppercase tracking-wider text-sm" data-tracking="whatsapp-click">
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
