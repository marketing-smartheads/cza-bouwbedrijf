<?php
/**
 * Template part for displaying the footer content
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package CZA_Bouwbedrijf
 */

// Theme vars
$site_name     = get_bloginfo('name');
$site_url      = get_site_url();
$logo_url      = get_theme_file_uri('/assets/img/Logo.svg');
$logo_mark_url = get_theme_file_uri('/assets/img/Logomark.svg');
$page_id       = get_the_ID();

// ACF Vars
$social_links = [];
if (!empty($site_header['social_media'])) {
    foreach ($site_header['social_media'] as $item) {
        $url = $item['url'] ?? '';
        if (filter_var($url, FILTER_VALIDATE_URL)) {
            $social_links[] = esc_url($url);
        }
    }
}

$site_header = get_field('site_header', 'option');
$site_footer = get_field('footer', 'option');

$email   = $site_header['email'] ?? null;
$phone   = $site_header['phone'] ?? null;

$address = $site_footer['address'] ?? null;

$column_title_contact       = $site_footer['column_title__contact'] ?? 'Contact';
$column_title_menu          = $site_footer['column_title__menu'] ?? 'Snel naar';
$column_title_certification = $site_footer['column_title__certification'] ?? 'Certificering';
$column_description_cert    = $site_footer['column_description__certification'] ?? '';
$certifications             = $site_footer['certifications'] ?? [];

$popup = get_fields('option');

?>

<?php get_template_part('template-parts/section', 'cta'); ?>

<?php
// Only render popup markup when relevant ACF popup fields exist
$has_popup = !empty($popup) && (
    !empty($popup['popup_title']) ||
    !empty($popup['popup_text']) ||
    !empty($popup['popup_button_text']) ||
    !empty($popup['popup_image'])
);
?>

<?php if ($has_popup): ?>
<div class="popup-overlay" id="popup-overlay"></div>

<aside class="popup" id="popup" role="dialog" aria-modal="true" aria-labelledby="popup-title">

    <button class="popup__close" id="popup-close" aria-label="Sluit popup">
        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
            <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8z"/>
        </svg>
    </button>

    <?php if (!empty($popup['popup_image'])): ?>
    <figure class="popup__image">
        <img src="<?php echo esc_url($popup['popup_image']['url']); ?>" alt="<?php echo esc_attr($popup['popup_image']['alt']); ?>" loading="lazy">
    </figure>
    <?php endif; ?>

    <header class="popup__header">
        <h2 class="popup__title" id="popup-title">
            <?php echo esc_html($popup['popup_title']); ?>
        </h2>

        <p class="popup__subtitle">
            <?php echo esc_html($popup['popup_subtitle']); ?>
        </p>
    </header>

    <div class="popup__content ">
        <p class="popup__text">
            <?php echo esc_html($popup['popup_text']); ?>
        </p>
    </div>

    <footer class="popup__footer">
       <?php echo do_shortcode('[contact-form-7 id="c4dd875" title="Inspiratiegids"]'); ?>
    </footer>

</aside>
<?php endif; ?>


<a href="https://wa.me/3197010288887" target="_blank" class="whatsapp-popup group animate-inAndBreathe"> 
    <span class="whatsapp-svg">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-whatsapp" viewBox="0 0 16 16">
            <path class="group-hover:fill-white" d="M13.601 2.326A7.85 7.85 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.9 7.9 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.9 7.9 0 0 0 13.6 2.326zM7.994 14.521a6.6 6.6 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.56 6.56 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592m3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.73.73 0 0 0-.529.247c-.182.198-.691.677-.691 1.654s.71 1.916.81 2.049c.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232"/>
        </svg>
    </span>
    <p><span class="group-hover:text-foreground">Stel je vraag aan:</span><span class="group-hover:text-foreground">Ben de Voorman</span></p>
</a>

