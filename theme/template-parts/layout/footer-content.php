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

?>

<?php get_template_part('template-parts/section', 'cta'); ?>

<footer id="colophon" class="site-footer" itemscope itemtype="https://schema.org/WPFooter">
    <div class="site-footer__container" itemscope itemtype="https://schema.org/Organization">
        
        <div class="site-footer__heading">
            <a href="<?php echo esc_url($site_url); ?>" title="<?php echo esc_attr($site_name); ?>" class="site_footer__logo" itemprop="url">
                <img src="<?php echo esc_url($logo_url); ?>" alt="<?php echo esc_attr($site_name); ?>" width="324" height="165" loading="lazy" itemprop="logo" class="site_footer__logo-image">
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
                        <a href="<?php echo esc_url($url); ?>" target="_blank" rel="noopener noreferrer" class="site_footer__social-link">
                            <img src="<?php echo esc_url($icon_url); ?>" alt="<?php echo esc_attr($icon_alt); ?>" loading="lazy" width="24" height="24" class="site_footer__social-icon" />
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
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-right" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708"></path></svg>
                            </span>
                            <span class="item-label">
                                <a href="tel:<?php echo esc_attr($phone); ?>" itemprop="telephone"><?php echo esc_html($phone); ?></a>
                            </span>
                        </li>
                        <?php endif; ?>

                        <?php if ($email): ?>
                        <li class="item">
                            <span class="item-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-right" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708"></path></svg>
                            </span>
                            <span class="item-label">
                                <a href="mailto:<?php echo esc_attr($email); ?>" itemprop="email"><?php echo esc_html($email); ?></a>
                            </span>
                        </li>
                        <?php endif; ?>

                        <?php if ($address): ?>
                        <li class="item">
                            <span class="item-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-right" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708"></path></svg>
                            </span>
                            <span class="item-label">
                                <a href="https://www.google.com/maps/search/?api=1&query=<?php echo urlencode($address); ?>" target="_blank" rel="noopener">
                                    <span itemprop="streetAddress"><?php echo nl2br(esc_html($address)); ?></span>
                                </a>
                            </span>
                        </li>
                        <?php endif; ?>
                    </ul>
                </address>
            </section>

            <nav class="items__column" id="secondary-navigation" role="navigation" aria-label="Footermenu" itemscope itemtype="https://schema.org/SiteNavigationElement">
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
                            <img src="<?php echo $src; ?>" alt="<?php echo $alt; ?>" loading="lazy" width="120" height="auto" itemprop="contentUrl" />
                            <figcaption itemprop="name"><?php echo $alt; ?></figcaption>
                        </figure>
                        <?php endif; endforeach; ?>
                    </div>
                <?php endif; ?>
            </section>
        </div>

        <div class="site-footer__copy">
            <a href="#" itemprop="url">Algemene voorwaarden</a>
        </div>

        <img src="<?php echo esc_url($logo_mark_url); ?>" alt="<?php echo esc_attr($site_name); ?>" width="453" height="329" loading="lazy" itemprop="logo" class="site-footer__logo-mark-image">
    </div>
</footer>
