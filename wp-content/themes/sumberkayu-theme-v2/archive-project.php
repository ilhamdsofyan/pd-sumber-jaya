<?php
/**
 * Project Archive Template
 * @package sumberkayu
 */

get_header();
?>

<section class="bg-gradient-to-r from-primary to-blue-600 text-white py-12">
    <div class="max-w-[1280px] mx-auto px-6 lg:px-20">
        <h1 class="text-4xl md:text-5xl font-black mb-4">Portofolio Projects</h1>
        <p class="text-lg text-blue-100 max-w-2xl">Dokumentasi project-project sukses dari berbagai PT klien yang telah mempercayai material kayu berkualitas kami.</p>
    </div>
</section>

<section class="py-20">
    <div class="max-w-[1280px] mx-auto px-6 lg:px-20">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php
            if ( have_posts() ) :
                while ( have_posts() ) : the_post();
                    $project_image = get_post_meta( get_the_ID(), '_project_image', true );
                    $client = get_post_meta( get_the_ID(), '_project_client', true );
                    $location = get_post_meta( get_the_ID(), '_project_location', true );
                    $img_url = $project_image ? SUMBERKAYU_URI . '/' . $project_image : ( has_post_thumbnail() ? get_the_post_thumbnail_url( null, 'large' ) : SUMBERKAYU_URI . '/assets/images/placeholder.webp' );
            ?>
            <div class="group bg-white dark:bg-background-dark rounded shadow-md overflow-hidden hover:shadow-xl transition-shadow">
                <div class="relative h-64 bg-gray-200 overflow-hidden">
                    <img src="<?php echo esc_url( $img_url ); ?>" alt="<?php the_title_attribute(); ?>" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300" loading="lazy" />
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-black text-[#0e121b] dark:text-white mb-2"><?php the_title(); ?></h3>
                    <?php if ( $client ) : ?>
                    <p class="text-sm text-gray-500 mb-1"><strong>Klien:</strong> <?php echo esc_html( $client ); ?></p>
                    <?php endif; ?>
                    <?php if ( $location ) : ?>
                    <p class="text-sm text-gray-500"><strong>Lokasi:</strong> <?php echo esc_html( $location ); ?></p>
                    <?php endif; ?>
                </div>
            </div>
            <?php
                endwhile;
            else :
                echo '<p class="col-span-3 text-center text-gray-500">Belum ada project.</p>';
            endif;
            ?>
        </div>
    </div>
</section>

<?php
get_template_part( 'template-parts/cta-block', null, array(
    'title'   => 'Jadilah Bagian dari Portfolio Sukses Kami',
    'message' => 'Percayakan kebutuhan material kayu berkualitas tinggi untuk proyek Anda bersama PD Sumber Jaya.',
    'wa_text' => '',
) );

get_footer();
?>
