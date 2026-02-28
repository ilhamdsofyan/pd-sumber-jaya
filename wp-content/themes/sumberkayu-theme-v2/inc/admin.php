<?php
/**
 * Admin customizations
 * @package sumberkayu
 */

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Customize admin footer
 */
function sumberkayu_admin_footer() {
    echo '<span>PD Sumber Jaya — WordPress Theme by Sumberkayu</span>';
}
add_filter( 'admin_footer_text', 'sumberkayu_admin_footer' );

/**
 * Custom admin dashboard widget
 */
function sumberkayu_dashboard_widget() {
    wp_add_dashboard_widget(
        'sumberkayu_quicklinks',
        'PD Sumber Jaya — Quick Links',
        function() {
            echo '<ul>';
            echo '<li><a href="' . admin_url( 'edit.php?post_type=product' ) . '">📦 Kelola Produk</a></li>';
            echo '<li><a href="' . admin_url( 'edit.php?post_type=project' ) . '">🏗️ Kelola Projects</a></li>';
            echo '<li><a href="' . admin_url( 'edit.php?post_type=page' ) . '">📄 Kelola Halaman</a></li>';
            echo '<li><a href="' . home_url() . '" target="_blank">🌐 Lihat Website</a></li>';
            echo '</ul>';
        }
    );
}
add_action( 'wp_dashboard_setup', 'sumberkayu_dashboard_widget' );
