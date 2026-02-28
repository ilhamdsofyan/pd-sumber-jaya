<?php
/**
 * CTA Block — Reusable
 * Usage: get_template_part( 'template-parts/cta-block' );
 * @package sumberkayu
 */

$cta_title   = $args['title'] ?? 'Butuh Konsultasi Produk?';
$cta_message = $args['message'] ?? 'Tim profesional kami siap membantu Anda memilih kayu yang tepat untuk proyek Anda.';
$wa_text     = $args['wa_text'] ?? 'Halo, saya ingin berkonsultasi tentang produk kayu';
?>
<section class="bg-primary text-white py-16">
    <div class="max-w-[1280px] mx-auto px-6 lg:px-20 text-center">
        <h2 class="text-4xl font-black mb-6"><?php echo esc_html( $cta_title ); ?></h2>
        <p class="text-lg text-blue-100 mb-8 max-w-2xl mx-auto"><?php echo esc_html( $cta_message ); ?></p>
        <div class="flex flex-wrap justify-center gap-4">
            <a href="<?php echo esc_url( sumberkayu_whatsapp_url( $wa_text ) ); ?>" target="_blank" rel="noopener"
               class="bg-white text-primary px-8 py-4 rounded font-bold text-lg hover:bg-gray-100 transition-colors inline-flex items-center gap-3" data-tracking="whatsapp-click">
                <span class="material-symbols-outlined">chat</span>
                Hubungi via WhatsApp
            </a>
            <a href="<?php echo esc_url( sumberkayu_phone_url() ); ?>"
               class="bg-white/20 text-white border-2 border-white px-8 py-4 rounded font-bold text-lg hover:bg-white/30 transition-colors inline-flex items-center gap-3" data-tracking="phone-call">
                <span class="material-symbols-outlined">call</span>
                <?php echo esc_html( SUMBERKAYU_PHONE_DISPLAY ); ?>
            </a>
        </div>
    </div>
</section>
