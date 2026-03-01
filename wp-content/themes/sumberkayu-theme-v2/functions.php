<?php
/**
 * Sumberkayu Theme — functions.php
 * PD Sumber Jaya — B2B Timber Supplier
 *
 * @package sumberkayu
 */

if ( ! defined( 'ABSPATH' ) ) exit;

define( 'SUMBERKAYU_VERSION', '1.0.0' );
define( 'SUMBERKAYU_DIR', get_template_directory() );
define( 'SUMBERKAYU_URI', get_template_directory_uri() );

// Business constants
define( 'SUMBERKAYU_PHONE', '085218776287' );
define( 'SUMBERKAYU_PHONE_DISPLAY', '0852-1877-6287' );
define( 'SUMBERKAYU_WHATSAPP', '6285218776287' );
define( 'SUMBERKAYU_EMAIL', 'pdsumberjayakayubangunan@gmail.com' );
define( 'SUMBERKAYU_ADDRESS', 'Depan SMPN 53 Jakarta, Jl. Kalibaru Barat No.44, RT.5/RW.12, Kali Baru, Kec. Cilincing, Jkt Utara, Daerah Khusus Ibukota Jakarta 14110' );
define( 'SUMBERKAYU_MAPS_URL', 'https://maps.app.goo.gl/LHVmV9LXnvjmDz5y6' );
define( 'SUMBERKAYU_GA_ID', 'G-NP9RE39J6V' );
define( 'SUMBERKAYU_ADS_ID', 'AW-17942288929' );
define( 'SUMBERKAYU_GTM_ID', 'GTM-WZN4JCZT' );

// Include V2 architecture hooks
require_once SUMBERKAYU_DIR . '/inc/custom-post-types.php';
require_once SUMBERKAYU_DIR . '/inc/schema-inject.php';
require_once SUMBERKAYU_DIR . '/inc/block-registry.php';

/**
 * Theme Setup
 */
function sumberkayu_setup() {
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' ) );
    add_theme_support( 'custom-logo', array(
        'height'      => 40,
        'width'       => 200,
        'flex-height' => true,
        'flex-width'  => true,
    ) );

    register_nav_menus( array(
        'primary' => __( 'Primary Menu', 'sumberkayu' ),
        'mobile'  => __( 'Mobile Menu', 'sumberkayu' ),
        'footer'  => __( 'Footer Menu', 'sumberkayu' ),
    ) );

    // Image sizes for products
    add_image_size( 'product-card', 400, 500, true );
    add_image_size( 'product-detail', 800, 800, true );
    add_image_size( 'hero-bg', 1920, 1080, true );
}
add_action( 'after_setup_theme', 'sumberkayu_setup' );

/**
 * Enqueue Scripts & Styles
 */
function sumberkayu_scripts() {
    // Main Tailwind CSS
    wp_enqueue_style( 'sumberkayu-styles', SUMBERKAYU_URI . '/assets/css/styles.css', array(), SUMBERKAYU_VERSION );

    // Google Fonts
    wp_enqueue_style( 'google-fonts-inter', 'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700;900&display=swap', array(), null );
    wp_enqueue_style( 'material-symbols', 'https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap', array(), null );

    // Main JS
    wp_enqueue_script( 'sumberkayu-ui', SUMBERKAYU_URI . '/assets/js/ui.js', array(), SUMBERKAYU_VERSION, true );

    // WhatsApp/Phone click tracking
    wp_enqueue_script( 'sumberkayu-tracking', SUMBERKAYU_URI . '/assets/js/tracking.js', array(), SUMBERKAYU_VERSION, true );

    // Remove dashicons from frontend for non-admin
    if ( ! is_admin_bar_showing() ) {
        wp_dequeue_style( 'dashicons' );
    }
}
add_action( 'wp_enqueue_scripts', 'sumberkayu_scripts' );

/**
 * Remove unnecessary WP head items for performance
 */
function sumberkayu_cleanup_head() {
    remove_action( 'wp_head', 'wp_generator' );
    remove_action( 'wp_head', 'wlwmanifest_link' );
    remove_action( 'wp_head', 'rsd_link' );
    remove_action( 'wp_head', 'wp_shortlink_wp_head' );
    remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
    remove_action( 'wp_print_styles', 'print_emoji_styles' );
}
add_action( 'init', 'sumberkayu_cleanup_head' );

