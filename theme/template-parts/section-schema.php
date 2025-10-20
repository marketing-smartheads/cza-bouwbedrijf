<?php
/**
 * Inject structured data for CZA Bouwbedrijf
 */

$company = get_field('company');
$title   = $company['title'] ?? 'CZA Bouwbedrijf';
$desc    = wp_strip_all_tags($company['description'] ?? '');
$image   = $company['visual']['url'] ?? '';
$url     = home_url('/');
?>

<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "LocalBusiness",
  "name": "<?= esc_js($title) ?>",
  "description": "<?= esc_js($desc) ?>",
  "image": "<?= esc_url($image) ?>",
  "url": "<?= esc_url($url) ?>",
  "address": {
    "@type": "PostalAddress",
    "addressLocality": "Breda",
    "addressRegion": "Noord-Brabant",
    "addressCountry": "NL"
  },
  "contactPoint": {
    "@type": "ContactPoint",
    "contactType": "customer service",
    "url": "<?= esc_url($url) ?>/offerte-contact"
  }
}
</script>
