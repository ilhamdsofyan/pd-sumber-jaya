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
        <style>
            @keyframes popIn {
                0% { opacity: 0; transform: scale(0.95); }
                100% { opacity: 1; transform: scale(1); }
            }
            .animate-pop-in {
                animation: popIn 0.3s ease-out forwards;
            }
        </style>
            <?php
            $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
            
            // Query attachments (Uploaded Media Images & Videos) with Checkbox 'Tampil di Galeri'
            $gallery_query = new WP_Query( array(
                'post_type'      => 'attachment',
                'post_status'    => 'inherit',
                'post_mime_type' => array( 'image', 'video' ),
                'posts_per_page' => 12,
                'paged'          => $paged,
                'orderby'        => 'post_date',
                'order'          => 'DESC',
                'meta_query'     => array(
                    array(
                        'key'     => '_tampil_di_galeri',
                        'value'   => '1',
                        'compare' => '='
                    ),
                ),
            ) );

            if ( $gallery_query->have_posts() ) :
            ?>
                <!-- Filter Tabs -->
                <div class="col-span-full flex flex-wrap justify-center gap-4 mb-8">
                    <button class="gallery-tab-btn active px-6 py-2 rounded-full font-bold text-sm bg-primary text-white transition-colors" data-filter="all">Semua</button>
                    <button class="gallery-tab-btn px-6 py-2 rounded-full font-bold text-sm bg-gray-200 text-gray-700 hover:bg-gray-300 dark:bg-background-dark dark:text-gray-300 dark:hover:bg-gray-800 transition-colors" data-filter="image">Foto</button>
                    <button class="gallery-tab-btn px-6 py-2 rounded-full font-bold text-sm bg-gray-200 text-gray-700 hover:bg-gray-300 dark:bg-background-dark dark:text-gray-300 dark:hover:bg-gray-800 transition-colors" data-filter="video">Video</button>
                </div>
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-1 md:gap-4 lg:gap-6">
            <?php
                while ( $gallery_query->have_posts() ) : $gallery_query->the_post();
                    $mime_type = get_post_mime_type();
                    $is_video = strpos( $mime_type, 'video' ) !== false;
                    $item_type = $is_video ? 'video' : 'image';
                    
                    $alt_text = get_post_meta( get_the_ID(), '_wp_attachment_image_alt', true ) ?: get_the_title();
                    $title = get_the_title();
                    
                    $desc = '';
                    if ( get_the_excerpt() ) {
                        $desc = get_the_excerpt();
                    } elseif ( get_the_content() ) {
                        $desc = wp_strip_all_tags( get_the_content() );
                    }
                    
                    $media_url = $is_video ? wp_get_attachment_url( get_the_ID() ) : wp_get_attachment_image_url( get_the_ID(), 'full' );
                    $thumb_url = wp_get_attachment_image_url( get_the_ID(), 'large' ); // Fallback for video poster if possible, else rely on browser
            ?>
            <div 
                class="gallery-item group bg-gray-200 dark:bg-gray-800 relative cursor-pointer overflow-hidden aspect-square" 
                data-type="<?php echo esc_attr( $item_type ); ?>"
                data-media="<?php echo esc_url( $media_url ); ?>"
                data-title="<?php echo esc_attr( $title ); ?>"
                data-desc="<?php echo esc_attr( $desc ); ?>"
            >
                <?php if ( $is_video ) : ?>
                    <video src="<?php echo esc_url( $media_url ); ?>" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" muted loop playsinline onmouseover="this.play()" onmouseout="this.pause()"></video>
                    <!-- Video Icon Indicator -->
                    <div class="absolute top-2 right-2 bg-black/50 rounded-full p-1.5 text-white shadow-sm">
                        <span class="material-symbols-outlined text-sm block">play_circle</span>
                    </div>
                <?php else : ?>
                    <img src="<?php echo esc_url( $thumb_url ); ?>" alt="<?php echo esc_attr( $alt_text ); ?>" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" loading="lazy" />
                <?php endif; ?>

                <!-- Hover Overlay (Instagram style) -->
                <div class="absolute inset-0 bg-black/70 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center pointer-events-none">
                    <span class="material-symbols-outlined text-white text-5xl drop-shadow-lg">fullscreen</span>
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
                echo '<p class="col-span-full text-center text-gray-500 py-12">Belum ada media galeri.</p>';
            endif;
            ?>
            
            </div>
            <!-- Lightbox Modal -->
            <div id="gallery-lightbox" class="fixed inset-0 z-[100] bg-black/95 hidden flex-col md:flex-row items-center justify-center opacity-0 transition-opacity duration-300">
                <!-- Close Button -->
                <button id="lightbox-close" class="absolute top-4 right-4 md:top-6 md:right-6 bg-black/50 hover:bg-black/80 rounded-full text-white p-3 z-50 transition-colors shadow-lg border border-white/20">
                    <span class="material-symbols-outlined text-3xl block">close</span>
                </button>
                
                <!-- Media Container (Click outside to close) -->
                <div id="lightbox-media-wrapper" class="w-full md:w-[70%] h-[50vh] md:h-screen flex flex-col items-center justify-center relative p-4 md:p-8 cursor-pointer scale-95 opacity-0 transition-all duration-500 ease-out">
                     <div id="lightbox-media-container" class="w-full h-full flex items-center justify-center cursor-default bg-black" onclick="event.stopPropagation()">
                         <!-- Injected via JS -->
                     </div>
                </div>

                <!-- Content Container (Sidebar on Desktop, Bottom on Mobile) -->
                <div id="lightbox-sidebar" class="w-full md:w-[30%] h-[50vh] md:h-screen bg-white dark:bg-background-dark overflow-y-auto flex flex-col z-10 border-l border-gray-200 dark:border-white/10 opacity-0 translate-y-12 md:translate-y-0 md:translate-x-12 transition-all duration-500 ease-out delay-100">
                    <!-- Header -->
                    <div class="p-6 border-b border-gray-100 dark:border-white/10 flex flex-col gap-2">
                        <div class="flex items-center gap-3">
                            <img src="<?php echo esc_url( SUMBERKAYU_URI . '/assets/images/Logo.png' ); ?>" class="w-8 h-8 rounded-full bg-gray-200 object-cover border border-gray-300 dark:border-white/20" alt="Logo">
                            <span class="font-bold text-[#0e121b] dark:text-white text-sm">PD Sumber Jaya</span>
                        </div>
                    </div>
                    <!-- Body -->
                    <div class="p-6 flex-1 text-left">
                        <h3 id="lightbox-title" class="font-bold text-lg text-[#0e121b] dark:text-white mb-2 leading-snug"></h3>
                        <p id="lightbox-desc" class="text-sm text-gray-700 dark:text-gray-300 leading-relaxed whitespace-pre-line"></p>
                    </div>
                </div>
            </div>

            <script>
            document.addEventListener('DOMContentLoaded', function() {
                // 1. Filtering Logic (Pill Tabs)
                const tabs = document.querySelectorAll('.gallery-tab-btn');
                const items = document.querySelectorAll('.gallery-item');
                
                tabs.forEach(tab => {
                    tab.addEventListener('click', function() {
                        tabs.forEach(t => {
                            t.classList.remove('bg-primary', 'text-white', 'active');
                            t.classList.add('bg-gray-200', 'text-gray-700', 'hover:bg-gray-300', 'dark:bg-background-dark', 'dark:text-gray-300', 'dark:hover:bg-gray-800');
                        });
                        
                        this.classList.remove('bg-gray-200', 'text-gray-700', 'hover:bg-gray-300', 'dark:bg-background-dark', 'dark:text-gray-300', 'dark:hover:bg-gray-800');
                        this.classList.add('bg-primary', 'text-white', 'active');
                        
                        const filterVal = this.getAttribute('data-filter');
                        
                        items.forEach(item => {
                            // Reset animation class
                            item.classList.remove('animate-pop-in');
                            
                            if (filterVal === 'all' || item.getAttribute('data-type') === filterVal) {
                                item.style.display = 'block';
                                // Trigger reflow to restart css animation
                                void item.offsetWidth;
                                item.classList.add('animate-pop-in');
                            } else {
                                item.style.display = 'none';
                            }
                        });
                    });
                });

                // 2. Lightbox Logic
                const lightbox = document.getElementById('gallery-lightbox');
                const closeBtn = document.getElementById('lightbox-close');
                const mediaContainer = document.getElementById('lightbox-media-container');
                const titleEl = document.getElementById('lightbox-title');
                const descEl = document.getElementById('lightbox-desc');
                
                function openLightbox(item) {
                    const type = item.getAttribute('data-type');
                    const src = item.getAttribute('data-media');
                    const title = item.getAttribute('data-title');
                    const desc = item.getAttribute('data-desc');
                    
                    // Set Texts
                    titleEl.textContent = title;
                    descEl.textContent = desc || '';
                    
                    // Set Media
                    mediaContainer.innerHTML = '';
                    if (type === 'video') {
                        const vid = document.createElement('video');
                        vid.src = src;
                        vid.controls = true;
                        vid.autoplay = true;
                        vid.className = 'max-w-full max-h-full object-contain';
                        mediaContainer.appendChild(vid);
                    } else {
                        const img = document.createElement('img');
                        img.src = src;
                        img.className = 'max-w-full max-h-full object-contain';
                        mediaContainer.appendChild(img);
                    }
                    
                    // Show Lightbox Background
                    lightbox.classList.remove('hidden');
                    lightbox.classList.add('flex');
                    
                    // Small delay to allow CSS transition to grab the opacity change
                    setTimeout(() => {
                        lightbox.classList.remove('opacity-0');
                        lightbox.classList.add('opacity-100');
                        document.body.style.overflow = 'hidden'; // Prevent scrolling background
                        
                        // Fire inner animations
                        document.getElementById('lightbox-media-wrapper').classList.remove('scale-95', 'opacity-0');
                        document.getElementById('lightbox-media-wrapper').classList.add('scale-100', 'opacity-100');
                        
                        document.getElementById('lightbox-sidebar').classList.remove('opacity-0', 'translate-y-12', 'md:translate-x-12');
                        document.getElementById('lightbox-sidebar').classList.add('opacity-100', 'translate-y-0', 'md:translate-x-0');
                    }, 10);
                }
                
                function closeLightbox() {
                    // Reverse inner animations
                    document.getElementById('lightbox-media-wrapper').classList.remove('scale-100', 'opacity-100');
                    document.getElementById('lightbox-media-wrapper').classList.add('scale-95', 'opacity-0');
                    
                    document.getElementById('lightbox-sidebar').classList.remove('opacity-100', 'translate-y-0', 'md:translate-x-0');
                    document.getElementById('lightbox-sidebar').classList.add('opacity-0', 'translate-y-12', 'md:translate-x-12');
                    
                    // Fade out overlay shortly after
                    setTimeout(() => {
                        lightbox.classList.remove('opacity-100');
                        lightbox.classList.add('opacity-0');
                    }, 200);
                    
                    setTimeout(() => {
                        // Fully hide modal
                        lightbox.classList.remove('flex');
                        lightbox.classList.add('hidden');
                        mediaContainer.innerHTML = ''; // Stop video playing
                        document.body.style.overflow = '';
                    }, 500); // Wait for all transitions to end
                }

                // Bind clicks
                items.forEach(item => {
                    item.addEventListener('click', () => openLightbox(item));
                });
                
                closeBtn.addEventListener('click', closeLightbox);
                
                // Close on background click
                const wrapper = document.getElementById('lightbox-media-wrapper');
                wrapper.addEventListener('click', closeLightbox);
                
                lightbox.addEventListener('click', (e) => {
                    if (e.target === lightbox) {
                        closeLightbox();
                    }
                });

                // Close on ESC key
                document.addEventListener('keydown', (e) => {
                    if (e.key === 'Escape' && !lightbox.classList.contains('hidden')) {
                        closeLightbox();
                    }
                });
            });
            </script>
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
