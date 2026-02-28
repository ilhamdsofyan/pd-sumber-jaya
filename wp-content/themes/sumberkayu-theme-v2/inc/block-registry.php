<?php
/**
 * Register custom Gutenberg Blocks for sumberkayu v2
 * @package sumberkayu
 */

function sumberkayu_v2_register_blocks() {
    $blocks_dir = SUMBERKAYU_DIR . '/blocks/';
    if ( ! is_dir( $blocks_dir ) ) return;

    $blocks = ['feature-cards', 'product-grid', 'location-block', 'partner-logos', 'testimonial-slider'];

    foreach ( $blocks as $block ) {
        $block_path = $blocks_dir . $block;
        if ( file_exists( $block_path . '/block.json' ) ) {
            register_block_type( $block_path );
        }
    }
}
add_action( 'init', 'sumberkayu_v2_register_blocks' );
