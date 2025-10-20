
<?php
$footer = get_field('footer', 'option');

$logo_url = get_theme_file_uri('/assets/img/Logo.svg');
$site_name = get_bloginfo('description');

// Structured data array
$structuredData = [
    "@context" => "https://schema.org",
    "@type" => "Service",
    "name" => "Bouw- en Renovatiediensten",
    "description" => "Professionele vakmensen voor renovatie, sloop en bouwprojecten. Vraag vrijblijvend een offerte aan.",
    "provider" => [
        "@type" => "Organization",
        "name" => $site_name,
        "url" => home_url(),
        "logo" => $logo_url,
        "address" => [
            "@type" => "PostalAddress",
            "streetAddress" => $footer['address'] ?? 'Huufkes 62a',
            "addressLocality" => "Neunen",
            "postalCode" => "5674 TM",
            "addressCountry" => "NL"
        ],
        "contactPoint" => [
            "@type" => "ContactPoint",
            "telephone" => $footer['phone'] ?? "+31 (0)492 35 08 55",
            "email" => $footer['email'] ?? "info@czabouwbedrijf.nl",
            "contactType" => "customer service",
            "areaServed" => "NL",
            "availableLanguage" => ["Dutch", "English"]
        ]
    ],
    "areaServed" => [
        "@type" => "Country",
        "name" => "Netherlands"
    ],
    "serviceType" => "Renovatie, Sloop, Bouw",
    "availableChannel" => [
        "@type" => "ServiceChannel",
        "serviceUrl" => home_url('/offerte-contact'),
        "availableLanguage" => ["Dutch"]
    ],
    "hasOfferCatalog" => [
        "@type" => "OfferCatalog",
        "name" => "Offerte opties",
        "itemListElement" => [
            [
                "@type" => "Offer",
                "itemOffered" => [
                    "@type" => "Service",
                    "name" => "Renovatiewerk"
                ],
                "priceCurrency" => "EUR",
                "eligibleRegion" => "NL"
            ],
            [
                "@type" => "Offer",
                "itemOffered" => [
                    "@type" => "Service",
                    "name" => "Sloopwerk"
                ],
                "priceCurrency" => "EUR",
                "eligibleRegion" => "NL"
            ],
            [
                "@type" => "Offer",
                "itemOffered" => [
                    "@type" => "Service",
                    "name" => "Nieuwbouw"
                ],
                "priceCurrency" => "EUR",
                "eligibleRegion" => "NL"
            ]
        ]
    ]
];
?>

<script type="application/ld+json">
<?= json_encode($structuredData, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) ?>
</script>
<?php
$cta = get_field('cta', 'option');
$image = $cta['image'] ?? null;
$title = $cta['leading_title'] ?? '';
$description = $cta['description'] ?? '';
$buttons = $cta['buttons'] ?? [];
?>
<section class="cta-section" data-animate="fade-in-up">
    <div class="cta-section__container">

        <?php if ($image): ?>
            <div class="cta-section__image">
                <img src="<?= esc_url($image['url']) ?>" alt="<?= esc_attr($image['alt'] ?? 'CTA afbeelding') ?>" />
            </div>
        <?php endif; ?>

        <div class="cta-section__content">
            <?php if ($title): ?>
                <h2 class="cta-section__title"><?= wp_kses_post($title) ?></h2>
            <?php endif; ?>

            <?php if ($description): ?>
                <p class="cta-section__description"><?= wp_kses_post($description) ?></p>
            <?php endif; ?>

            <?php if (!empty($buttons)): ?>
                <div class="cta-section__actions">
                    <?php foreach ($buttons as $button): 
                        $link = $button['link'] ?? null;
                        $style = $button['style'] ?? 'primary';
                        if ($link):
                        $class = 'cta-section__button button button--' . esc_attr($style);
                    ?>
                    <a href="<?= esc_url($link['url']) ?>" class="<?= $class ?>" target="<?= esc_attr($link['target'] ?? '_self') ?>">
                        <span class="button-label"><?= esc_html($link['title']) ?></span>
                        <span class="button-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-right" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708" />
                            </svg>
                        </span>
                    </a>
                    <?php endif; endforeach; ?>
                </div>
            <?php endif; ?>
        </div>

    </div>
</section>
