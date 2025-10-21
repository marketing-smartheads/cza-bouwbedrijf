<?php
/**
 * Front-page template for CZA Bouwbedrijf
 *
 * @package CZA_Bouwbedrijf
 */

get_header();

?>

<?php get_template_part('template-parts/section', 'hero'); ?>

<?php get_template_part('template-parts/section', 'company'); ?>

<?php get_template_part('template-parts/section', 'services'); ?>

<?php get_template_part('template-parts/section', 'quote'); ?>

<?php get_template_part('template-parts/cza', 'blocks'); ?>

<?php get_template_part('template-parts/section', 'inspiration'); ?>

<?php get_template_part('template-parts/section', 'promo'); ?>

<section class="reviews">
    <h2>Wat onze klanten zeggen</h2>
    <?php echo do_shortcode('[trustindex no-registration=google]'); ?>
</section>

<?php get_template_part('template-parts/section', 'tiktok'); ?>

<?php get_template_part('template-parts/section', 'content'); ?>

<?php get_template_part('template-parts/service', 'area'); ?>

<?php get_footer(); ?>