/**
 * Add async/defer to scripts for performance
 */
function sumberkayu_script_loader_tag( $tag, $handle, $src ) {
    $async_scripts = array( 'google-gtag', 'google-gtm' );
    if ( in_array( $handle, $async_scripts ) ) {
        return str_replace( ' src', ' async src', $tag );
    }
    $defer_scripts = array( 'sumberkayu-ui', 'sumberkayu-tracking' );
    if ( in_array( $handle, $defer_scripts ) ) {
        return str_replace( ' src', ' defer src', $tag );
    }
    return $tag;
}
add_filter( 'script_loader_tag', 'sumberkayu_script_loader_tag', 10, 3 );

/**
 * Allow WebP uploads
 */
function sumberkayu_mime_types( $mimes ) {
    $mimes['webp'] = 'image/webp';
    return $mimes;
}
add_filter( 'upload_mimes', 'sumberkayu_mime_types' );

/**
 * Preconnect to external resources
 */
function sumberkayu_resource_hints( $urls, $relation_type ) {
    if ( 'preconnect' === $relation_type ) {
        $urls[] = array(
            'href' => 'https://fonts.googleapis.com',
            'crossorigin' => 'anonymous',
        );
        $urls[] = array(
            'href' => 'https://fonts.gstatic.com',
            'crossorigin' => 'anonymous',
        );
        $urls[] = array(
            'href' => 'https://www.googletagmanager.com',
        );
    }
    return $urls;
}
add_filter( 'wp_resource_hints', 'sumberkayu_resource_hints', 10, 2 );

/**
 * Custom Title Tag
 */
function sumberkayu_document_title( $title ) {
    if ( is_singular() ) {
        $custom_title = get_post_meta( get_the_ID(), '_seo_title', true );
        if ( $custom_title ) {
            return $custom_title;
        }
    }
    return $title;
}
add_filter( 'pre_get_document_title', 'sumberkayu_document_title' );

// ============================================================
// CUSTOM POST TYPES
// ============================================================

/**
 * Register Product CPT
 */
function sumberkayu_register_product_cpt() {
    $labels = array(
        'name'               => 'Produk',
        'singular_name'      => 'Produk',
        'add_new'            => 'Tambah Produk',
        'add_new_item'       => 'Tambah Produk Baru',
        'edit_item'          => 'Edit Produk',
        'new_item'           => 'Produk Baru',
        'view_item'          => 'Lihat Produk',
        'search_items'       => 'Cari Produk',
        'not_found'          => 'Produk tidak ditemukan',
        'not_found_in_trash' => 'Produk tidak ada di Trash',
        'menu_name'          => 'Produk Kayu',
    );

    register_post_type( 'product', array(
        'labels'        => $labels,
        'public'        => true,
        'has_archive'   => true,
        'rewrite'       => array( 'slug' => 'products', 'with_front' => false ),
        'supports'      => array( 'title', 'editor', 'thumbnail', 'custom-fields', 'excerpt' ),
        'menu_icon'     => 'dashicons-products',
        'show_in_rest'  => true,
        'taxonomies'    => array( 'jenis_kayu', 'kategori_harga' ),
    ) );
}
add_action( 'init', 'sumberkayu_register_product_cpt' );

/**
 * Register Project CPT
 */
function sumberkayu_register_project_cpt() {
    $labels = array(
        'name'               => 'Projects',
        'singular_name'      => 'Project',
        'add_new'            => 'Tambah Project',
        'add_new_item'       => 'Tambah Project Baru',
        'edit_item'          => 'Edit Project',
        'new_item'           => 'Project Baru',
        'view_item'          => 'Lihat Project',
        'search_items'       => 'Cari Project',
        'not_found'          => 'Project tidak ditemukan',
        'menu_name'          => 'Projects',
    );

    register_post_type( 'project', array(
        'labels'        => $labels,
        'public'        => true,
        'has_archive'   => true,
        'rewrite'       => array( 'slug' => 'projects', 'with_front' => false ),
        'supports'      => array( 'title', 'editor', 'thumbnail', 'custom-fields' ),
        'menu_icon'     => 'dashicons-portfolio',
        'show_in_rest'  => true,
    ) );
}
add_action( 'init', 'sumberkayu_register_project_cpt' );

