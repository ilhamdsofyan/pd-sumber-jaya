<?php
/**
 * Template Name: Gallery Proyek
 * @package sumberkayu
 */

get_header();
?>

<section class="bg-gradient-to-r from-primary to-blue-600 text-white py-12">
    <div class="max-w-[1280px] mx-auto px-6 lg:px-20">
        <h1 class="text-4xl md:text-5xl font-black mb-4">Gallery Proyek</h1>
        <p class="text-lg text-blue-100 max-w-2xl">Lihat koleksi proyek-proyek terbaik kami yang telah diselesaikan dengan material berkualitas tinggi dan keprofesionalan tim.</p>
    </div>
</section>

<section class="py-20">
    <div class="max-w-[1280px] mx-auto px-6 lg:px-20">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php
            $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
            $gallery_query = new WP_Query( array(
                'post_type'      => 'gallery',
                'posts_per_page' => 12,
                'paged'          => $paged,
            ) );

            if ( $gallery_query->have_posts() ) :
                while ( $gallery_query->have_posts() ) : $gallery_query->the_post();
                    $img_path = get_post_meta( get_the_ID(), '_gallery_image_path', true );
                    $img_url = $img_path ? SUMBERKAYU_URI . '/' . $img_path : ( has_post_thumbnail() ? get_the_post_thumbnail_url( null, 'large' ) : SUMBERKAYU_URI . '/assets/images/placeholder.webp' );
                    $alt = get_post_meta( get_the_ID(), '_gallery_alt', true ) ?: get_the_title();
            ?>
            <div class="group bg-white dark:bg-background-dark rounded shadow-md overflow-hidden hover:shadow-xl transition-shadow relative">
                <div class="relative h-64 bg-gray-200 overflow-hidden">
                    <img src="<?php echo esc_url( $img_url ); ?>" alt="<?php echo esc_attr( $alt ); ?>" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300" loading="lazy" />
                    <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                        <span class="text-white font-bold text-center px-4"><?php the_title(); ?></span>
                    </div>
                </div>
            </div>
            <?php
                endwhile;
                
                echo '<div class="col-span-full flex justify-center mt-12 gap-3">';
                echo paginate_links( array(
                    'total'   => $gallery_query->max_num_pages,
                    'current' => $paged,
                    'format'  => '?paged=%#%',
                    'type'    => 'plain',
                    'prev_text' => '&larr; Prev',
                    'next_text' => 'Next &rarr;',
                ) );
                echo '</div>';
                
                wp_reset_postdata();
            else :
                echo '<p class="col-span-3 text-center text-gray-500">Belum ada foto galeri.</p>';
            endif;
            ?>
        </div>
    </div>
</section>

<?php
get_template_part( 'template-parts/cta-block', null, array(
    'title'   => 'Lihat Lebih Banyak Proyek Kami',
    'message' => 'Hubungi kami sekarang untuk melihat portofolio lengkap dan konsultasi proyek.',
) );

get_footer();
?>
