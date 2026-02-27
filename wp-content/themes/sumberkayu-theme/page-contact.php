<?php
/**
 * Template Name: Kontak
 * Contact Page Template
 * @package sumberkayu
 */

get_header();
?>

<section class="bg-gradient-to-r from-primary to-blue-600 text-white py-12">
    <div class="max-w-[1280px] mx-auto px-6 lg:px-20">
        <h1 class="text-4xl md:text-5xl font-black mb-4"><?php echo esc_html( sumberkayu_get_h1() ); ?></h1>
        <p class="text-lg text-blue-100 max-w-2xl">Hubungi kami untuk konsultasi, pemesanan, atau kunjungan langsung ke gudang.</p>
    </div>
</section>

<section class="py-20">
    <div class="max-w-[1280px] mx-auto px-6 lg:px-20">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16">
            <!-- Contact Info -->
            <div>
                <h2 class="text-3xl font-black mb-8">Informasi Kontak</h2>
                <div class="space-y-8">
                    <div class="flex gap-4 items-start">
                        <div class="bg-primary/10 p-3 rounded-full flex-shrink-0">
                            <span class="material-symbols-outlined text-primary text-2xl">call</span>
                        </div>
                        <div>
                            <h3 class="font-black text-lg mb-1">Telepon</h3>
                            <a href="<?php echo esc_url( sumberkayu_phone_url() ); ?>" class="text-primary font-bold text-xl hover:underline" data-tracking="phone-call">
                                <?php echo esc_html( SUMBERKAYU_PHONE_DISPLAY ); ?>
                            </a>
                        </div>
                    </div>
                    <div class="flex gap-4 items-start">
                        <div class="bg-green-100 p-3 rounded-full flex-shrink-0">
                            <span class="material-symbols-outlined text-green-600 text-2xl">chat</span>
                        </div>
                        <div>
                            <h3 class="font-black text-lg mb-1">WhatsApp</h3>
                            <a href="<?php echo esc_url( sumberkayu_whatsapp_url( 'Halo, saya ingin bertanya tentang produk kayu' ) ); ?>" target="_blank" rel="noopener" class="text-green-600 font-bold text-xl hover:underline" data-tracking="whatsapp-click">
                                <?php echo esc_html( SUMBERKAYU_PHONE_DISPLAY ); ?>
                            </a>
                        </div>
                    </div>
                    <div class="flex gap-4 items-start">
                        <div class="bg-primary/10 p-3 rounded-full flex-shrink-0">
                            <span class="material-symbols-outlined text-primary text-2xl">mail</span>
                        </div>
                        <div>
                            <h3 class="font-black text-lg mb-1">Email</h3>
                            <a href="mailto:<?php echo esc_attr( SUMBERKAYU_EMAIL ); ?>" class="text-primary hover:underline">
                                <?php echo esc_html( SUMBERKAYU_EMAIL ); ?>
                            </a>
                        </div>
                    </div>
                    <div class="flex gap-4 items-start">
                        <div class="bg-primary/10 p-3 rounded-full flex-shrink-0">
                            <span class="material-symbols-outlined text-primary text-2xl">location_on</span>
                        </div>
                        <div>
                            <h3 class="font-black text-lg mb-1">Alamat Gudang</h3>
                            <p class="text-gray-600 dark:text-gray-400 leading-relaxed"><?php echo esc_html( SUMBERKAYU_ADDRESS ); ?></p>
                            <a href="<?php echo esc_url( SUMBERKAYU_MAPS_URL ); ?>" target="_blank" rel="noopener" class="text-primary font-bold text-sm hover:underline mt-2 inline-block">
                                Buka di Google Maps &rarr;
                            </a>
                        </div>
                    </div>
                    <div class="flex gap-4 items-start">
                        <div class="bg-primary/10 p-3 rounded-full flex-shrink-0">
                            <span class="material-symbols-outlined text-primary text-2xl">schedule</span>
                        </div>
                        <div>
                            <h3 class="font-black text-lg mb-1">Jam Operasional</h3>
                            <p class="text-gray-600 dark:text-gray-400">Senin - Sabtu: 08.00 - 22.00 WIB</p>
                            <p class="text-gray-600 dark:text-gray-400">Minggu: 09.00 - 22.00 WIB</p>
                            <p class="text-gray-600 dark:text-gray-400">Hari Libur: Tutup</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Google Maps Embed -->
            <div>
                <h2 class="text-3xl font-black mb-8">Lokasi Kami</h2>
                <div class="rounded overflow-hidden shadow-xl">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.3!2d106.9287!3d-6.1245!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2sPD+Sumber+Jaya!5e0!3m2!1sid!2sid!4v1"
                        width="100%"
                        height="450"
                        style="border:0;"
                        allowfullscreen=""
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"
                        title="Lokasi PD Sumber Jaya">
                    </iframe>
                </div>
            </div>
        </div>
    </div>
</section>

<?php get_template_part( 'template-parts/gudang-visit' ); ?>

<?php
get_template_part( 'template-parts/cta-block', null, array(
    'title'   => 'Siap Untuk Bermitra?',
    'message' => 'Hubungi kami sekarang untuk mendapatkan penawaran terbaik untuk proyek Anda.',
) );

get_footer();
?>
