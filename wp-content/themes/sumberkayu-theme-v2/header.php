<?php
/**
 * Header Template
 * @package sumberkayu
 */
?><!doctype html>
<html <?php language_attributes(); ?> class="light">
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="<?php echo esc_attr( sumberkayu_get_meta_description() ); ?>" />
    <meta name="robots" content="index, follow" />

    <?php if ( is_singular() ) : ?>
    <!-- Open Graph -->
    <meta property="og:title" content="<?php echo esc_attr( get_post_meta( get_the_ID(), '_seo_title', true ) ?: get_the_title() ); ?>" />
    <meta property="og:description" content="<?php echo esc_attr( sumberkayu_get_meta_description() ); ?>" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="<?php the_permalink(); ?>" />
    <?php if ( has_post_thumbnail() ) : ?>
    <meta property="og:image" content="<?php echo esc_url( get_the_post_thumbnail_url( null, 'large' ) ); ?>" />
    <?php endif; ?>
    <meta name="twitter:card" content="summary_large_image" />
    <link rel="canonical" href="<?php the_permalink(); ?>" />
    <?php endif; ?>

    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo esc_attr( SUMBERKAYU_GA_ID ); ?>"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', '<?php echo esc_js( SUMBERKAYU_GA_ID ); ?>');
        gtag('config', '<?php echo esc_js( SUMBERKAYU_ADS_ID ); ?>');
    </script>

    <!-- Google Tag Manager -->
    <script>
        (function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
        new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
        j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
        'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','<?php echo esc_js( SUMBERKAYU_GTM_ID ); ?>');
    </script>

    <style>
        body { font-family: "Inter", sans-serif; }
        .material-symbols-outlined {
            font-variation-settings: "FILL" 0, "wght" 400, "GRAD" 0, "opsz" 24;
        }
    </style>

    <?php wp_head(); ?>
</head>
<body <?php body_class( 'bg-background-light dark:bg-background-dark text-[#0e121b] dark:text-white transition-colors duration-200' ); ?>>
<?php wp_body_open(); ?>

<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=<?php echo esc_attr( SUMBERKAYU_GTM_ID ); ?>"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>

<!-- Phone Bar (Above the Fold) -->
<div class="bg-primary text-white text-center py-2 text-sm font-bold">
    <a href="<?php echo esc_url( sumberkayu_phone_url() ); ?>" class="inline-flex items-center gap-2 hover:underline tracking-wider">
        <span class="material-symbols-outlined text-sm">call</span>
        Hubungi Kami: <?php echo esc_html( SUMBERKAYU_PHONE_DISPLAY ); ?>
    </a>
</div>

<!-- Navigation -->
<header class="sticky top-0 z-50 w-full bg-white dark:bg-background-dark border-b border-solid border-[#e7ebf3] dark:border-white/10 px-6 lg:px-20">
    <div class="max-w-[1280px] mx-auto flex items-center justify-between h-20">
        <div class="flex items-center gap-3">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
                <img src="<?php echo esc_url( SUMBERKAYU_URI . '/assets/images/Logo-with-text.png' ); ?>" alt="<?php bloginfo( 'name' ); ?>" class="h-10" />
            </a>
        </div>
        <nav class="hidden md:flex items-center gap-10">
            <a class="text-sm font-bold uppercase tracking-wider <?php echo is_front_page() ? 'text-primary' : 'text-gray-700 dark:text-gray-300 hover:text-primary'; ?> transition-colors" href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a>
            <a class="text-sm font-bold uppercase tracking-wider <?php echo ( is_post_type_archive( 'product' ) || is_singular( 'product' ) ) ? 'text-primary' : 'text-gray-700 dark:text-gray-300 hover:text-primary'; ?> transition-colors" href="<?php echo esc_url( get_post_type_archive_link( 'product' ) ); ?>">Produk Kayu</a>
            <a class="text-sm font-bold uppercase tracking-wider <?php echo is_page( array( 'about', 'tentang-kami' ) ) ? 'text-primary' : 'text-gray-700 dark:text-gray-300 hover:text-primary'; ?> transition-colors" href="<?php echo esc_url( home_url( '/tentang-kami/' ) ); ?>">Tentang Kami</a>
            <a class="text-sm font-bold uppercase tracking-wider <?php echo is_page( array( 'contact', 'kontak' ) ) ? 'text-primary' : 'text-gray-700 dark:text-gray-300 hover:text-primary'; ?> transition-colors" href="<?php echo esc_url( home_url( '/kontak/' ) ); ?>">Kontak</a>
            <a class="text-sm font-bold uppercase tracking-wider <?php echo is_page( array( 'gallery', 'galeri' ) ) ? 'text-primary' : 'text-gray-700 dark:text-gray-300 hover:text-primary'; ?> transition-colors" href="<?php echo esc_url( home_url( '/galeri/' ) ); ?>">Gallery</a>
            <a class="text-sm font-bold uppercase tracking-wider <?php echo ( is_post_type_archive( 'project' ) || is_singular( 'project' ) ) ? 'text-primary' : 'text-gray-700 dark:text-gray-300 hover:text-primary'; ?> transition-colors" href="<?php echo esc_url( get_post_type_archive_link( 'project' ) ); ?>">Projects</a>
        </nav>
        <a href="<?php echo esc_url( sumberkayu_whatsapp_url() ); ?>" target="_blank" rel="noopener" class="hidden sm:inline-block bg-primary text-white px-6 py-3 rounded text-sm font-bold uppercase tracking-widest hover:bg-blue-700 transition-all">
            Hubungi Kami
        </a>
    </div>
</header>

<?php sumberkayu_breadcrumbs(); ?>
