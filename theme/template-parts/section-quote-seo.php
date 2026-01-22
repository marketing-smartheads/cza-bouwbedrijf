
<?php
    $hero        = get_field('hero');
    $video       = $hero['video'] ?? null;

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
<?php if ( is_front_page() && !empty($video) ): ?>
    <div class="container mx-auto mt-20">
        <section class="hero hero--video">
            <div class="hero__video-wrapper">
                <div class="hero__video-loader"></div>
                <video class="hero__video" autoplay muted loop playsinline preload="auto">
                    <source src="<?= esc_url($video['url']) ?>" type="video/mp4">
                </video>
            </div>
        </section>
    </div>
<?php endif; ?>

<section class="quote" itemscope itemtype="https://schema.org/ContactPage">
     <?php if ( $image ): ?>
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

            <?php if (!empty($features)):  $index = $index ?? 0; ?>
                <aside class="quote__features" data-animate="fade-in-up">
                    <div class="whatsapp-cta-widget">
                        <h2 class="whatsapp-cta-widget__title">Even snel iets vragen?</h2>
                        <p class="whatsapp-cta-widget__text">
                            Onze voorman Ben staat klaar om uw vragen direct te beantwoorden.
                        </p>
                        <a href="https://wa.me/3197010288887" class="whatsapp-cta__button button button--primary" aria-label="Chat met Ben de voorman via WhatsApp">
                            <span class="whatsapp-cta__button-icon" aria-hidden="true">
                                 <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-whatsapp" viewBox="0 0 16 16">
                                    <path class="fill-green-500 group-hover:fill-white" d="M13.601 2.326A7.85 7.85 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.9 7.9 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.9 7.9 0 0 0 13.6 2.326zM7.994 14.521a6.6 6.6 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.56 6.56 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592m3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.73.73 0 0 0-.529.247c-.182.198-.691.677-.691 1.654s.71 1.916.81 2.049c.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232"/>
                                </svg>
                            </span>
                            <span class="whatsapp-cta__button-text">
                                Chat met Ben de Voorman
                            </span>
                        </a>
                    </div>
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