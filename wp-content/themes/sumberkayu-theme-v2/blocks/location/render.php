<?php
/**
 * Render template for the Location block
 */
?>
<section class="py-16 bg-white dark:bg-background-dark" <?php echo get_block_wrapper_attributes(); ?>>
    <div class="max-w-[1280px] mx-auto px-6 lg:px-20">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            
            <div class="contact-details">
                <span class="bg-primary px-3 py-1 text-xs font-black text-white uppercase tracking-widest mb-6 inline-block">Kunjungi Kami</span>
                <h2 class="text-4xl md:text-5xl font-black text-[#0e121b] dark:text-white mb-6 tracking-tight">Gudang & Kantor</h2>
                <p class="text-gray-600 dark:text-gray-400 text-lg mb-8 leading-relaxed">
                    Kami undang Anda untuk datang langsung ke gudang kami melihat kualitas kayu yang kami sediakan untuk proyek Anda.
                </p>
                
                <ul class="space-y-6">
                    <li class="flex items-start gap-4">
                        <div class="w-12 h-12 bg-primary/10 rounded-full flex items-center justify-center shrink-0">
                            <span class="material-symbols-outlined text-primary">location_on</span>
                        </div>
                        <div>
                            <h4 class="font-bold text-[#0e121b] dark:text-white">Alamat Gudang</h4>
                            <p class="text-gray-600 dark:text-gray-400 mt-1"><?php echo esc_html(SUMBERKAYU_ADDRESS); ?></p>
                        </div>
                    </li>
                    <li class="flex items-start gap-4">
                        <div class="w-12 h-12 bg-primary/10 rounded-full flex items-center justify-center shrink-0">
                            <span class="material-symbols-outlined text-primary">phone_in_talk</span>
                        </div>
                        <div>
                            <h4 class="font-bold text-[#0e121b] dark:text-white">Hubungi Kami</h4>
                            <p class="text-gray-600 dark:text-gray-400 mt-1"><?php echo esc_html(SUMBERKAYU_PHONE_DISPLAY); ?></p>
                        </div>
                    </li>
                    <li class="flex items-start gap-4">
                        <div class="w-12 h-12 bg-primary/10 rounded-full flex items-center justify-center shrink-0">
                            <span class="material-symbols-outlined text-primary">mail</span>
                        </div>
                        <div>
                            <h4 class="font-bold text-[#0e121b] dark:text-white">Email</h4>
                            <p class="text-gray-600 dark:text-gray-400 mt-1"><?php echo esc_html(SUMBERKAYU_EMAIL); ?></p>
                        </div>
                    </li>
                </ul>

                <div class="mt-8">
                    <a href="<?php echo esc_url(SUMBERKAYU_MAPS_URL); ?>" target="_blank" rel="noopener" class="inline-flex bg-primary hover:bg-blue-700 text-white items-center gap-3 px-8 py-4 rounded font-bold transition-all">
                        <span class="material-symbols-outlined">directions</span>
                        <span>Buka di Google Maps</span>
                    </a>
                </div>
            </div>

            <div class="map-embed h-[400px] lg:h-[500px] bg-gray-200 rounded-xl overflow-hidden shadow-lg border border-[#e7ebf3] dark:border-white/10">
                <iframe 
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15867.763426779344!2d106.9202157!3d-6.1387602!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6a152fb66a1bf9%3A0xcfd610b80dfbf309!2sPD.%20SUMBER%20JAYA%20KAYU%20BANGUNAN%20(Menjual%20Segala%20Macam%20Bahan%20Bangunan)!5e0!3m2!1sen!2sid!4v1700000000000!5m2!1sen!2sid" 
                    width="100%" 
                    height="100%" 
                    style="border:0;" 
                    allowfullscreen="" 
                    loading="lazy" 
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>

        </div>
    </div>
</section>
