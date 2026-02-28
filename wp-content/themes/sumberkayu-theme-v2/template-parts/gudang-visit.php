<?php
/**
 * Gudang Visit Section
 * @package sumberkayu
 */
?>
<section class="py-20 bg-background-light dark:bg-background-dark/30">
    <div class="max-w-[1280px] mx-auto px-6 lg:px-20">
        <div class="flex flex-col lg:flex-row gap-12 items-stretch">
            <div class="lg:w-1/2 min-h-[400px] relative overflow-hidden rounded shadow-xl">
                <img alt="Warehouse gate entrance" class="w-full h-full object-cover" loading="lazy" src="<?php echo esc_url( SUMBERKAYU_URI . '/assets/images/warehouse.webp' ); ?>" />
                <div class="absolute top-6 left-6 bg-primary text-white px-4 py-2 font-black text-sm uppercase">Warehouse Utama</div>
            </div>
            <div class="lg:w-1/2 flex flex-col justify-center">
                <h2 class="text-primary text-sm font-black uppercase tracking-[0.2em] mb-4">Lokasi Strategis</h2>
                <h3 class="text-[#0e121b] dark:text-white text-4xl font-black mb-8 leading-tight">Kunjungi Fasilitas Gudang Kami</h3>
                <div class="space-y-8">
                    <div class="flex gap-4">
                        <span class="material-symbols-outlined text-primary text-3xl">location_on</span>
                        <div>
                            <p class="font-black text-lg text-[#0e121b] dark:text-white uppercase tracking-tight">Alamat Lengkap</p>
                            <p class="text-gray-600 dark:text-gray-400 mt-1 leading-relaxed"><?php echo esc_html( SUMBERKAYU_ADDRESS ); ?></p>
                        </div>
                    </div>
                    <div class="flex gap-4">
                        <span class="material-symbols-outlined text-primary text-3xl">schedule</span>
                        <div>
                            <p class="font-black text-lg text-[#0e121b] dark:text-white uppercase tracking-tight">Jam Operasional</p>
                            <p class="text-gray-600 dark:text-gray-400 mt-1">
                                Senin - Sabtu: 08.00 - 22.00 WIB<br />
                                Minggu: 09.00 - 22.00 WIB<br />
                                Hari Libur: Tutup
                            </p>
                        </div>
                    </div>
                    <div class="pt-4 h-48 w-full bg-gray-300 relative rounded overflow-hidden">
                        <div class="absolute inset-0 bg-cover bg-center" style="background-image: url(<?php echo esc_url( SUMBERKAYU_URI . '/assets/images/maps.webp' ); ?>)">
                            <div class="absolute inset-0 bg-primary/10 flex items-center justify-center">
                                <div class="bg-white p-3 rounded shadow-lg flex items-center gap-2">
                                    <span class="material-symbols-outlined text-primary">pin_drop</span>
                                    <a class="text-xs font-bold text-gray-800" href="<?php echo esc_url( SUMBERKAYU_MAPS_URL ); ?>" target="_blank" rel="noopener">Buka di Google Maps</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