// Registration removed for Gallery CPT. User manages gallery via WP Media native tools.

/**
 * Register Taxonomies
 */
function sumberkayu_register_taxonomies() {
    // Jenis Kayu
    register_taxonomy( 'jenis_kayu', 'product', array(
        'labels' => array(
            'name'          => 'Jenis Kayu',
            'singular_name' => 'Jenis Kayu',
            'add_new_item'  => 'Tambah Jenis Kayu',
        ),
        'public'       => true,
        'hierarchical' => true,
        'rewrite'      => array( 'slug' => 'jenis-kayu' ),
        'show_in_rest' => true,
    ) );

    // Kategori Harga
    register_taxonomy( 'kategori_harga', 'product', array(
        'labels' => array(
            'name'          => 'Kategori Harga',
            'singular_name' => 'Kategori Harga',
            'add_new_item'  => 'Tambah Kategori Harga',
        ),
        'public'       => true,
        'hierarchical' => true,
        'rewrite'      => array( 'slug' => 'kategori-harga' ),
        'show_in_rest' => true,
    ) );
}
add_action( 'init', 'sumberkayu_register_taxonomies' );

// ============================================================
// MEDIA LIBRARY SECIFICATIONS
// ============================================================

/**
 * Add Checkbox to Media Library Attachment Details
 */
function sumberkayu_add_gallery_attachment_field( $form_fields, $post ) {
    $value = get_post_meta( $post->ID, '_tampil_di_galeri', true );
    $checked = ( $value == '1' ) ? 'checked="checked"' : '';
    
    $html = '<label style="display:flex; align-items:center; gap:8px;">';
    $html .= '<input type="checkbox" name="attachments[' . $post->ID . '][tampil_di_galeri]" id="attachments[' . $post->ID . '][tampil_di_galeri]" value="1" ' . $checked . ' />';
    $html .= 'Ya, tampilkan di halaman Galeri public</label>';
    
    $form_fields['tampil_di_galeri'] = array(
        'label' => 'Tampil di Galeri?',
        'input' => 'html',
        'html'  => $html,
    );
    return $form_fields;
}
add_filter( 'attachment_fields_to_edit', 'sumberkayu_add_gallery_attachment_field', 10, 2 );

/**
 * Save Checkbox in Media Library
 */
function sumberkayu_save_gallery_attachment_field( $post, $attachment ) {
    if ( isset( $attachment['tampil_di_galeri'] ) ) {
        update_post_meta( $post['ID'], '_tampil_di_galeri', '1' );
    } else {
        delete_post_meta( $post['ID'], '_tampil_di_galeri' );
    }
    return $post;
}
add_filter( 'attachment_fields_to_save', 'sumberkayu_save_gallery_attachment_field', 10, 2 );

// ============================================================
// META BOXES
// ============================================================

/**
 * SEO Meta Box
 */
function sumberkayu_add_seo_meta_box() {
    $screens = array( 'page', 'product', 'project', 'post' );
    foreach ( $screens as $screen ) {
        add_meta_box(
            'sumberkayu_seo',
            'SEO Settings',
            'sumberkayu_seo_meta_box_html',
            $screen,
            'normal',
            'high'
        );
    }
}
add_action( 'add_meta_boxes', 'sumberkayu_add_seo_meta_box' );

function sumberkayu_seo_meta_box_html( $post ) {
    wp_nonce_field( 'sumberkayu_seo_nonce', 'sumberkayu_seo_nonce_field' );
    $seo_title = get_post_meta( $post->ID, '_seo_title', true );
    $seo_desc  = get_post_meta( $post->ID, '_seo_description', true );
    $seo_h1    = get_post_meta( $post->ID, '_seo_h1', true );
    $seo_schema = get_post_meta( $post->ID, '_seo_schema', true );
    ?>
    <table class="form-table">
        <tr>
            <th><label for="seo_title">SEO Title</label></th>
            <td><input type="text" id="seo_title" name="seo_title" value="<?php echo esc_attr( $seo_title ); ?>" class="large-text" /></td>
        </tr>
        <tr>
            <th><label for="seo_description">Meta Description</label></th>
            <td><textarea id="seo_description" name="seo_description" rows="3" class="large-text"><?php echo esc_textarea( $seo_desc ); ?></textarea></td>
        </tr>
        <tr>
            <th><label for="seo_h1">H1 Override</label></th>
            <td><input type="text" id="seo_h1" name="seo_h1" value="<?php echo esc_attr( $seo_h1 ); ?>" class="large-text" /></td>
        </tr>
        <tr>
            <th><label for="seo_schema">Schema JSON-LD</label></th>
            <td><textarea id="seo_schema" name="seo_schema" rows="6" class="large-text" placeholder='{"@context":"https://schema.org",...}'><?php echo esc_textarea( $seo_schema ); ?></textarea></td>
        </tr>
    </table>
    <?php
}

