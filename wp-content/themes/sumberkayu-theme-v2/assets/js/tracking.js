/**
 * Google Ads Conversion Tracking + WhatsApp/Phone Click Tracking
 * PD Sumber Jaya
 */
document.addEventListener('DOMContentLoaded', function() {
    // Track WhatsApp clicks
    document.querySelectorAll('[data-tracking="whatsapp-click"], a[href*="whatsapp"]').forEach(function(link) {
        link.addEventListener('click', function() {
            // Google Ads conversion
            if (typeof gtag === 'function') {
                gtag('event', 'conversion', {
                    'send_to': 'AW-17942288929/whatsapp_click',
                    'value': 1.0,
                    'currency': 'IDR'
                });
            }
            // GA4 event
            if (typeof gtag === 'function') {
                gtag('event', 'whatsapp_click', {
                    'event_category': 'conversion',
                    'event_label': link.href || 'whatsapp',
                    'value': 1
                });
            }
            // GTM dataLayer
            window.dataLayer = window.dataLayer || [];
            window.dataLayer.push({
                'event': 'whatsapp_click',
                'eventCategory': 'conversion',
                'eventLabel': link.href || 'whatsapp'
            });
        });
    });

    // Track Phone Call clicks
    document.querySelectorAll('[data-tracking="phone-call"], a[href^="tel:"]').forEach(function(link) {
        link.addEventListener('click', function() {
            // Google Ads conversion
            if (typeof gtag === 'function') {
                gtag('event', 'conversion', {
                    'send_to': 'AW-17942288929/phone_call',
                    'value': 5.0,
                    'currency': 'IDR'
                });
            }
            // GA4 event
            if (typeof gtag === 'function') {
                gtag('event', 'phone_call', {
                    'event_category': 'conversion',
                    'event_label': 'click_to_call',
                    'value': 5
                });
            }
            // GTM dataLayer
            window.dataLayer = window.dataLayer || [];
            window.dataLayer.push({
                'event': 'phone_call',
                'eventCategory': 'conversion',
                'eventLabel': 'click_to_call'
            });
        });
    });

    // Track Google Maps / Location clicks
    document.querySelectorAll('a[href*="maps.app.goo.gl"], a[href*="google.com/maps"]').forEach(function(link) {
        link.addEventListener('click', function() {
            if (typeof gtag === 'function') {
                gtag('event', 'get_directions', {
                    'event_category': 'conversion',
                    'event_label': 'warehouse_visit',
                    'value': 3
                });
            }
            window.dataLayer = window.dataLayer || [];
            window.dataLayer.push({
                'event': 'get_directions',
                'eventCategory': 'conversion',
                'eventLabel': 'warehouse_visit'
            });
        });
    });
});
