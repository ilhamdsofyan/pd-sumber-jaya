<?php
/**
 * Custom XML Sitemap Generator
 * Provides sitemap_index.xml and sub-sitemaps without plugins.
 */

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Register Sitemap Rewrite Rules
 */
function sumberkayu_sitemap_rewrites() {
    add_rewrite_rule( '^sitemap_index\.xml$', 'index.php?sumberkayu_sitemap=index', 'top' );
    add_rewrite_rule( '^sitemap_pages\.xml$', 'index.php?sumberkayu_sitemap=pages', 'top' );
    add_rewrite_rule( '^sitemap_products\.xml$', 'index.php?sumberkayu_sitemap=products', 'top' );
    add_rewrite_rule( '^sitemap_projects\.xml$', 'index.php?sumberkayu_sitemap=projects', 'top' );
}
add_action( 'init', 'sumberkayu_sitemap_rewrites' );

/**
 * Register Query Vars
 */
function sumberkayu_sitemap_query_vars( $vars ) {
    $vars[] = 'sumberkayu_sitemap';
    return $vars;
}
add_filter( 'query_vars', 'sumberkayu_sitemap_query_vars' );

/**
 * Handle Sitemap Request
 */
function sumberkayu_handle_sitemap() {
    $sitemap = get_query_var( 'sumberkayu_sitemap' );
    if ( ! $sitemap ) return;

    header( 'Content-Type: application/xml; charset=utf-8' );
    echo '<?xml version="1.0" encoding="UTF-8"?>';
    echo '<?xml-stylesheet type="text/xsl" href="' . includes_url( 'css/main.xsl' ) . '"?>';

    switch ( $sitemap ) {
        case 'index':
            sumberkayu_render_sitemap_index();
            break;
        case 'pages':
            sumberkayu_render_sitemap_posts( array( 'post_type' => 'page' ), 0.8 );
            break;
        case 'products':
            sumberkayu_render_sitemap_posts( array( 'post_type' => 'product' ), 0.9 );
            break;
        case 'projects':
            sumberkayu_render_sitemap_posts( array( 'post_type' => 'project' ), 0.7 );
            break;
    }
    exit;
}
add_action( 'template_redirect', 'sumberkayu_handle_sitemap' );

/**
 * Render Master Sitemap Index
 */
function sumberkayu_render_sitemap_index() {
    $sitemaps = array( 'pages', 'products', 'projects' );
    echo '<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
    foreach ( $sitemaps as $s ) {
        echo '<sitemap>';
        echo '<loc>' . home_url( "/sitemap_{$s}.xml" ) . '</loc>';
        echo '<lastmod>' . date( 'c' ) . '</lastmod>';
        echo '</sitemap>';
    }
    echo '</sitemapindex>';
}

/**
 * Render Post Type Sitemaps
 */
function sumberkayu_render_sitemap_posts( $args, $default_priority = 0.6 ) {
    $query_args = wp_parse_args( $args, array(
        'posts_per_page' => -1,
        'post_status'    => 'publish',
        'orderby'        => 'modified',
        'order'          => 'DESC'
    ) );

    $posts = get_posts( $query_args );

    echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
    
    // Add Homepage manually to pages sitemap
    if ( $args['post_type'] === 'page' ) {
        echo '<url>';
        echo '<loc>' . home_url( '/' ) . '</loc>';
        echo '<lastmod>' . date( 'c' ) . '</lastmod>';
        echo '<changefreq>daily</changefreq>';
        echo '<priority>1.0</priority>';
        echo '</url>';
    }

    foreach ( $posts as $p ) {
        // Skip excluded pages
        if ( get_post_meta( $p->ID, '_seo_noindex', true ) === '1' ) continue;
        
        $priority = $default_priority;
        $changefreq = 'weekly';

        // Local SEO Booster
        if ( $p->post_name === 'harga-kayu-jakarta-utara' ) {
            $priority = 1.0;
            $changefreq = 'daily';
        }

        echo '<url>';
        echo '<loc>' . get_permalink( $p->ID ) . '</loc>';
        echo '<lastmod>' . get_the_modified_date( 'c', $p->ID ) . '</lastmod>';
        echo '<changefreq>' . $changefreq . '</changefreq>';
        echo '<priority>' . $priority . '</priority>';
        echo '</url>';
    }
    echo '</urlset>';
}
