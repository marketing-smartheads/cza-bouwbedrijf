<?php
    $promo = get_field('promo');
    $site_header = get_field('site_header', 'option');

    $social_links = [];

    if (!empty($site_header['social_media'])) {
        foreach ($site_header['social_media'] as $social) {
            if (!empty($social['url'])) {
                $social_links[] = esc_url($social['url']);
            }
        }
    }
?>

<script type="application/ld+json">
    <?= json_encode([
    "@context" => "https://schema.org",
    "@type" => "Organization",
    "name" => "CZA Bouwbedrijf",
    "url" => home_url(),
    "description" => wp_strip_all_tags($promo['text']),
    "image" => $promo['image']['url'] ?? '',
    "sameAs" => $social_links
    ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) ?>
</script>


<?php if ($promo): ?>
<section class="promo" aria-labelledby="promo-title">
    <div class="promo__container">

        <div class="promo__content" data-animate="fade-in-up">
            <h2 id="promo-title" class="promo__title" data-animate="fade-in-up"><?= esc_html($promo['title']) ?></h2 >
            <div class="promo__text" data-animate="fade-in-up">
                <?= wp_kses_post($promo['text']) ?>
            </div>

            <?php if (!empty($promo['link']['url'])): ?>
                <a href="<?= esc_url($promo['link']['url']) ?>" class="promo__cta button button--primary" data-animate="fade-in-up">
                    <span class="button-label"><?= esc_html($promo['link']['title'] ?? 'Meer informatie') ?></span>
                    <span class="button-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-right" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708" />
                        </svg>
                    </span>
                </a>
            <?php endif; ?>
        </div>

        <?php if (!empty($promo['image'])): ?>
            <figure class="promo__image-wrapper" data-animate="fade-in-up">
                <?= wp_get_attachment_image($promo['image']['ID'], 'large', false, [
                    'class' => 'promo__image',
                    'alt' => esc_attr($promo['image']['alt'] ?? 'Team van CZA Bouwbedrijf')
                ]) ?>
            </figure>
        <?php endif; ?>

    </div>
</section>
<?php endif; ?>