function sumberkayu_save_seo_meta( $post_id ) {
    if ( ! isset( $_POST['sumberkayu_seo_nonce_field'] ) ) return;
    if ( ! wp_verify_nonce( $_POST['sumberkayu_seo_nonce_field'], 'sumberkayu_seo_nonce' ) ) return;
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
    if ( ! current_user_can( 'edit_post', $post_id ) ) return;

    $fields = array( 'seo_title' => '_seo_title', 'seo_description' => '_seo_description', 'seo_h1' => '_seo_h1', 'seo_schema' => '_seo_schema' );
    foreach ( $fields as $field => $meta_key ) {
        if ( isset( $_POST[ $field ] ) ) {
            update_post_meta( $post_id, $meta_key, sanitize_text_field( $_POST[ $field ] ) );
        }
    }
}
add_action( 'save_post', 'sumberkayu_save_seo_meta' );

/**
 * Product Meta Box (Subtitle, Specs, Benefits)
 */
function sumberkayu_add_product_meta_box() {
    add_meta_box(
        'sumberkayu_product',
        'Detail Produk',
        'sumberkayu_product_meta_box_html',
        'product',
        'normal',
        'high'
    );
}
add_action( 'add_meta_boxes', 'sumberkayu_add_product_meta_box' );

function sumberkayu_product_meta_box_html( $post ) {
    wp_nonce_field( 'sumberkayu_product_nonce', 'sumberkayu_product_nonce_field' );
    $subtitle = get_post_meta( $post->ID, '_product_subtitle', true );
    $specs    = get_post_meta( $post->ID, '_product_specs', true );
    $benefits = get_post_meta( $post->ID, '_product_benefits', true );
    ?>
    <table class="form-table">
        <tr>
            <th><label for="product_subtitle">Subtitle / Tagline</label></th>
            <td><input type="text" id="product_subtitle" name="product_subtitle" value="<?php echo esc_attr( $subtitle ); ?>" class="large-text" placeholder="e.g. Solusi Ekonomis untuk Konstruksi Umum" /></td>
        </tr>
        <tr>
            <th><label for="product_specs">Spesifikasi (JSON)</label></th>
            <td><textarea id="product_specs" name="product_specs" rows="8" class="large-text" placeholder='[{"label":"Jenis","value":"Meranti"}]'><?php echo esc_textarea( $specs ); ?></textarea>
            <p class="description">Format: [{"label":"Jenis","value":"Meranti"},{"label":"Densitas","value":"600-700 kg/m³"}]</p></td>
        </tr>
        <tr>
            <th><label for="product_benefits">Keunggulan (JSON)</label></th>
            <td><textarea id="product_benefits" name="product_benefits" rows="5" class="large-text" placeholder='["Benefit 1","Benefit 2"]'><?php echo esc_textarea( $benefits ); ?></textarea>
            <p class="description">Format: ["Harga kompetitif","Mudah dikerjakan"]</p></td>
        </tr>
    </table>
    <?php
}

function sumberkayu_save_product_meta( $post_id ) {
    if ( ! isset( $_POST['sumberkayu_product_nonce_field'] ) ) return;
    if ( ! wp_verify_nonce( $_POST['sumberkayu_product_nonce_field'], 'sumberkayu_product_nonce' ) ) return;
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
    if ( ! current_user_can( 'edit_post', $post_id ) ) return;

    if ( isset( $_POST['product_subtitle'] ) ) {
        update_post_meta( $post_id, '_product_subtitle', sanitize_text_field( $_POST['product_subtitle'] ) );
    }
    if ( isset( $_POST['product_specs'] ) ) {
        update_post_meta( $post_id, '_product_specs', wp_kses_post( $_POST['product_specs'] ) );
    }
    if ( isset( $_POST['product_benefits'] ) ) {
        update_post_meta( $post_id, '_product_benefits', wp_kses_post( $_POST['product_benefits'] ) );
    }
}
add_action( 'save_post_product', 'sumberkayu_save_product_meta' );

