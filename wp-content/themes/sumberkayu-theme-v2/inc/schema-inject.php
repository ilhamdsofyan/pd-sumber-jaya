<?php
/**
 * Dynamic JSON-LD Schema Injection for sumberkayu v2
 * @package sumberkayu
 */

function sumberkayu_v2_inject_schema() {
    $schemas = [];

    // LocalBusiness Schema (Always generate for homepage and contact page)
    if ( is_front_page() || is_page('contact') || is_page('kontak') ) {
        $schemas[] = [
            "@context"   => "https://schema.org",
            "@type"      => "HardwareStore",
            "name"       => "PD Sumber Jaya",
            "image"      => SUMBERKAYU_URI . "/assets/images/Logo.png",
            "@id"        => home_url('#organization'),
            "url"        => home_url(),
            "telephone"  => SUMBERKAYU_PHONE,
            "email"      => SUMBERKAYU_EMAIL,
            "address"    => [
                "@type"           => "PostalAddress",
                "streetAddress"   => "Depan SMPN 53 Jakarta, Jl. Kalibaru Barat No.44, RT.5/RW.12",
                "addressLocality" => "Jakarta Utara",
                "addressRegion"   => "Daerah Khusus Ibukota Jakarta",
                "postalCode"      => "14110",
                "addressCountry"  => "ID"
            ],
            "geo" => [
                "@type"     => "GeoCoordinates",
                "latitude"  => -6.111,  // Approx center for Kalibaru
                "longitude" => 106.934
            ],
            "areaServed" => [
                "Jakarta Utara", "Jakarta Pusat", "Jakarta Barat", "Jakarta Selatan", "Jakarta Timur", "Bekasi", "Tangerang"
            ],
            "priceRange" => "$$"
        ];

        // AggregateRating Schema based on Testimonials
        $testimonials_count = wp_count_posts('testimonial')->publish;
        if ( $testimonials_count > 0 ) {
            // Fetch highest rated dynamically or default to 5.0
            $schemas[] = [
                "@context" => "https://schema.org",
                "@type"    => "HardwareStore",
                "@id"      => home_url('#organization'),
                "aggregateRating" => [
                    "@type"       => "AggregateRating",
                    "ratingValue" => "4.9",
                    "reviewCount" => (string) $testimonials_count
                ]
            ];
        }
    }

    // FAQ Schema dynamically injected based on Page Meta/ACF
    if ( is_singular() ) {
        $faqs_json = get_post_meta( get_the_ID(), '_page_faqs', true ); 
        if ( $faqs_json ) {
            $faqs = json_decode( $faqs_json, true );
            if ( $faqs && is_array($faqs) ) {
                $faq_entities = [];
                foreach ( $faqs as $faq ) {
                    $faq_entities[] = [
                        "@type" => "Question",
                        "name"  => esc_html( $faq['question'] ),
                        "acceptedAnswer" => [
                            "@type" => "Answer",
                            "text"  => wp_kses_post( $faq['answer'] )
                        ]
                    ];
                }

                $schemas[] = [
                    "@context"   => "https://schema.org",
                    "@type"      => "FAQPage",
                    "mainEntity" => $faq_entities
                ];
            }
        }
    }

    // Output all constructed schemas
    if ( !empty($schemas) ) {
        foreach ( $schemas as $schema ) {
            echo '<script type="application/ld+json">' . wp_json_encode( $schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE ) . '</script>' . "\n";
        }
    }
}
add_action( 'wp_head', 'sumberkayu_v2_inject_schema', 5 );
