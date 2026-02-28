<?php
/**
 * 404 Template
 * @package sumberkayu
 */

get_header();
?>

<section class="py-20 min-h-[60vh] flex items-center">
    <div class="max-w-[1280px] mx-auto px-6 lg:px-20 text-center">
        <h1 class="text-9xl font-black text-primary mb-4">404</h1>
        <h2 class="text-3xl font-black mb-4">Halaman Tidak Ditemukan</h2>
        <p class="text-gray-600 dark:text-gray-400 text-lg mb-8 max-w-lg mx-auto">
            Maaf, halaman yang Anda cari tidak tersedia. Silakan kembali ke beranda atau lihat produk kami.
        </p>
        <div class="flex flex-wrap justify-center gap-4">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="bg-primary hover:bg-blue-700 text-white px-8 py-4 rounded font-bold text-base transition-colors">
                Kembali ke Beranda
            </a>
            <a href="<?php echo esc_url( get_post_type_archive_link( 'product' ) ); ?>" class="bg-[#e7ebf3] hover:bg-gray-300 text-[#0e121b] px-8 py-4 rounded font-bold text-base transition-colors">
                Lihat Produk Kayu
            </a>
        </div>
    </div>
</section>

<?php get_footer(); ?>
