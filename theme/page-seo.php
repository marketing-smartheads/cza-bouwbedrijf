<?php
/*
Template Name: Landingspagina
*/
get_header();
$steps    = get_field('seo_steps');
?>

<?php get_template_part('template-parts/section', 'pagehero'); ?>

<?php get_template_part('template-parts/section', 'company'); ?>

<section class="cza-section" itemscope itemtype="https://schema.org/LocalBusiness">
    <div class="cza-section__container">

        <?php if ($steps): ?>
            <ol class="cza-steps-list">
                <?php foreach ($steps as $step): ?>
                <li class="cza-steps-list__item">
                    <?php if (!empty($step['title'])): ?>
                        <h3 class="cza-steps-list__title"><?php echo $step['title']; ?></h3>
                    <?php endif; ?>
                    <?php if (!empty($step['description'])): ?>
                        <div class="cza-steps-list__description"><?php echo $step['description']; ?></div>
                    <?php endif; ?>
                </li>
                <?php endforeach; ?>
            </ol>
        <?php endif; ?>

    </div>   
</section>

<?php get_template_part('template-parts/section', 'promo'); ?>

<?php get_template_part('template-parts/section', 'services'); ?>

<?php get_template_part('template-parts/section', 'quote'); ?>

<?php get_template_part('template-parts/section', 'inspiration'); ?>

<?php get_template_part('template-parts/section', 'tiktok'); ?>

<?php get_template_part('template-parts/service', 'area'); ?>


<?php get_footer(); ?>