<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default. Please note that
 * this is the WordPress construct of pages: specifically, posts with a post
 * type of `page`.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package CZA_Bouwbedrijf
 */

get_header();

// Theme vars
$parent_id = wp_get_post_parent_id(get_the_ID());
$layout_class = $parent_id ? 'child-layout' : 'parent-layout';

$parent = get_page_by_path('wat-wij-doen');
$is_child_of_services = ($parent && get_the_ID() !== $parent->ID && get_post_field('post_parent', get_the_ID()) === $parent->ID);

// ACF vars
$content     = get_field('content');
$sub_title   = $content['sub_title'] ?? '';
$small_description   = $content['small_description'] ?? '';

$service_detail = get_field('service_detail');
$visual = $service_detail['visual'] ?? null;

$image_before     = !empty($service_detail['image_before']) ? $service_detail['image_before'] : null;
$content_before   = !empty($service_detail['content_before']) ? $service_detail['content_before'] : null;
$step_title       = !empty($service_detail['step_title']) ? $service_detail['step_title'] : null;
$step_description = !empty($service_detail['step_description']) ? $service_detail['step_description'] : null;
$image_after     = !empty($service_detail['image_after']) ? $service_detail['image_after'] : null;
$content_after   = !empty($service_detail['content_after']) ? $service_detail['content_after'] : null;

$phone   = get_field('phone', 'option') ?? '';
$email   = get_field('email', 'option') ?? '';

$address = get_field('footer', 'option')['address'] ?? '';

$contact = get_field('contact');
$contact_title        = $contact['title'] ?? '';
$contact_leading      = $contact['leading_title'] ?? '';
$contact_description  = $contact['description'] ?? '';
$contact_form_text    = $contact['form_text'] ?? '';
?>

<?php if (!$parent_id) : ?>
    <?php get_template_part('template-parts/section', 'pagehero'); ?>
<?php endif; ?>

<section class="hero__page" itemscope itemtype="https://schema.org/WebPageElement">
    <div class="hero__content">
        <h1 class="hero__post-title" itemprop="headline" data-animate="fade-in-up" data-delay="0">
            <?php the_title(); ?>
        </h1>

        <?php if ($sub_title): ?>
            <h2 class="hero__subtitle sub-title" data-animate="fade-in-up" data-delay="300"><?= esc_html($sub_title) ?></h2>   
        <?php endif; ?> 

        <?php if ($small_description) : ?>
            <div class="hero__description" data-animate="fade-in-up" data-delay="600">
                <?php echo wp_kses_post($small_description); ?>
            </div>
        <?php endif; ?> 
    </div>
</section>

<section class="extension" itemscope itemtype="https://schema.org/Service">
    <?php if ($is_child_of_services): ?>
        <div class="services">
            <?php get_template_part('template-parts/service-detail'); ?>
            
            <div class="services__item transition-all hover:bg-green-400/40" data-animate="fade-in-up">
                <a href="https://wa.me/3197010288887?text=Hoi%20Ben%2C%20ik%20wil%20graag%20de%2060-seconden%20check%20doen%20voor%20mijn%20verbouwing." target="_blank" class="group">
                    <div class="services__leading">
                        <h2 class="servicess__name">Past jouw verbouwing bij CZA?</h2>
                        <p class="flex items-center">
                        <span class="whatsapp--icon mr-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-whatsapp" viewBox="0 0 16 16">
                                <path class="fill-green-400 transition group-hover:fill-white" d="M13.601 2.326A7.85 7.85 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.9 7.9 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.9 7.9 0 0 0 13.6 2.326zM7.994 14.521a6.6 6.6 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.56 6.56 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592m3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.73.73 0 0 0-.529.247c-.182.198-.691.677-.691 1.654s.71 1.916.81 2.049c.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232"/>
                            </svg>
                        </span>    
                        Ben checkt je plan in 60 seconden via&nbsp;
                        <span class="underline font-medium">WhatsApp</span>.</p>
                    </div>
                </a>
            </div>

        </div>
    <?php endif; ?>
    <?php if ($visual): ?>
        <figure class="extension__image" itemprop="image" itemscope itemtype="https://schema.org/ImageObject" data-animate="fade-in-up" >
            <img src="<?php echo esc_url($visual['url']); ?>" alt="<?php echo esc_attr($visual['alt'] ?: 'Visualisatie van een woninguitbreiding'); ?>" loading="lazy" itemprop="contentUrl"
                width="<?php echo esc_attr($visual['width']); ?>" 
                height="<?php echo esc_attr($visual['height']); ?>"
            />
        </figure>
    <?php endif; ?>  
</section>

<section class="page-content">
    <div class="page-content__container" data-animate="fade-in-up">
        <?php the_content(); ?>
    </div>
</section>

<?php if ($image_before || $content_before):  ?>
<section class="comparison" itemscope itemtype="https://schema.org/Service">
    <div class="comparison__container comparison__before">
        <?php if ($image_before): ?>
            <figure class="comparison__item" itemprop="hasOfferCatalog" itemscope itemtype="https://schema.org/Offer" data-animate="fade-in-up" >
                <img src="<?php echo esc_url($image_before['url']); ?>" alt="<?php echo esc_attr($image_before['alt']); ?>" class="comparison__image" itemprop="image" />                
            </figure>
        <?php endif; ?>

        <?php if ($content_before): ?>
            <div class="comparison__content" data-animate="fade-in-up" >
                <?php echo wp_kses_post($content_before); ?>
            </div>
        <?php endif; ?>
    </div>
    
    <div class="comparison__container" data-animate="fade-in-up" >
        <h2 class="comparion__title"><?php echo wp_kses_post($step_title); ?></h2>
        <?php echo wp_kses_post($step_description); ?>
    </div>

    <div class="comparison__container comparison__steps">
        <?php if (!empty($service_detail['steps'])):            
            $delay = 0;
            $delay_step = 550; 
            ?>
            <ul class="steps__list">
                <?php foreach ($service_detail['steps'] as $step): 
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

    <div class="comparison__container comparison__after">
        <?php if ($image_after): ?>
            <figure class="comparison__item" itemprop="hasOfferCatalog" itemscope itemtype="https://schema.org/Offer" data-animate="fade-in-up" >
                <img src="<?php echo esc_url($image_after['url']); ?>" alt="<?php echo esc_attr($image_after['alt']); ?>" class="comparison__image" itemprop="image" />                
            </figure>
        <?php endif; ?>

        <?php if ($content_after): ?>
            <div class="comparison__content" data-animate="fade-in-up" >
                <?php echo wp_kses_post($content_after); ?>
            </div>
        <?php endif; ?>
    </div>
</section>
<?php endif; ?>

<?php get_template_part('template-parts/section', 'promo'); ?>

<section class="quote" itemscope itemtype="https://schema.org/ContactPage">
    <div class="quote__container mt-0! pb-0!">
        <div class="quote__content">

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


<?php
get_footer();