<?php
/**
 * LocalBusiness Schema JSON-LD
 * @package sumberkayu
 */
?>
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "Store",
    "name": "PD Sumber Jaya",
    "image": "<?php echo esc_url( SUMBERKAYU_URI . '/assets/images/Logo-with-text.png' ); ?>",
    "description": "Supplier kayu konstruksi profesional sejak 1994. Menyediakan kayu Meranti, Kamper, Bengkirai, Damar Laut, Merbau, Ulin untuk proyek volume besar.",
    "url": "https://sumberkayu.com",
    "telephone": "+62-852-1877-6287",
    "email": "<?php echo esc_attr( SUMBERKAYU_EMAIL ); ?>",
    "address": {
        "@type": "PostalAddress",
        "streetAddress": "Depan SMPN 53 Jakarta, Jl. Kalibaru Barat No.44, RT.5/RW.12",
        "addressLocality": "Kali Baru",
        "addressRegion": "Jakarta Utara, DKI Jakarta",
        "postalCode": "14110",
        "addressCountry": "ID"
    },
    "geo": {
        "@type": "GeoCoordinates",
        "latitude": "-6.1245",
        "longitude": "106.9287"
    },
    "openingHoursSpecification": [
        {
            "@type": "OpeningHoursSpecification",
            "dayOfWeek": ["Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"],
            "opens": "08:00",
            "closes": "22:00"
        },
        {
            "@type": "OpeningHoursSpecification",
            "dayOfWeek": "Sunday",
            "opens": "09:00",
            "closes": "22:00"
        }
    ],
    "sameAs": [],
    "areaServed": "ID",
    "priceRange": "$$"
}
</script>
