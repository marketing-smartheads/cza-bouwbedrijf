
<?php
    $quote = get_field('quote_section');
    $image = $quote['image'] ?? null;
    $title = $quote['title'] ?? '';
    $subtitle = $quote['subtitle'] ?? '';
    $features = $quote['features'] ?? [];

    $structured = [
        '@context' => 'https://schema.org',
        '@type' => 'ContactPage',
        'name' => $title ?: 'Offerte aanvragen',
        'description' => $subtitle ?: 'Binnen 24 uur reactie van onze vakmannen',
        'image' => $image ? $image['url'] : null,
        'mainEntity' => [
            '@type' => 'ContactPoint',
            'contactType' => 'Customer Service',
            'availableLanguage' => ['Dutch'],
            'url' => home_url('/offerte-aanvragen'),
            'areaServed' => 'NL',
            'contactOption' => ['TollFree', 'OnlineContactForm'],
        ],
        'potentialAction' => [
            '@type' => 'CommunicateAction',
            'target' => home_url('/offerte-aanvragen'),
            'description' => 'Neem vrijblijvend contact op via ons offerteformulier'
        ],
        'hasPart' => []
    ];

    foreach ($features as $feature) {
        $structured['hasPart'][] = [
            '@type' => 'WebPageElement',
            'name' => $feature['text'],
            'description' => $feature['text']
        ];
    }

    echo '<script type="application/ld+json">' . json_encode($structured, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) . '</script>';
?>

<section class="quote" itemscope itemtype="https://schema.org/ContactPage">
    <?php if ($image): ?>
        <div class="quote__visual" data-animate="fade-in-up">
            <img src="<?= esc_url($image['url']) ?>" alt="<?= esc_attr($image['alt'] ?? 'Offerte visual') ?>" class="quote__image" loading="lazy" decoding="async" />
        </div>
    <?php endif; ?>

    <div class="quote__container">      

        <div class="quote__content">
            <div class="quote__form-wrapper" data-animate="fade-in-up">
                <div class="quote__form">
                    <header class="quote__header" data-animate="fade-in-up">
                        <?php if ($title): ?><h2 class="quote__title"><?= esc_html($title) ?></h2><?php endif; ?>
                        <?php if ($subtitle): ?><p class="quote__subtitle"><?= esc_html($subtitle) ?></p><?php endif; ?>
                    </header>
                        <?php echo do_shortcode('[contact-form-7 id="cd42577" title="Contactformulier 1"]'); ?>
                </div>
            </div>

            <?php if (!empty($features)): ?>
                <aside class="quote__features" data-animate="fade-in-up">
                    <ul class="quote__list">
                        <?php foreach ($features as $feature): ?>
                            <li class="quote__item" data-animate="fade-in-up" data-delay="<?= $index * 0.15 ?>">
                                <span class="quote--icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-check2-square" viewBox="0 0 16 16">
                                        <path d="M3 14.5A1.5 1.5 0 0 1 1.5 13V3A1.5 1.5 0 0 1 3 1.5h8a.5.5 0 0 1 0 1H3a.5.5 0 0 0-.5.5v10a.5.5 0 0 0 .5.5h10a.5.5 0 0 0 .5-.5V8a.5.5 0 0 1 1 0v5a1.5 1.5 0 0 1-1.5 1.5z"/>
                                        <path d="m8.354 10.354 7-7a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0"/>
                                    </svg>
                                </span>
                                <span class="quote--label"><?= esc_html($feature['text']) ?></span>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </aside>
            <?php endif; ?>
        </div>
    </div>
</section>