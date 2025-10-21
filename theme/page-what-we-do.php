<?php
/*
Template Name: Wat wij doen
*/
get_header();
    // ACF Vars
    $phone   = get_field('phone', 'option') ?? '';
    $email   = get_field('email', 'option') ?? '';

    $address = get_field('footer', 'option')['address'] ?? '';

    $contact = get_field('contact');
    $contact_title        = $contact['title'] ?? '';
    $contact_leading      = $contact['leading_title'] ?? '';
    $contact_description  = $contact['description'] ?? '';
    $contact_form_text    = $contact['form_text'] ?? '';

    // Theme vars
    $parent = get_page_by_path('wat-wij-doen');
    $services = get_pages([
        'child_of' => $parent->ID,
        'sort_column' => 'menu_order',
        'sort_order' => 'ASC'
    ]);

    // Structured JSON Data
    $services = get_pages([
        'child_of' => $parent->ID,
        'sort_column' => 'menu_order',
        'sort_order' => 'ASC'
    ]);

    $structured = [
        '@context' => 'https://schema.org',
        '@type' => 'LocalBusiness',
        'name' => 'CZA Bouwbedrijf',
        'url' => get_permalink(),
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

<?php get_template_part('template-parts/section', 'pagehero'); ?>

<section class="services -mt-52 pt-0 pb-16 px-4" itemscope itemtype="https://schema.org/LocalBusiness">
    <meta itemprop="name" content="CZA Bouwbedrijf">
    <meta itemprop="url" content="<?= esc_url(get_permalink()) ?>">
    <div class="xl:container xl:mx-auto pb-16">
        <?php get_template_part( 'template-parts/layout/services', 'list' ); ?>
    </div>
</section>

<section class="page-content">
    <div class="page-content__container" data-animate="fade-in-up">
        <?php the_content(); ?>
    </div>
</section>

<?php get_template_part( 'template-parts/layout/service', 'items' ); ?>

<section class="quote" itemscope itemtype="https://schema.org/ContactPage">
    <div class="quote__container top-0!">
        <div class="quote__content items-start!">

            <div class="quote__form-wrapper" data-animate="fade-in-up">
                <header class="quote__header pb-16" data-animate="fade-in-up">
                    <?php if ($contact_title): ?>
                        <h2 class="quote__title"><?= esc_html($contact_title) ?></h2>   
                    <?php endif; ?>

                    <?php if ($contact_leading): ?>
                    <h3 class="quote__leading"><?= esc_html($contact_leading) ?></h3>
                    <?php endif; ?>
                    <?php if ($contact_description): ?>
                    <p class="quote__description"><?= esc_html($contact_description) ?></p>
                    <?php endif; ?>

                </header>
                <div class="quote__form">

                    <?php if ($contact_form_text): ?>
                    <h4 class="quote__form-text">
                        <?= wp_kses_post($contact_form_text) ?>
                    </h4>
                    <?php endif; ?>

                    <?php echo do_shortcode('[contact-form-7 id="cd42577" title="Contactformulier 1"]'); ?>

                </div>
            </div>

            <!-- Contactgegevens en adres (zoals eerder besproken) -->
            <aside class="quote__contact-info xl:pt-52" data-animate="fade-in-up">
                <div class="quote__address-block">
                    <h3 class="quote__address-title">Postadres</h3>
                    <?php if ($address): ?>
                    <address class="quote__address not-italic"><?= nl2br(esc_html($address)) ?></address>
                    <?php endif; ?>
                </div>

                <div class="quote__contact-block">
                    <h3 class="quote__contact-title">Contactgegevens</h3>
                    <ul class="quote__contact-list">
                        <?php if ($phone): ?>
                        <li class="quote__contact-item">
                            <span class="quote__contact-label">Telefoon:</span>
                            <a href="tel:<?= esc_attr($phone) ?>"
                                class="quote__contact-link"><?= esc_html($phone) ?></a>
                        </li>
                        <?php endif; ?>
                        <?php if ($email): ?>
                        <li class="quote__contact-item">
                            <span class="quote__contact-label">E-mail:</span>
                            <a href="mailto:<?= esc_attr($email) ?>"
                                class="quote__contact-link"><?= esc_html($email) ?></a>
                        </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </aside>

        </div>
    </div>
</section>

<?php get_template_part('template-parts/section', 'tiktok'); ?>

<?php get_footer(); ?>