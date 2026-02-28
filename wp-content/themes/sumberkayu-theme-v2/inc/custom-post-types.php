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
