<?php
/**
 * Index Template (Fallback)
 * @package sumberkayu
 */

get_header();
?>

<section class="py-20">
    <div class="max-w-[1280px] mx-auto px-6 lg:px-20">
        <?php
        if ( have_posts() ) :
            while ( have_posts() ) : the_post();
                the_content();
            endwhile;
        else :
            echo '<p>Tidak ada konten.</p>';
        endif;
        ?>
    </div>
</section>

<?php get_footer(); ?>
