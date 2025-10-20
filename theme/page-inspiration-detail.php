<?php
/*
Template Name: Inspiratie (Detail)
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

    $inspiration = get_field('inspiration');
    $carousel = $inspiration['carousel'] ?? null;
    $content = $inspiration['content'] ?? null; 
    $continued  = $inspiration['continued'] ?? null;
?>

<section class="project">    
    <div class="project__container">      
        <?php if (!empty($content)) : ?>
            <div class="project__content">
                <h1 class="project__title"><?php the_title(); ?></h1>
                <?php echo wp_kses_post($content); ?>
            </div>
        <?php endif; ?>
        <?php if ($carousel): ?>
            <div class="project-carousel">
                <div class="project-carousel__track" id="projectCarouselTrack">
                    <?php foreach ($carousel as $image): ?>
                        <div class="project-carousel__slide">
                            <figure class="project-carousel__figure">
                                <img src="<?= esc_url($image['url']); ?>" alt="<?= esc_attr($image['alt']); ?>" class="project-carousel__image">
                                <?php if (!empty($image['caption'])): ?>
                                    <figcaption class="project-carousel__caption"><?= esc_html($image['caption']); ?></figcaption>
                                <?php endif; ?>
                            </figure>
                        </div>
                    <?php endforeach; ?>
                </div>
                
                <div class="project-carousel__nav">                
                    <button class="project-carousel__nav--prev" onclick="scrollCarousel(-1)" aria-label="Vorige slide">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8"/>
                        </svg>
                    </button>
                    <button class="project-carousel__nav--next" onclick="scrollCarousel(1)" aria-label="Volgende slide">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8"/>
                        </svg>
                    </button>
                </div>
            </div>
        <?php endif; ?>
    </div>
    <?php if(!empty($continued)) : ?>
    <div class="project__continued">
            <div class="content">
                <?php echo wp_kses_post($continued); ?>
            </div>
        
          <?php
            $inspiration = get_field('inspiration');
            if (!empty($inspiration['properties'])) : ?>
                <aside class="project__tags">                    
            
                <ul class="project__tags-list">
                    <?php foreach ($inspiration['properties'] as $property) :
                        $label = $property['label'] ?? '';
                        $value = $property['value'] ?? '';
                        if ($label && $value) : ?>
                            <li class="project__tag">
                                <span class="project__tag-label"><?php echo esc_html($label); ?>:</span>
                                <span class="project__tag-value"><?php echo esc_html($value); ?></span>
                            </li>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </ul>


                <a href="<?php echo get_site_url(); ?>/offerte-contact" class="button button--primary hero--button" itemprop="url">
                    <span class="button-label">Neem vrijblijvend contact op</span>
                    <span class="button-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-right" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708" />
                        </svg>
                    </span>
                </a>
            </aside>
            
        <?php endif; ?>
    </div>
    <?php endif; ?>
    <div class="comparison__container comparison__steps pb-16">
        <?php if (!empty($inspiration['steps'])):            
            $delay = 0;
            $delay_step = 550; 
            ?>
            <ul class="steps__list">
                <?php foreach ($inspiration['steps'] as $step): 
                    $image       = $step['image'];
                    $title       = $step['title'];
                    $description = $step['description'];
                ?>
                <li class="steps__item" data-animate="fade-in-up" data-delay="<?php echo $delay; ?>">
                    <?php if ($image): ?>
                        <div class="steps__image">
                            <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt'] ?: $title); ?>" />
                        </div>
                    <?php endif; ?>

                    <?php if ($title): ?>
                        <h3 class="steps__title"><?php echo esc_html($title); ?></h3>
                    <?php endif; ?>

                    <?php if ($description): ?>
                        <p class="steps__description"><?php echo wp_kses_post($description); ?></p>
                    <?php endif; ?>
                </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </div>
</section>


<section class="quote relative -top-22" itemscope itemtype="https://schema.org/ContactPage">
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