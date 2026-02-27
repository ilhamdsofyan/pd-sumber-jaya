<?php
/**
 * Single Product Template
 * Converts product-detail.html
 * @package sumberkayu
 */

get_header();

$subtitle    = get_post_meta( get_the_ID(), '_product_subtitle', true );
$specs_json  = get_post_meta( get_the_ID(), '_product_specs', true );
$benefits_json = get_post_meta( get_the_ID(), '_product_benefits', true );
$image_path  = get_post_meta( get_the_ID(), '_product_image_path', true );

$specs = $specs_json ? json_decode( $specs_json, true ) : array();
$benefits = $benefits_json ? json_decode( $benefits_json, true ) : array();

$img_url = $image_path ? SUMBERKAYU_URI . '/' . $image_path : ( has_post_thumbnail() ? get_the_post_thumbnail_url( null, 'product-detail' ) : SUMBERKAYU_URI . '/assets/images/placeholder.webp' );
?>

<!-- Product Detail -->
<section class="py-16">
    <div class="max-w-[1280px] mx-auto px-6 lg:px-20">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            <!-- Product Image -->
            <div class="flex items-center justify-center">
                <div class="w-full bg-gray-200 rounded overflow-hidden aspect-square">
                    <img src="<?php echo esc_url( $img_url ); ?>" alt="<?php the_title_attribute(); ?>" class="w-full h-full object-cover" />
                </div>
            </div>

            <!-- Product Details -->
            <div>
                <div class="mb-6">
                    <span class="bg-primary text-white px-3 py-1 text-xs font-black uppercase rounded inline-block mb-4">Tersedia</span>
                    <h1 class="text-5xl font-black mb-2"><?php echo esc_html( sumberkayu_get_h1() ); ?></h1>
                    <?php if ( $subtitle ) : ?>
                    <p class="text-gray-600 dark:text-gray-400 text-lg"><?php echo esc_html( $subtitle ); ?></p>
                    <?php endif; ?>
                </div>

                <!-- Specifications -->
                <?php if ( ! empty( $specs ) ) : ?>
                <div class="bg-[#e7ebf3] dark:bg-background-dark/50 p-8 rounded mb-8">
                    <h3 class="text-lg font-black uppercase tracking-tight mb-6">Spesifikasi Produk</h3>
                    <div class="space-y-4">
                        <?php foreach ( $specs as $spec ) : ?>
                        <div class="flex justify-between items-center border-b border-gray-300 dark:border-white/10 pb-3">
                            <span class="text-gray-600 dark:text-gray-400 font-bold text-sm uppercase"><?php echo esc_html( $spec['label'] ); ?></span>
                            <span class="font-bold text-sm"><?php echo esc_html( $spec['value'] ); ?></span>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php endif; ?>

                <!-- Description -->
                <div class="mb-8">
                    <h3 class="text-lg font-black uppercase tracking-tight mb-4">Deskripsi</h3>
                    <div class="text-gray-700 dark:text-gray-300 leading-relaxed prose">
                        <?php the_content(); ?>
                    </div>
                </div>

                <!-- Benefits -->
                <?php if ( ! empty( $benefits ) ) : ?>
                <div class="mb-8">
                    <h3 class="text-lg font-black uppercase tracking-tight mb-4">Keunggulan</h3>
                    <ul class="space-y-3">
                        <?php foreach ( $benefits as $benefit ) : ?>
                        <li class="flex items-start gap-3">
                            <span class="material-symbols-outlined text-primary text-lg mt-0.5">check_circle</span>
                            <span class="text-gray-700 dark:text-gray-300"><?php echo esc_html( $benefit ); ?></span>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <?php endif; ?>

                <!-- CTA Buttons -->
                <div class="flex flex-col sm:flex-row gap-4">
                    <a href="<?php echo esc_url( sumberkayu_phone_url() ); ?>" class="bg-primary hover:bg-blue-700 text-white px-8 py-4 rounded font-bold text-base transition-colors flex items-center justify-center gap-2" data-tracking="phone-call">
                        <span class="material-symbols-outlined">call</span>
                        Hubungi: <?php echo esc_html( SUMBERKAYU_PHONE_DISPLAY ); ?>
                    </a>
                    <a href="<?php echo esc_url( sumberkayu_whatsapp_url( 'Halo, saya tertarik dengan ' . get_the_title() ) ); ?>" target="_blank" rel="noopener" class="bg-green-600 hover:bg-green-700 text-white px-8 py-4 rounded font-bold text-base transition-colors flex items-center justify-center gap-2" data-tracking="whatsapp-click">
                        <span class="material-symbols-outlined">chat</span>
                        Chat WhatsApp
                    </a>
                </div>

                <!-- Link to price page -->
                <div class="mt-6 p-4 bg-blue-50 dark:bg-blue-900/20 rounded">
                    <p class="text-sm text-gray-700 dark:text-gray-300">
                        Lihat juga: <a href="<?php echo esc_url( home_url( '/harga-kayu/' ) ); ?>" class="text-primary font-bold hover:underline">Daftar Harga Kayu Terbaru</a>
                    </p>
                </div>
            </div>
        </div>

        <!-- Related Products -->
        <div class="mt-20 pt-12 border-t border-[#e7ebf3] dark:border-white/10">
            <h2 class="text-3xl font-black mb-8">Produk Lainnya</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <?php
                $related = new WP_Query( array(
                    'post_type'      => 'product',
                    'posts_per_page' => 4,
                    'post__not_in'   => array( get_the_ID() ),
                    'orderby'        => 'rand',
                ) );
                while ( $related->have_posts() ) : $related->the_post();
                    $rel_image = get_post_meta( get_the_ID(), '_product_image_path', true );
                    $rel_img_url = $rel_image ? SUMBERKAYU_URI . '/' . $rel_image : SUMBERKAYU_URI . '/assets/images/placeholder.webp';
                ?>
                <a href="<?php the_permalink(); ?>" class="group bg-white dark:bg-background-dark rounded shadow-md overflow-hidden hover:shadow-xl transition-shadow block">
                    <div class="relative h-48 bg-gray-200 overflow-hidden">
                        <img src="<?php echo esc_url( $rel_img_url ); ?>" alt="<?php the_title_attribute(); ?>" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300" loading="lazy" />
                    </div>
                    <div class="p-4">
                        <h3 class="text-lg font-black"><?php the_title(); ?></h3>
                    </div>
                </a>
                <?php endwhile; wp_reset_postdata(); ?>
            </div>
        </div>
    </div>
