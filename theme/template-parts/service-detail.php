<?php

$service_data = get_field('service', get_the_ID());
$desc = $service_data['description'] ?? '';
$type = $service_data['type'] ?? get_the_title();
$icon = $service_data['icon'] ?? null;

?>
    
<div class="services__item" data-animate="fade-in-up">
    <meta itemprop="serviceType" content="<?= esc_attr($type) ?>">

    <div class="services__leading">
        <h2 class="services__name" itemprop="name"><?= esc_html($type) ?></h2>
        <?php if ($icon): ?>
            <span class="services__icon" aria-hidden="true">
                <img src="<?= esc_url($icon['url']) ?>" alt="<?= esc_attr($icon['alt'] ?? $type) ?>" class="services__icon-image" loading="lazy" />
            </span>
        <?php endif; ?>
    </div>

    <p class="services__description" itemprop="description"><?= esc_html($desc) ?></p>

    <a href="<?php echo get_site_url(); ?>/offerte-contact" class="button button--simple services__button" aria-hidden="true">
        <span class="button-label group-hover:text-primary">Vraag offerte aan</span>
        <span class="button-icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-arrow-right group-hover:fill-primary" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8"/>
            </svg>
        </span>
    </a>
</div>