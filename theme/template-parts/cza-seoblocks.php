<?php
$blocks = get_field('blocks');
$content_blocks = $blocks['content_blocks'] ?? [];
$heading_title = $blocks['heading_title'] ?? '';
?>

<?php if (!empty($content_blocks)): ?>
<section class="cza__seo-blocks" itemscope itemtype="https://schema.org/WebPageElement">
    <div class="cza__seo-blocks__container">
        <?php if ($heading_title): ?>
            <h2 class="cza__heading-title text-center pt-6 m-0 xl:pb-12" data-animate="fade-in-up"><?= esc_html($heading_title) ?></h2>
        <?php endif; ?> 

        <ul class="cza__seo-blocks-list">
            <?php foreach ($content_blocks as $i => $block): ?>
                <?php
                    $text  = $block['content'] ?? '';
                    $image = $block['image'] ?? null;
                    $is_last = ($i === array_key_last($content_blocks));
                ?>
                <li class="seo__list_item">
                    <?php if ($text): ?>
                        <div class="cza__content-block cza__content-block--text" data-animate="fade-in-up">
                            <?= wp_kses_post($text) ?>
                        </div>
                    <?php endif; ?>

                    <?php if ($image): ?>
                        <figure class="cza__content-block cza__content-block--image" data-animate="fade-in-up">
                            <img src="<?= esc_url($image['url']) ?>" alt="<?= esc_attr($image['alt'] ?? '') ?>" loading="lazy" decoding="async" />
                        </figure>
                    <?php elseif ($is_last): ?>
                        <div class="seo__cta_item" data-animate="fade-in-up">
                            <h3 class="seo__cta_item-title">Krijg de beste bouw- en verbouw tips in uw inbox</h3>
                            <p>Wekelijks op de hoogte</p>
                            <?= do_shortcode('[contact-form-7 id="226b483" title="Nieuwsbrief"]'); ?>
                        </div>
                    <?php endif; ?>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</section>
<?php endif; ?>
