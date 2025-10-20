<?php
/*
Template Name: Contact
*/
get_header();    
?>

<?php get_template_part('template-parts/section', 'pagehero'); ?>

<?php

// Option page data
$phone   = get_field('phone', 'option') ?? '';
$email   = get_field('email', 'option') ?? '';

$address = get_field('footer', 'option')['address'] ?? '';

$contact = get_field('contact');
$contact_title        = $contact['title'] ?? '';
$contact_leading      = $contact['leading_title'] ?? '';
$contact_description  = $contact['description'] ?? '';
$contact_form_text    = $contact['form_text'] ?? '';
?>

<section class="quote pt-22" itemscope itemtype="https://schema.org/ContactPage">
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

            <aside class="quote__contact-info xl:pt-52" data-animate="fade-in-up">
                <div class="quote__address-block">
                    <h3 class="quote__address-title" data-animate="fade-in-up" >Postadres</h3>
                    <?php if ($address): ?>
                        <address class="quote__address not-italic" data-animate="fade-in-up" ><?= nl2br(esc_html($address)) ?></address>
                    <?php endif; ?>
                </div>

                <div class="quote__contact-block">
                    <h3 class="quote__contact-title" data-animate="fade-in-up" >Contactgegevens</h3>
                    <ul class="quote__contact-list">
                        <?php if ($phone): ?>
                        <li class="quote__contact-item" data-animate="fade-in-up" >
                            <span class="quote__contact-label">Telefoon:</span>
                            <a href="tel:<?= esc_attr($phone) ?>" class="quote__contact-link"><?= esc_html($phone) ?></a>
                        </li>
                        <?php endif; ?>
                        <?php if ($email): ?>
                        <li class="quote__contact-item" data-animate="fade-in-up" >
                            <span class="quote__contact-label">E-mail:</span>
                            <a href="mailto:<?= esc_attr($email) ?>" class="quote__contact-link"><?= esc_html($email) ?></a>
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