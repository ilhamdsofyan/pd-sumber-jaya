<?php
/**
 * Render template for the Feature Cards block
 */

// Fallback data if ACF isn't used or empty
$features = function_exists('get_field') ? get_field('features') : false;

if (empty($features)) {
    $features = [
        [
            'icon' => 'verified',
            'title' => 'Kualitas Legal & Terjamin',
            'desc'  => 'Semua produk kayu kami dilengkapi dengan dokumen legal (FA-KO) dan melewati proses Quality Control ketat.'
        ],
        [
            'icon' => 'inventory_2',
            'title' => 'Stok Melimpah',
            'desc'  => 'Kapasitas gudang besar memastikan ketersediaan pasokan untuk kebutuhan proyek skala menengah hingga besar.'
        ],
        [
            'icon' => 'local_shipping',
            'title' => 'Pengiriman Cepat',
            'desc'  => 'Armada pengiriman sendiri menjamin ketepatan waktu pengiriman ke seluruh Jabodetabek dan sekitarnya.'
        ]
    ];
}
?>

<section class="py-16 bg-[#e7ebf3] dark:bg-background-dark/50" <?php echo get_block_wrapper_attributes(); ?>>
    <div class="max-w-[1280px] mx-auto px-6 lg:px-20">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <?php foreach ($features as $feature): ?>
            <div class="bg-white dark:bg-background-dark p-8 rounded-xl shadow-md border border-[#e7ebf3] dark:border-white/10 hover:shadow-xl transition-all group">
                <div class="w-14 h-14 bg-primary/10 rounded-full flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                    <span class="material-symbols-outlined text-primary text-3xl"><?php echo esc_html($feature['icon']); ?></span>
                </div>
                <h3 class="text-xl font-black text-[#0e121b] dark:text-white mb-3 tracking-tight"><?php echo esc_html($feature['title']); ?></h3>
                <p class="text-gray-600 dark:text-gray-400 leading-relaxed text-sm">
                    <?php echo wp_kses_post($feature['desc']); ?>
                </p>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
