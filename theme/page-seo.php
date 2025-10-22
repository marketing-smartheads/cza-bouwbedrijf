<?php
/*
Template Name: Landingspagina
*/
get_header();

// ACF Vars
$seo = get_field('seo');
$services = is_array($seo['services'] ?? null) ? $seo['services'] : [];
$service_title = array_reduce($services, function ($carry, $block) {
    return $carry ?: ($block['acf_fc_layout'] === 'content' && !empty($block['title']) ? $block['title'] : null);
});

$guide      = get_field('inspiration_guide');
$title      = !empty($guide['title']) ? $guide['title'] : 'Download de inspiratiegids';
$sub_title  = !empty($guide['sub_title']) ? $guide['sub_title'] : 'Bekijk 10 projecten gerealiseerd in Eindhoven';
$image      = !empty($guide['image']) ? $guide['image']['url'] : null;
$visual     = !empty($guide['visual']) ? $guide['visual']['url'] : null;

?>

<?php get_template_part('template-parts/section', 'pagehero'); ?>

<?php get_template_part('template-parts/section', 'company'); ?>

<section class="cza-section" itemscope itemtype="https://schema.org/LocalBusiness">
    <div class="cza-section__container">
        <?php if (!empty($seo['main_text'])) : ?>
            <div class="cza-main-text" data-animate="fade-in-up">
                <?php echo $seo['main_text']; ?>
            </div>
        <?php endif; ?>
        <?php
            $steps = is_array(get_field('seo_steps')) ? get_field('seo_steps') : [];
            if ($steps): ?>
            <ol class="cza-steps-list">
                <?php foreach ($steps as $step): ?>
                <li class="cza-steps-list__item" data-animate="fade-in-up">
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

<?php get_template_part('template-parts/section', 'primarypromo'); ?>

<?php if (!empty($service_title)): ?>
<section class="services seo_services">
    <div class="services__container">
        <header class="services__header">
            <div class="services__heading" data-animate="fade-in-up">                
                <h2 class="services__title heading-title"><?= esc_html($service_title) ?></h2>
            </div>
            
            <a href="<?= esc_url(get_site_url() . '/wat-wij-doen') ?>" class="button button--tertiary services__cta" data-animate="fade-in-up">
                <span class="button-label">Bekijk diensten</span>
                <span class="button-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-right" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708" />
                    </svg>
                </span>
            </a>
        </header>

        <?php get_template_part('template-parts/layout/services', 'list-seo'); ?>
    </div>
</section>
<?php endif; ?>

<?php get_template_part('template-parts/section', 'quote'); ?>

<?php get_template_part('template-parts/cza', 'seoblocks'); ?>

<?php get_template_part('template-parts/section', 'inspiration'); ?>

<section class="reviews">
    <h2>Wat onze klanten zeggen</h2>
    <?php echo do_shortcode('[trustindex no-registration=google]'); ?>
</section>

<?php get_template_part('template-parts/section', 'tiktok'); ?>

<section class="inspiration-guide" itemscope itemtype="https://schema.org/WebPage">
 
    <div class="inspiration-guide__container">
        <div class="inspiration-guide__content" itemprop="mainContentOfPage">            
            <?php if ($image): ?>            
                <img class="inspiration-guide__image" src="<?php echo esc_url($image); ?>" alt="Inspiratiegids" itemprop="image" loading="lazy" width="1905" height="473" />                
            <?php endif; ?>
            <div class="inspiration-guide__form-container">
                <div class="inspiration-guide__form-wrapper" itemprop="potentialAction" itemscope itemtype="https://schema.org/SubscribeAction">
                    <div class="inspiration-guide__form">
                        <h2 class="inspiration-guide__title" itemprop="headline">
                            <?php echo esc_html($title); ?>
                        </h2>

                        <p class="inspiration-guide__subtitle">
                            <?php echo esc_html($sub_title); ?>
                        </p>

                        <?php if ($visual): ?>
                            <img class="inspiration-guide__background-image" src="<?php echo esc_url($visual); ?>" alt="Visueel" loading="lazy" width="317" height="200" />                    
                        <?php endif; ?>

                        <?php echo do_shortcode('[contact-form-7 id="c4dd875" title="Inspiratiegids"]'); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php get_template_part('template-parts/service', 'area'); ?>


<?php get_footer(); ?>