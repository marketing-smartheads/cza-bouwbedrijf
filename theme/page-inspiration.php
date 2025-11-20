<?php
/*
Template Name: Inspiratie
*/
get_header();
     // Theme vars
    $site_name     = get_bloginfo('name');
    $site_url      = get_site_url();
    $logo_url      = get_theme_file_uri('/assets/img/Logo.svg');

    $parent = get_page_by_path('inspiratie');
    $services = get_pages([
        'child_of' => $parent->ID,
        'sort_column' => 'menu_order',
        'sort_order' => 'ASC'
    ]);

    // ACF Vars
    $phone   = get_field('phone', 'option') ?? '';
    $email   = get_field('email', 'option') ?? '';

    $address = get_field('footer', 'option')['address'] ?? '';

    $contact = get_field('contact');
    $contact_title        = $contact['title'] ?? '';
    $contact_leading      = $contact['leading_title'] ?? '';
    $contact_description  = $contact['description'] ?? '';
    $contact_form_text    = $contact['form_text'] ?? '';

?>

<?php get_template_part('template-parts/section', 'pagehero'); ?>

<section class="inspiration-grid" itemscope itemtype="https://schema.org/Service">
    <div class="inspiration-grid__container">
        <header class="inspiration__header" data-animate="fade-in-up">
            <?php the_content(); ?>
        </header>

        <div class="inspiration__cards">
            
            <?php 
                $delay = 0;
                foreach ($services as $service): 
                    $image_url = get_the_post_thumbnail_url($service->ID, 'large');
                    $acf_group = get_field('inspiration', $service->ID);
                    $location = $acf_group['location'] ?? '';
                    $title = get_the_title($service->ID);
                    $permalink = get_permalink($service->ID);                    

                    $delay += 150;
                    $delay_value = number_format($delay, 2);
                
            ?>
                <article class="inspiration__card" itemprop="hasOfferCatalog" itemscope itemtype="https://schema.org/OfferCatalog"  
                onclick="window.location.href='<?= esc_url($permalink) ?>'" data-animate="fade-in-up" data-delay="<?= esc_attr($delay_value) ?>">
                    <?php if ($image_url): ?>
                        <figure class="inspiration__image-wrapper">
                            <img src="<?= esc_url($image_url) ?>" alt="<?= esc_attr($title) ?>" class="inspiration__image" itemprop="image" width="475" height="325" loading="lazy" />
                        </figure>
                    <?php else : ?>
                        <div class="inspiration__fallback" aria-label="Geen afbeelding beschikbaar">
                            <a href="<?= esc_url($site_url) ?>" title="<?= esc_attr($site_name) ?>" class="inspiration__fallback-logo" itemprop="url">
                                <img src="<?= esc_url($logo_url) ?>" alt="<?= esc_attr($site_name) ?>" loading="lazy" itemprop="logo" width="324" height="165" loading="lazy" />
                            </a>
                        </div>
                    <?php endif; ?>

                    <div class="inspiration__content">
                        <div class="inspiration__contains">
                            <?php if ($location): ?>
                                <h2 class="inspiration__location" itemprop="areaServed"><?= esc_html($location) ?></h2>
                            <?php endif; ?>                    
                            <h3 class="inspiration__service <?= empty($location) ? ' pt-8' : '' ?>" itemprop="name"><?= esc_html($title) ?></h3>                        
                        </div>
                        <a href="<?= esc_url($permalink) ?>" class="button button--tertiary">
                            <span class="button-label">Bekijk</span>
                            <span class="button-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-right" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708" />
                                </svg>
                            </span>
                        </a>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>

    </div>
</section>


<section class="quote pt-0" itemscope itemtype="https://schema.org/ContactPage">
    <div class="quote__container -mt-10! pb-16!">
        <div class="quote__content gap-16! lg:pl-10!">

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