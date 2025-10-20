<?php
    // ACF Vars
    $company         = get_field('company');
    $visual          = $company['visual'] ?? null;
    $visual_url      = $visual['url'] ?? '';
    $visual_alt      = $visual['alt'] ?? '';
    $services        = $company['services'] ?? [];
    $title           = $company['title'] ?? '';
    $description     = $company['description'] ?? '';
    $button          = $company['button'] ?? null;
    $button_link     = is_array($button) ? ($button['url'] ?? '') : '';
    $button_label    = is_array($button) ? ($button['title'] ?? '') : '';
    $button_target   = is_array($button) ? ($button['target'] ?? '_self') : '_self';
?>

<section class="company" itemscope itemtype="https://schema.org/LocalBusiness">
    <div class="company__container">
        <div class="company__visual">
            <?php if ($visual_url): ?>
                <img src="<?= esc_url($visual_url) ?>" alt="<?= esc_attr($visual_alt ?: 'Visual van Team CZA Bouwbedrijf') ?>" class="company__image" itemprop="image" loading="lazy">
            <?php endif; ?>

            <?php if (!empty($services)): ?>
                <?php foreach ($services as $service): ?>
                    <?php
                        $link = $service['service'] ?? null;
                        $label = is_array($link) && !empty($link['title']) ? $link['title'] : '';
                        $top   = isset($service['top']) && is_numeric($service['top']) ? $service['top'] : '';
                        $left  = isset($service['left']) && is_numeric($service['left']) ? $service['left'] : '';
                    ?>
                    <?php if ($label && $top !== '' && $left !== ''): ?>
                        <?php if (!empty($link['url'])): ?>
                            <a href="<?= esc_url($link['url']) ?>" target="<?= esc_attr($link['target'] ?? '_self') ?>" class="company__label-pop label-trigger" style="top: <?= esc_attr($top) ?>%; left: <?= esc_attr($left) ?>%;" data-label="<?= esc_attr($label) ?>">
                                <span class="company__icon"></span>
                                <span class="company__label"><?= esc_html($label) ?></span>
                            </a>
                        <?php else: ?>
                            <span class="company__label-pop"><?= esc_html($label) ?></span>
                        <?php endif; ?>
                    <?php endif; ?>
                <?php endforeach; ?>
            <?php endif; ?>

            <div id="label-tooltip" class="company__tooltip opacity-0">
                <span id="label-tooltip-text"></span>
            </div>
        </div>

        <header class="company__header">
            <?php if ($title): ?>
                <h2 class="company__title" itemprop="name"><?= esc_html($title) ?></h2>
            <?php endif; ?>

            <?php if ($description): ?>
                <div class="company__description" itemprop="description">
                    <?= wp_kses_post($description) ?>
                </div>
            <?php endif; ?>

            <?php if ($button_link && $button_label): ?>
                <a href="<?= esc_url($button_link) ?>" target="<?= esc_attr($button_target) ?>" class="button button--primary company__cta-button" itemprop="url">
                    <span class="button-label"><?= esc_html($button_label) ?></span>
                    <span class="button-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-right" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708" />
                        </svg>
                    </span>
                </a>
            <?php endif; ?>
        </header>
    </div>
</section>