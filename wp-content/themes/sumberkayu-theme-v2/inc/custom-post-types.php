<?php
/**
 * Register missing CPTs (Testimonial & Partner)
 * Product and Project are already in functions.php
 *
 * @package sumberkayu
 */

/**
 * Register Testimonial CPT (For Schema and Sliders)
 */
function sumberkayu_v2_register_testimonial_cpt() {
    $labels = array(
        'name'               => 'Testimonials',
        'singular_name'      => 'Testimonial',
        'add_new'            => 'Tambah Testimonial',
        'add_new_item'       => 'Tambah Testimonial Baru',
        'edit_item'          => 'Edit Testimonial',
        'new_item'           => 'Testimonial Baru',
        'view_item'          => 'Lihat Testimonial',
        'search_items'       => 'Cari Testimonial',
        'not_found'          => 'Testimonial tidak ditemukan',
        'menu_name'          => 'Testimonials',
    );

    register_post_type( 'testimonial', array(
        'labels'        => $labels,
        'public'        => false, // Internal usage only (blocks/schema)
        'show_ui'       => true,
        'supports'      => array( 'title', 'editor', 'thumbnail', 'custom-fields' ),
        'menu_icon'     => 'dashicons-testimonial',
        'show_in_rest'  => true,
    ) );
}
add_action( 'init', 'sumberkayu_v2_register_testimonial_cpt' );

/**
 * Register Partner CPT (For Logo Grid)
 */
function sumberkayu_v2_register_partner_cpt() {
    $labels = array(
        'name'               => 'Partners',
        'singular_name'      => 'Partner',
        'add_new'            => 'Tambah Partner',
        'add_new_item'       => 'Tambah Partner Baru',
        'edit_item'          => 'Edit Partner',
        'new_item'           => 'Partner Baru',
        'view_item'          => 'Lihat Partner',
        'search_items'       => 'Cari Partner',
        'not_found'          => 'Partner tidak ditemukan',
        'menu_name'          => 'Partners',
    );

    register_post_type( 'partner', array(
        'labels'        => $labels,
        'public'        => false, // Internal usage only (blocks)
        'show_ui'       => true,
        'supports'      => array( 'title', 'thumbnail' ), // Only title for company name, thumbnail for logo
        'menu_icon'     => 'dashicons-groups',
        'show_in_rest'  => true,
    ) );
}
add_action( 'init', 'sumberkayu_v2_register_partner_cpt' );
/**
 * Add Role Meta Box to Testimonials
 */
function sumberkayu_v2_add_testimonial_meta() {
    add_meta_box(
        'testimonial_role',
        'Client Role / Position',
        'sumberkayu_v2_testimonial_meta_html',
        'testimonial',
        'side',
        'default'
    );
}
add_action('add_meta_boxes', 'sumberkayu_v2_add_testimonial_meta');

function sumberkayu_v2_testimonial_meta_html($post) {
    $role = get_post_meta($post->ID, '_testimonial_role', true);
    ?>
    <input type="text" name="testimonial_role" value="<?php echo esc_attr($role); ?>" class="widefat" placeholder="e.g. CEO, PT ABC" />
    <?php
}

function sumberkayu_v2_save_testimonial_meta($post_id) {
    if (isset($_POST['testimonial_role'])) {
        update_post_meta($post_id, '_testimonial_role', sanitize_text_field($_POST['testimonial_role']));
    }
}
add_action('save_post_testimonial', 'sumberkayu_v2_save_testimonial_meta');