// ============================================================
// HELPER FUNCTIONS
// ============================================================

/**
 * Get SEO H1 for current page
 */
function sumberkayu_get_h1() {
    if ( is_singular() ) {
        $h1 = get_post_meta( get_the_ID(), '_seo_h1', true );
        return $h1 ? $h1 : get_the_title();
    }
    return get_the_title();
}

/**
 * Get SEO meta description
 */
function sumberkayu_get_meta_description() {
    if ( is_singular() ) {
        $desc = get_post_meta( get_the_ID(), '_seo_description', true );
        if ( $desc ) return $desc;
        if ( has_excerpt() ) return get_the_excerpt();
    }
    return get_bloginfo( 'description' );
}

/**
 * Breadcrumbs
 */
function sumberkayu_breadcrumbs() {
    if ( is_front_page() ) return;

    echo '<section class="bg-white dark:bg-background-dark border-b border-[#e7ebf3] dark:border-white/10">';
    echo '<div class="max-w-[1280px] mx-auto px-6 lg:px-20 py-4">';
    echo '<div class="flex items-center gap-2 text-sm text-gray-600 dark:text-gray-400">';

    echo '<a href="' . esc_url( home_url( '/' ) ) . '" class="hover:text-primary transition-colors">Home</a>';

    if ( is_singular( 'product' ) ) {
        echo '<span class="text-gray-400">/</span>';
        echo '<a href="' . esc_url( get_post_type_archive_link( 'product' ) ) . '" class="hover:text-primary transition-colors">Katalog</a>';
        echo '<span class="text-gray-400">/</span>';
        echo '<span class="text-primary font-bold">' . esc_html( get_the_title() ) . '</span>';
    } elseif ( is_singular( 'project' ) ) {
        echo '<span class="text-gray-400">/</span>';
        echo '<a href="' . esc_url( get_post_type_archive_link( 'project' ) ) . '" class="hover:text-primary transition-colors">Projects</a>';
        echo '<span class="text-gray-400">/</span>';
        echo '<span class="text-primary font-bold">' . esc_html( get_the_title() ) . '</span>';
    } elseif ( is_post_type_archive( 'product' ) ) {
        echo '<span class="text-gray-400">/</span>';
        echo '<span class="text-primary font-bold">Katalog Produk</span>';
    } elseif ( is_post_type_archive( 'project' ) ) {
        echo '<span class="text-gray-400">/</span>';
        echo '<span class="text-primary font-bold">Projects</span>';
    } elseif ( is_page() ) {
        echo '<span class="text-gray-400">/</span>';
        echo '<span class="text-primary font-bold">' . esc_html( get_the_title() ) . '</span>';
    } elseif ( is_single() ) {
        echo '<span class="text-gray-400">/</span>';
        echo '<a href="' . esc_url( get_permalink( get_option( 'page_for_posts' ) ) ) . '" class="hover:text-primary transition-colors">Blog</a>';
        echo '<span class="text-gray-400">/</span>';
        echo '<span class="text-primary font-bold">' . esc_html( get_the_title() ) . '</span>';
    } elseif ( is_archive() ) {
        echo '<span class="text-gray-400">/</span>';
        echo '<span class="text-primary font-bold">' . esc_html( get_the_archive_title() ) . '</span>';
    }

    echo '</div></div></section>';
}

/**
 * WhatsApp URL helper
 */
function sumberkayu_whatsapp_url( $message = '' ) {
    $url = 'https://api.whatsapp.com/send/?phone=' . SUMBERKAYU_WHATSAPP . '&type=phone_number&app_absent=0';
    if ( $message ) {
        $url .= '&text=' . urlencode( $message );
    }
    return $url;
}

/**
 * Phone URL helper
 */
function sumberkayu_phone_url() {
    return 'tel:' . SUMBERKAYU_PHONE;
}

// ============================================================
// INCLUDES
// ============================================================

// Include admin customizations if in admin
if ( is_admin() ) {
    require_once SUMBERKAYU_DIR . '/inc/admin.php';
}
