<?php
/**
 * Template Name: Tentang Kami
 * About Page Template — converts about.html
 * @package sumberkayu
 */

get_header();
?>

<!-- Hero Section -->
<section class="bg-gradient-to-r from-primary to-blue-600 text-white py-16">
    <div class="max-w-[1280px] mx-auto px-6 lg:px-20">
        <h1 class="text-5xl md:text-6xl font-black mb-6"><?php echo esc_html( sumberkayu_get_h1() ); ?></h1>
        <p class="text-lg text-blue-100 max-w-3xl">Perjalanan kami selama lebih dari 30 tahun dalam menyediakan kayu berkualitas tinggi untuk membangun Indonesia.</p>
    </div>
</section>

<!-- Main Content -->
<section class="py-20">
    <div class="max-w-[1280px] mx-auto px-6 lg:px-20">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center mb-20">
            <div>
                <h2 class="text-4xl font-black mb-6 text-primary">Siapa Kami</h2>
                <p class="text-lg text-gray-700 dark:text-gray-300 mb-4 leading-relaxed">
                    PD Sumber Jaya adalah supplier kayu konstruksi terpercaya yang telah melayani industri Indonesia sejak tahun 1994. Dengan pengalaman lebih dari 30 tahun, kami telah membangun reputasi solid sebagai mitra andal bagi kontraktor, developer, dan manufaktur dalam menyediakan material kayu berkualitas tinggi.
                </p>
                <p class="text-lg text-gray-700 dark:text-gray-300 leading-relaxed">
                    Komitmen kami adalah memberikan solusi kayu konstruksi terbaik dengan harga kompetitif, kualitas terjamin, dan layanan profesional yang responsif terhadap kebutuhan klien.
                </p>
            </div>
            <div class="bg-gray-300 dark:bg-gray-600 rounded overflow-hidden aspect-video">
                <img src="<?php echo esc_url( SUMBERKAYU_URI . '/assets/images/warehouse.webp' ); ?>" alt="Warehouse PD Sumber Jaya" class="w-full h-full object-cover" loading="lazy" />
            </div>
        </div>

        <!-- Visi & Misi -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12 mb-20">
            <div class="bg-white dark:bg-background-dark p-8 rounded shadow-md border-l-4 border-primary">
                <h3 class="text-2xl font-black mb-4 flex items-center gap-3">
                    <span class="material-symbols-outlined text-primary text-4xl">visibility</span> Visi
                </h3>
                <p class="text-gray-700 dark:text-gray-300 leading-relaxed">Menjadi supplier kayu konstruksi pilihan utama di Indonesia yang dikenal karena kualitas terbaik, layanan profesional, dan inovasi berkelanjutan dalam memenuhi kebutuhan industri konstruksi modern.</p>
            </div>
            <div class="bg-white dark:bg-background-dark p-8 rounded shadow-md border-l-4 border-primary">
                <h3 class="text-2xl font-black mb-4 flex items-center gap-3">
                    <span class="material-symbols-outlined text-primary text-4xl">target</span> Misi
                </h3>
                <p class="text-gray-700 dark:text-gray-300 leading-relaxed">Menyediakan material kayu berkualitas tinggi dengan stok stabil, harga kompetitif, dan layanan profesional untuk mendukung kesuksesan proyek konstruksi di seluruh Indonesia dengan komitmen pada kepuasan pelanggan.</p>
            </div>
        </div>

        <!-- Core Values -->
        <div class="mb-20">
            <h2 class="text-4xl font-black mb-12 text-center">Nilai-Nilai Inti Kami</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <?php
                $values = array(
                    array( 'icon' => 'verified_user', 'title' => 'Integritas', 'text' => 'Kejujuran dan transparansi dalam setiap transaksi bisnis' ),
                    array( 'icon' => 'grade', 'title' => 'Kualitas', 'text' => 'Standar kualitas tertinggi untuk setiap produk' ),
                    array( 'icon' => 'handshake', 'title' => 'Kemitraan', 'text' => 'Hubungan jangka panjang yang saling menguntungkan' ),
                    array( 'icon' => 'trending_up', 'title' => 'Inovasi', 'text' => 'Terus berkembang mengikuti perkembangan industri' ),
                );
                foreach ( $values as $val ) :
                ?>
                <div class="text-center p-6 bg-white dark:bg-background-dark rounded shadow-md hover:shadow-lg transition-shadow">
                    <div class="bg-primary/10 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <span class="material-symbols-outlined text-primary text-4xl"><?php echo esc_html( $val['icon'] ); ?></span>
                    </div>
                    <h3 class="text-xl font-bold mb-3"><?php echo esc_html( $val['title'] ); ?></h3>
                    <p class="text-gray-600 dark:text-gray-400"><?php echo esc_html( $val['text'] ); ?></p>
                </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Key Highlights -->
        <div class="bg-gradient-to-r from-primary/5 to-blue-600/5 dark:from-primary/10 dark:to-blue-600/10 p-12 rounded">
            <h2 class="text-3xl font-black mb-12 text-center">Keunggulan Kami</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <?php
                $highlights = array(
                    array( 'title' => 'Pengalaman 30+ Tahun', 'text' => 'Track record panjang melayani proyek konstruksi besar di Indonesia' ),
                    array( 'title' => 'Stok Melimpah', 'text' => 'Gudang modern dengan kapasitas besar siap melayani order volume tinggi' ),
                    array( 'title' => 'Kualitas Terjamin', 'text' => 'Setiap produk melalui proses seleksi ketat sesuai standar konstruksi' ),
                    array( 'title' => 'Harga Kompetitif', 'text' => 'Penawaran terbaik tanpa mengorbankan kualitas produk' ),
                    array( 'title' => 'Pengiriman Cepat', 'text' => 'Sistem logistik efisien untuk pengiriman tepat waktu' ),
                    array( 'title' => 'Layanan Profesional', 'text' => 'Tim dedicated siap membantu konsultasi dan penawaran khusus' ),
                );
                foreach ( $highlights as $h ) :
                ?>
                <div class="flex gap-4">
                    <div class="flex-shrink-0">
                        <span class="material-symbols-outlined text-primary text-3xl">check_circle</span>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold mb-2"><?php echo esc_html( $h['title'] ); ?></h3>
                        <p class="text-gray-600 dark:text-gray-400"><?php echo esc_html( $h['text'] ); ?></p>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>

<?php
get_template_part( 'template-parts/cta-block', null, array(
    'title'   => 'Ingin Berkerja Sama?',
    'message' => 'Hubungi kami untuk mendapatkan penawaran terbaik dan solusi material kayu untuk proyek Anda.',
) );

get_footer();
?>