<footer id="colophon" class="site-footer" itemscope itemtype="https://schema.org/WPFooter">
    <div class="site-footer__container" itemscope itemtype="https://schema.org/Organization">

        <div class="site-footer__heading">
            <a href="<?php echo esc_url($site_url); ?>" title="<?php echo esc_attr($site_name); ?>"
                class="site_footer__logo" itemprop="url">
                <img src="<?php echo esc_url($logo_url); ?>" alt="<?php echo esc_attr($site_name); ?>" width="324"
                    height="165" loading="lazy" itemprop="logo" class="site_footer__logo-image">
            </a>

            <?php if (!empty($site_header['social_media'])) : ?>
            <ul class="site_footer__social-list" role="list">
                <?php foreach ($site_header['social_media'] as $item) :
                        $icon = $item['icon'] ?? '';
                        $url  = $item['url'] ?? '';
                        if ($icon && $url) :
                            $icon_url = filter_var($icon, FILTER_VALIDATE_URL) ? $icon : '';
                            $icon_alt = 'Social icon';
                    ?>
                <li class="site_footer__social-item" itemprop="sameAs">
                    <a href="<?php echo esc_url($url); ?>" target="_blank" rel="noopener noreferrer"
                        class="site_footer__social-link">
                        <img src="<?php echo esc_url($icon_url); ?>" alt="<?php echo esc_attr($icon_alt); ?>"
                            loading="lazy" width="24" height="24" class="site_footer__social-icon" />
                    </a>
                </li>
                <?php endif; endforeach; ?>
            </ul>
            <?php endif; ?>
        </div>

        <div class="site-footer__items">
            <section class="items__column" itemprop="address" itemscope itemtype="https://schema.org/PostalAddress">
                <h6 class="items__column-title"><?php echo esc_html($column_title_contact); ?></h6>
                <address>
                    <ul class="items">
                        <?php if ($phone): ?>
                        <li class="item">
                            <span class="item-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-chevron-right" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                        d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708">
                                    </path>
                                </svg>
                            </span>
                            <span class="item-label">
                                <a href="tel:<?php echo esc_attr($phone); ?>"
                                    itemprop="telephone"><?php echo esc_html($phone); ?></a>
                            </span>
                        </li>
                        <?php endif; ?>

                        <?php if ($email): ?>
                        <li class="item">
                            <span class="item-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-chevron-right" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                        d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708">
                                    </path>
                                </svg>
                            </span>
                            <span class="item-label">
                                <a href="mailto:<?php echo esc_attr($email); ?>"
                                    itemprop="email"><?php echo esc_html($email); ?></a>
                            </span>
                        </li>
                        <?php endif; ?>

                        <?php if ($address): ?>
                        <li class="item">
                            <span class="item-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-chevron-right" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                        d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708">
                                    </path>
                                </svg>
                            </span>
                            <span class="item-label">
                                <a href="https://www.google.com/maps/search/?api=1&query=<?php echo urlencode($address); ?>"
                                    target="_blank" rel="noopener">
                                    <span itemprop="streetAddress"><?php echo nl2br(esc_html($address)); ?></span>
                                </a>
                            </span>
                        </li>
                        <?php endif; ?>
                    </ul>
                </address>
            </section>

            <nav class="items__column" id="secondary-navigation" role="navigation" aria-label="Footermenu" itemscope
                itemtype="https://schema.org/SiteNavigationElement">
                <h6 class="items__column-title"><?php echo esc_html($column_title_menu); ?></h6>
                <?php
                    wp_nav_menu([
                        'menu'            => 4,
                        'container'       => false,
                        'menu_class'      => 'menu',
                        'fallback_cb'     => false
                    ]);
                ?>
            </nav>

            <section class="items__column">
                <h6 class="items__column-title"><?php echo esc_html($column_title_certification); ?></h6>
                <?php if ($column_description_cert): ?>
                <p><?php echo nl2br(esc_html($column_description_cert)); ?></p>
                <?php endif; ?>

                <?php if (!empty($certifications)): ?>
                <div class="certification-logos">
                    <?php foreach ($certifications as $cert): 
                            $image = $cert['logo'] ?? null;
                            if ($image):
                                $src = esc_url($image['url']);
                                $alt = esc_attr($image['alt'] ?? 'Certificering');
                        ?>
                    <figure itemscope itemtype="https://schema.org/ImageObject">
                        <img src="<?php echo $src; ?>" alt="<?php echo $alt; ?>" loading="lazy" width="120"
                            height="auto" itemprop="contentUrl" />
                        <figcaption itemprop="name"><?php echo $alt; ?></figcaption>
                    </figure>
                    <?php endif; endforeach; ?>
                </div>
                <?php endif; ?>
            </section>
        </div>

        <div class="site-footer__copy">
            <a href="https://czabouwbedrijf.marketingsmartheads.dev/wp-content/uploads/2025/11/AV-CZA-Bouwbderijf-2025-pdf.pdf"
                itemprop="url" target="_blank">Algemene voorwaarden</a>
        </div>

        <img src="<?php echo esc_url($logo_mark_url); ?>" alt="<?php echo esc_attr($site_name); ?>" width="453"
            height="329" loading="lazy" itemprop="logo" class="site-footer__logo-mark-image">
    </div>
</footer>