</section>

<!-- FAQ Section -->
<section class="bg-[#e7ebf3] dark:bg-background-dark/50 py-16">
    <div class="max-w-[1280px] mx-auto px-6 lg:px-20">
        <h2 class="text-3xl font-black mb-12 text-center">Pertanyaan Umum</h2>
        <div class="max-w-3xl mx-auto space-y-6">
            <details class="bg-white dark:bg-background-dark p-6 rounded cursor-pointer group">
                <summary class="flex items-center justify-between font-bold text-lg">
                    Berapa harga per unit?
                    <span class="material-symbols-outlined group-open:rotate-180 transition-transform">expand_more</span>
                </summary>
                <p class="mt-4 text-gray-700 dark:text-gray-300">Harga bervariasi tergantung spesifikasi, volume pemesanan, dan kondisi pasar. Hubungi tim sales kami untuk penawaran terbaik.</p>
            </details>
            <details class="bg-white dark:bg-background-dark p-6 rounded cursor-pointer group">
                <summary class="flex items-center justify-between font-bold text-lg">
                    Apakah ada minimum order?
                    <span class="material-symbols-outlined group-open:rotate-180 transition-transform">expand_more</span>
                </summary>
                <p class="mt-4 text-gray-700 dark:text-gray-300">Kami melayani pemesanan mulai dari volume kecil hingga besar. Hubungi kami untuk diskusi kebutuhan spesifik Anda.</p>
            </details>
            <details class="bg-white dark:bg-background-dark p-6 rounded cursor-pointer group">
                <summary class="flex items-center justify-between font-bold text-lg">
                    Berapa lama pengiriman?
                    <span class="material-symbols-outlined group-open:rotate-180 transition-transform">expand_more</span>
                </summary>
                <p class="mt-4 text-gray-700 dark:text-gray-300">Pengiriman tergantung lokasi dan volume. Untuk Jakarta dan sekitarnya, biasanya 1-3 hari kerja setelah pembayaran.</p>
            </details>
            <details class="bg-white dark:bg-background-dark p-6 rounded cursor-pointer group">
                <summary class="flex items-center justify-between font-bold text-lg">
                    Apakah bisa custom spesifikasi?
                    <span class="material-symbols-outlined group-open:rotate-180 transition-transform">expand_more</span>
                </summary>
                <p class="mt-4 text-gray-700 dark:text-gray-300">Tentu saja. Kami siap menyesuaikan dimensi dan spesifikasi sesuai kebutuhan proyek Anda.</p>
            </details>
        </div>
    </div>
</section>

<!-- Product Schema -->
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "Product",
    "name": "<?php echo esc_js( get_the_title() ); ?>",
    "description": "<?php echo esc_js( get_post_meta( get_the_ID(), '_seo_description', true ) ); ?>",
    "image": "<?php echo esc_url( $img_url ); ?>",
    "brand": {
        "@type": "Brand",
        "name": "PD Sumber Jaya"
    },
    "offers": {
        "@type": "Offer",
        "availability": "https://schema.org/InStock",
        "priceCurrency": "IDR",
        "seller": {
            "@type": "Organization",
            "name": "PD Sumber Jaya"
        }
    }
}
</script>

<!-- FAQ Schema -->
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "FAQPage",
    "mainEntity": [
        {
            "@type": "Question",
            "name": "Berapa harga per unit?",
            "acceptedAnswer": {
                "@type": "Answer",
                "text": "Harga bervariasi tergantung spesifikasi, volume pemesanan, dan kondisi pasar. Hubungi tim sales kami untuk penawaran terbaik."
            }
        },
        {
            "@type": "Question",
            "name": "Apakah ada minimum order?",
            "acceptedAnswer": {
                "@type": "Answer",
                "text": "Kami melayani pemesanan mulai dari volume kecil hingga besar. Hubungi kami untuk diskusi kebutuhan spesifik Anda."
            }
        },
        {
            "@type": "Question",
            "name": "Berapa lama pengiriman?",
            "acceptedAnswer": {
                "@type": "Answer",
                "text": "Pengiriman tergantung lokasi dan volume. Untuk Jakarta dan sekitarnya, biasanya 1-3 hari kerja setelah pembayaran."
            }
        },
        {
            "@type": "Question",
            "name": "Apakah bisa custom spesifikasi?",
            "acceptedAnswer": {
                "@type": "Answer",
                "text": "Tentu saja. Kami siap menyesuaikan dimensi dan spesifikasi sesuai kebutuhan proyek Anda."
            }
        }
    ]
}
</script>

<?php get_footer(); ?>
