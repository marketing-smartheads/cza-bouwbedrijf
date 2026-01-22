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
                    <h3 class="quote__address-title" data-animate="fade-in-up" >Headquarter</h3>
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
                        <li class="quote__contact-item" data-animate="fade-in-up">
                            <span class="quote__contact-label">E-mail:</span>
                            <a href="mailto:<?= esc_attr($email) ?>" class="quote__contact-link"><?= esc_html($email) ?></a>
                        </li>
                        <?php endif; ?>                        
                    </ul>
                </div>
                
                <div class="quote__contact-block shadow-xl rounded-sm mt-8 px-4 py-6 xl:px-6 bg-white transtion hover:bg-green-400/40" data-animate="fade-in-up">
                    <a href="https://wa.me/3197010288887?text=Hoi%20Ben%2C%20ik%20wil%20graag%20de%2060-seconden%20check%20doen%20voor%20mijn%20verbouwing." target="_blank" class="group">
                        <h3 class="quote__contact-title mt-0" data-animate="fade-in-up">Doe de 60-seconden <br/>check:</h3>
                        <img src="https://czabouwbedrijf.nl/wp-content/uploads/2026/01/WhatsApp-Image-2026-01-20-at-22.16.01.jpeg" alt="Ben de Voorman" loading="lazy" width="750" height="731" class="quote__contact-photo w-full object-cover rounded-sm h-80">
                        <ul class="quote__contact-list mt-5">
                            <li class="quote__contact-item rounded-sm border-1 px-4 py-2.5 flex max-lg:flex-col gap-2 lg:items-center" data-animate="fade-in-up">                                                               
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" class="bi bi-whatsapp" viewBox="0 0 16 16">
                                    <path class="transtion fill-green-400 group-hover:fill-white" d="M13.601 2.326A7.85 7.85 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.9 7.9 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.9 7.9 0 0 0 13.6 2.326zM7.994 14.521a6.6 6.6 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.56 6.56 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592m3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.73.73 0 0 0-.529.247c-.182.198-.691.677-.691 1.654s.71 1.916.81 2.049c.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232"/>
                                </svg>
                            </span>    
                            Check of jouw verbouwing bij CZA past.                                
                            </li>                    
                        </ul>
                    </a>
                </div>

            </aside>
        </div>
    </div>
</section>

<?php get_template_part('template-parts/section', 'tiktok'); ?>



<?php get_footer(); ?>