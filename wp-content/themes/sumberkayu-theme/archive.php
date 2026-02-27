<?php
/**
 * Archive Template (Blog)
 * @package sumberkayu
 */

get_header();
?>

<section class="bg-gradient-to-r from-primary to-blue-600 text-white py-12">
    <div class="max-w-[1280px] mx-auto px-6 lg:px-20">
        <h1 class="text-4xl md:text-5xl font-black mb-4"><?php echo is_home() ? 'Blog' : get_the_archive_title(); ?></h1>
        <p class="text-lg text-blue-100 max-w-2xl">Artikel, tips, dan informasi seputar kayu konstruksi dan proyek pembangunan.</p>
    </div>
</section>

<section class="py-20">
    <div class="max-w-[1280px] mx-auto px-6 lg:px-20">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php
            if ( have_posts() ) :
                while ( have_posts() ) : the_post();
            ?>
            <article class="bg-white dark:bg-background-dark rounded shadow-md overflow-hidden hover:shadow-xl transition-shadow">
                <?php if ( has_post_thumbnail() ) : ?>
                <a href="<?php the_permalink(); ?>" class="block h-48 overflow-hidden">
                    <?php the_post_thumbnail( 'medium_large', array( 'class' => 'w-full h-full object-cover hover:scale-105 transition-transform duration-300' ) ); ?>
                </a>
                <?php endif; ?>
                <div class="p-6">
                    <time class="text-xs text-gray-500 uppercase tracking-wider" datetime="<?php echo get_the_date( 'Y-m-d' ); ?>"><?php echo get_the_date(); ?></time>
                    <h2 class="text-xl font-black mt-2 mb-3">
                        <a href="<?php the_permalink(); ?>" class="hover:text-primary transition-colors"><?php the_title(); ?></a>
                    </h2>
                    <p class="text-gray-600 dark:text-gray-400 text-sm line-clamp-3"><?php echo wp_trim_words( get_the_excerpt(), 20, '...' ); ?></p>
                    <a href="<?php the_permalink(); ?>" class="text-primary font-bold text-sm mt-4 inline-block hover:underline">Baca Selengkapnya &rarr;</a>
                </div>
            </article>
            <?php
                endwhile;
                the_posts_pagination( array( 'class' => 'mt-12' ) );
            else :
                echo '<p class="col-span-3 text-center text-gray-500">Belum ada artikel.</p>';
            endif;
            ?>
        </div>
    </div>
</section>

<?php get_footer(); ?>
