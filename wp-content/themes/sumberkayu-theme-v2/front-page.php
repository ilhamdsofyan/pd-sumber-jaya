<?php
/**
 * Front Page Template
 * Converts index.html homepage
 * @package sumberkayu
 */

get_header();
?>

<!-- Hero Section -->
<section class="relative w-full min-h-[640px] flex items-center">
    <div class="absolute inset-0 z-0">
        <div class="absolute inset-0 bg-black/60 z-10"></div>
        <img alt="Timber warehouse with organized wood stacks" class="w-full h-full object-cover" fetchpriority="high"
            src="https://lh3.googleusercontent.com/aida-public/AB6AXuC5L7SQKmL72n2rpMVPqWOZlzvQpd0CWZYHQB_wD-QoZ_4hvYkPGYWL-HxjHpPi7Jaxmpsz10ameqJFPpL18aAF80E1_-pEBsaVDcsIvmikwspwqsolB8kYQJQDTxpdVg_t9L2PSJJEn1wTv6q1OGW3IIlxInCXO3yJZ64g8kWHxKBLFPLWJDwJMyL_nCMdKkcprihoFEFzJexXO0MSfMiDJBwUU_ONVfNzsQ09cnCXkwZy8D5qRZ3hMs5pbwueIP1IWndDTNW_zqu6" />
    </div>
    <div class="relative z-20 max-w-[1280px] mx-auto px-6 lg:px-20 w-full">
        <div class="max-w-3xl">
            <span class="bg-primary px-3 py-1 text-xs font-black text-white uppercase tracking-widest mb-6 inline-block">B2B &amp; Supplier Konstruksi</span>
            <h1 class="text-white text-5xl md:text-7xl font-black leading-[1.1] tracking-tight mb-6">
                <?php echo esc_html( sumberkayu_get_h1() ); ?>
            </h1>
            <p class="text-gray-200 text-lg md:text-xl font-normal leading-relaxed mb-10 max-w-2xl">
                Kami menyediakan berbagai jenis kayu, antara lain Meranti, Kamper, Bengkirai, Damar Laut, Merbau, dan Ulin, dengan pasokan stabil dan spesifikasi jelas. Setiap pemesanan ditangani secara profesional untuk memastikan komitmen volume, kualitas, dan ketepatan pengiriman sesuai kebutuhan proyek Anda.
            </p>
            <div class="flex flex-wrap gap-4">
                <a href="<?php echo esc_url( sumberkayu_phone_url() ); ?>" class="bg-primary hover:bg-blue-700 text-white flex items-center gap-3 px-8 py-4 rounded font-bold text-base transition-all group" data-tracking="phone-call">
                    <span class="material-symbols-outlined">call</span>
                    <span><?php echo esc_html( SUMBERKAYU_PHONE_DISPLAY ); ?></span>
                </a>
                <a href="<?php echo esc_url( SUMBERKAYU_MAPS_URL ); ?>" target="_blank" rel="noopener" class="bg-white hover:bg-gray-100 text-[#0e121b] flex items-center gap-3 px-8 py-4 rounded font-bold text-base transition-all">
                    <span class="material-symbols-outlined">location_on</span>
                    <span>Datang ke Lokasi</span>
                </a>
            </div>
        </div>
    </div>
</section>

<?php get_template_part( 'template-parts/trust-signals' ); ?>

