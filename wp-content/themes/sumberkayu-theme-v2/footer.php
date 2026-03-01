<?php
/**
 * Footer Template
 * @package sumberkayu
 */
?>

<!-- Floating Mobile Menu Button -->
<div class="block md:hidden">
    <button id="floating-menu-btn" aria-label="Menu" class="fixed left-4 bottom-4 z-50 bg-primary text-white p-4 rounded-full shadow-lg">
        <span class="material-symbols-outlined">menu</span>
    </button>
    <div id="floating-menu" class="hidden fixed left-4 bottom-20 z-50 bg-white dark:bg-background-dark rounded-lg shadow-lg w-56 p-4">
        <ul class="space-y-3">
            <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="font-bold <?php echo is_front_page() ? 'text-primary' : ''; ?>">Home</a></li>
            <li><a href="<?php echo esc_url( get_post_type_archive_link( 'product' ) ); ?>" class="font-bold <?php echo ( is_post_type_archive( 'product' ) || is_singular( 'product' ) ) ? 'text-primary' : ''; ?>">Produk Kayu</a></li>
            <li><a href="<?php echo esc_url( home_url( '/about/' ) ); ?>" class="font-bold <?php echo is_page( array( 'about', 'tentang-kami' ) ) ? 'text-primary' : ''; ?>">Tentang Kami</a></li>
            <li><a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="font-bold <?php echo is_page( array( 'contact', 'kontak' ) ) ? 'text-primary' : ''; ?>">Kontak</a></li>
            <li><a href="<?php echo esc_url( home_url( '/galeri/' ) ); ?>" class="font-bold <?php echo is_page( array( 'gallery', 'galeri' ) ) ? 'text-primary' : ''; ?>">Gallery</a></li>
            <li><a href="<?php echo esc_url( get_post_type_archive_link( 'project' ) ); ?>" class="font-bold <?php echo ( is_post_type_archive( 'project' ) || is_singular( 'project' ) ) ? 'text-primary' : ''; ?>">Projects</a></li>
        </ul>
    </div>
</div>

<?php get_template_part( 'template-parts/sticky-buttons' ); ?>

<!-- Footer -->
<footer class="bg-timber-dark text-white py-16">
    <div class="max-w-[1280px] mx-auto px-6 lg:px-20">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 pb-12 border-b border-white/10">
            <div class="col-span-1 lg:col-span-1">
                <div class="flex items-center gap-3 mb-6">
                    <img src="<?php echo esc_url( SUMBERKAYU_URI . '/assets/images/Logo.png' ); ?>" alt="<?php bloginfo( 'name' ); ?>" class="h-8" />
                    <h2 class="text-white text-xl font-black uppercase tracking-tighter">PD Sumber Jaya</h2>
                </div>
                <p class="text-gray-400 text-sm leading-relaxed">
                    Supplier utama kayu konstruksi sejak 1994. Melayani kebutuhan material kayu partai besar untuk proyek infrastruktur dan properti.
                </p>
            </div>
            <div>
                <h4 class="text-xs font-black uppercase tracking-widest mb-6 text-primary">Tautan Cepat</h4>
                <ul class="space-y-4 text-sm font-medium">
                    <li><a class="<?php echo is_front_page() ? 'text-primary' : 'hover:text-primary'; ?> transition-colors" href="<?php echo esc_url( home_url( '/' ) ); ?>">Beranda</a></li>
                    <li><a class="<?php echo ( is_post_type_archive( 'product' ) || is_singular( 'product' ) ) ? 'text-primary' : 'hover:text-primary'; ?> transition-colors" href="<?php echo esc_url( get_post_type_archive_link( 'product' ) ); ?>">Produk Kayu</a></li>
                    <li><a class="<?php echo is_page( array( 'about', 'tentang-kami' ) ) ? 'text-primary' : 'hover:text-primary'; ?> transition-colors" href="<?php echo esc_url( home_url( '/about/' ) ); ?>">Tentang Kami</a></li>
                    <li><a class="<?php echo is_page( array( 'contact', 'kontak' ) ) ? 'text-primary' : 'hover:text-primary'; ?> transition-colors" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">Kontak</a></li>
                    <li><a class="<?php echo is_page( array( 'gallery', 'galeri' ) ) ? 'text-primary' : 'hover:text-primary'; ?> transition-colors" href="<?php echo esc_url( home_url( '/galeri/' ) ); ?>">Gallery</a></li>
                    <li><a class="<?php echo ( is_post_type_archive( 'project' ) || is_singular( 'project' ) ) ? 'text-primary' : 'hover:text-primary'; ?> transition-colors" href="<?php echo esc_url( get_post_type_archive_link( 'project' ) ); ?>">Projects</a></li>
                    <li><a class="<?php echo is_page( array( 'harga-kayu', 'harga-kayu-jakarta-utara' ) ) ? 'text-primary' : 'hover:text-primary'; ?> transition-colors" href="<?php echo esc_url( home_url( '/harga-kayu/' ) ); ?>">Harga Kayu</a></li>
                </ul>
            </div>
            <div>
                <h4 class="text-xs font-black uppercase tracking-widest mb-6 text-primary">Kontak B2B</h4>
                <ul class="space-y-4 text-sm">
                    <li class="flex items-center gap-3">
                        <span class="material-symbols-outlined text-sm">phone_in_talk</span>
                        <a href="<?php echo esc_url( sumberkayu_phone_url() ); ?>" class="font-bold"><?php echo esc_html( SUMBERKAYU_PHONE_DISPLAY ); ?></a>
                    </li>
                    <li class="flex items-center gap-3">
                        <span class="material-symbols-outlined text-sm">mail</span>
                        <span><?php echo esc_html( SUMBERKAYU_EMAIL ); ?></span>
                    </li>
                    <li class="flex items-center gap-3">
                        <span class="material-symbols-outlined text-sm">chat</span>
                        <a href="<?php echo esc_url( sumberkayu_whatsapp_url() ); ?>" target="_blank" rel="noopener" class="font-bold">WhatsApp</a>
                    </li>
                </ul>
            </div>
            <div>
                <h4 class="text-xs font-black uppercase tracking-widest mb-6 text-primary">Alamat Gudang</h4>
                <p class="text-sm text-gray-400 leading-relaxed">
                    <?php echo esc_html( SUMBERKAYU_ADDRESS ); ?>
                </p>
            </div>
        </div>
        <div class="flex flex-col md:flex-row justify-between items-center pt-8 gap-4">
            <p class="text-gray-500 text-xs font-bold uppercase tracking-widest">
                &copy; <?php echo date( 'Y' ); ?> PD Sumber Jaya. All Rights Reserved.
            </p>
        </div>
    </div>
</footer>

<?php get_template_part( 'template-parts/schema-localbusiness' ); ?>

<?php wp_footer(); ?>
</body>
</html>
