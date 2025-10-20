<?php
    // Theme vars
    $parent = get_page_by_path('wat-wij-doen');
    $settings = get_field('services_settings');
    $title = $settings['title'] ?? '';
    $subtitle = $settings['subtitle'] ?? '';
    $cta = $settings['cta_link'] ?? null;

    $services = get_pages([
        'child_of' => $parent->ID,
        'sort_column' => 'menu_order',
        'sort_order' => 'ASC'
    ]);

    $structured = [
        '@context' => 'https://schema.org',
        '@type' => 'LocalBusiness',
        'name' => 'CZA Bouwbedrijf',
        'url' => home_url(),
        'service' => []
    ];

    foreach ($services as $service) {
        $name = get_the_title($service->ID);
        $service_data = get_field('service', $service->ID);
        $desc = $service_data['description'] ?? '';
        $type = $service_data['type'] ?? $name;
        $link = get_permalink($service->ID);

        $structured['service'][] = [
            '@type' => 'Service',
            'name' => $name,
            'description' => $desc,
            'serviceType' => $type,
            'url' => $link
        ];
    }

    echo '<script type="application/ld+json">' . json_encode($structured, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) . '</script>';
?>

<section class="services" itemscope itemtype="https://schema.org/LocalBusiness">
    <meta itemprop="name" content="CZA Bouwbedrijf">
    <meta itemprop="url" content="<?= esc_url(home_url()) ?>">

    <div class="services__container">
        <header class="services__header">
            <div class="services__heading" data-animate="fade-in-up">
                <?php if ($subtitle): ?><span class="service__subtitle sub-title"><?= esc_html($subtitle) ?></span><?php endif; ?>
                <?php if ($title): ?><h2 class="services__title heading-title"><?= esc_html($title) ?></h2><?php endif; ?>
            </div>
            <?php if ($cta && !empty($cta['url'])): ?>
                <a href="<?= esc_url($cta['url']) ?>" target="<?= esc_attr($cta['target'] ?? '_self') ?>" class="button button--tertiary services__cta" data-animate="fade-in-up">
                    <span class="button-label"><?= esc_html($cta['title']) ?></span>
                    <span class="button-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-right" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708" />
                        </svg>
                    </span>
                </a>
            <?php endif; ?>
        </header>

        <?php get_template_part( 'template-parts/layout/services', 'list' ); ?>

</section>