<!-- Product Overview -->
<section class="py-20 bg-white dark:bg-background-dark">
    <div class="max-w-[1280px] mx-auto px-6 lg:px-20">
        <div class="flex flex-col md:flex-row justify-between items-end mb-12 gap-6">
            <div class="max-w-xl">
                <h2 class="text-primary text-sm font-black uppercase tracking-[0.2em] mb-4">Katalog Material</h2>
                <h3 class="text-[#0e121b] dark:text-white text-4xl font-black tracking-tight">Produk Kayu Unggulan</h3>
            </div>
            <a href="<?php echo esc_url( get_post_type_archive_link( 'product' ) ); ?>" class="text-primary font-bold uppercase tracking-wider hover:underline flex items-center gap-2">
                Lihat Semua
                <span class="material-symbols-outlined">arrow_forward</span>
            </a>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <?php
            $products = new WP_Query( array(
                'post_type'      => 'product',
                'posts_per_page' => 6,
                'orderby'        => 'menu_order',
                'order'          => 'ASC',
            ) );
            while ( $products->have_posts() ) : $products->the_post();
                $image_path = get_post_meta( get_the_ID(), '_product_image_path', true );
                $subtitle = get_post_meta( get_the_ID(), '_product_subtitle', true );
                $img_url = $image_path ? SUMBERKAYU_URI . '/' . $image_path : ( has_post_thumbnail() ? get_the_post_thumbnail_url( null, 'product-card' ) : SUMBERKAYU_URI . '/assets/images/placeholder.webp' );
            ?>
            <a href="<?php the_permalink(); ?>" class="group relative overflow-hidden aspect-[4/5] bg-gray-200 block cursor-pointer">
                <img alt="<?php the_title_attribute(); ?>" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" loading="lazy" src="<?php echo esc_url( $img_url ); ?>" />
                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent"></div>
                <div class="absolute bottom-0 left-0 p-8">
                    <p class="text-white text-2xl font-bold mb-2"><?php the_title(); ?></p>
                    <?php if ( $subtitle ) : ?>
                    <p class="text-gray-300 text-xs uppercase tracking-widest font-bold"><?php echo esc_html( $subtitle ); ?></p>
                    <?php endif; ?>
                </div>
            </a>
            <?php endwhile; wp_reset_postdata(); ?>
        </div>
    </div>
</section>

<!-- Partners Section -->
<section class="py-12 bg-white dark:bg-background-dark">
    <div class="max-w-[1280px] mx-auto px-6 lg:px-20">
        <div class="flex items-center justify-between mb-8">
            <h3 class="text-primary text-sm font-black uppercase tracking-wider">Partners</h3>
            <div class="flex items-center gap-3">
                <button id="partners-prev" class="hidden md:inline-flex bg-gray-100 p-2 rounded">&#8249;</button>
                <button id="partners-next" class="hidden md:inline-flex bg-gray-100 p-2 rounded">&#8250;</button>
            </div>
        </div>
        <div class="partners-track overflow-x-auto scroll-smooth flex gap-6 py-4">
            <img src="<?php echo esc_url( SUMBERKAYU_URI . '/assets/images/partners/korindo-heavy-industry.webp' ); ?>" alt="PT Korindo Heavy Industry" title="PT Korindo Heavy Industry" class="h-16 mr-5 object-contain" loading="lazy" />
            <img src="<?php echo esc_url( SUMBERKAYU_URI . '/assets/images/partners/kopi-nako.png' ); ?>" alt="Kopi Nako" title="Kopi Nako" class="h-16 mr-5 object-contain" loading="lazy" />
            <img src="<?php echo esc_url( SUMBERKAYU_URI . '/assets/images/partners/bakrie-pipe-industries.webp' ); ?>" alt="PT Bakrie Pipe Industries" title="PT Bakrie Pipe Industries" class="h-16 mr-5 object-contain" loading="lazy" />
            <img src="<?php echo esc_url( SUMBERKAYU_URI . '/assets/images/partners/pt-alam-sutera.png' ); ?>" alt="PT Alam Sutra" title="PT Alam Sutra" class="h-16 mr-5 object-contain" loading="lazy" />
            <img src="<?php echo esc_url( SUMBERKAYU_URI . '/assets/images/partners/gunung-raja-paksi.png' ); ?>" alt="PT Gunung Raja Paksi" title="PT Gunung Raja Paksi" class="h-16 mr-5 object-contain" loading="lazy" />
            <img src="<?php echo esc_url( SUMBERKAYU_URI . '/assets/images/partners/porter-rekayasa-unggul.png' ); ?>" alt="PT Porter Rekayasa Unggul" title="PT Porter Rekayasa Unggul" class="h-16 mr-5 object-contain" loading="lazy" />
        </div>
    </div>
</section>

<?php get_template_part( 'template-parts/testimonials' ); ?>

<?php get_template_part( 'template-parts/gudang-visit' ); ?>

<?php get_footer(); ?>
