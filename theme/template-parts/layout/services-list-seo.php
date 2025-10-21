<?php
$seo = get_field('seo');
?>

<div class="services__list">
    <?php if (!empty($seo['services'])): ?>
        <?php foreach ($seo['services'] as $layout): ?>
            <?php if ($layout['acf_fc_layout'] === 'content' && !empty($layout['blocks'])): ?>
                <?php foreach ($layout['blocks'] as $block): ?>
                    <?php
                        $name = $block['title'] ?? '';
                        $desc = $block['text'] ?? '';
                        $icon = $block['icon'] ?? null;
                        $link = $block['link']['url'] ?? null; // optioneel, als je later een linkveld toevoegt
                        $type = $name; // of een apart veld als je dat wilt
                    ?>
                    <a href="<?= esc_url($link ?: '#') ?>" class="services__item-link group" itemprop="url">
                        <article class="services__item" itemscope itemtype="https://schema.org/Service" data-animate="fade-in-up">
                            <meta itemprop="serviceType" content="<?= esc_attr($type) ?>">

                            <div class="services__leading">
                                <h3 class="services__name group-hover:bg-primary group-hover:text-black hover:shadow" itemprop="name"><?= esc_html($name) ?></h3>

                                <span class="services__icon" aria-hidden="true">
                                    <?php if ($icon): ?>
                                        <img src="<?= esc_url($icon['url']) ?>" alt="<?= esc_attr($icon['alt'] ?? $name) ?>" class="services__icon-image" />
                                    <?php endif; ?>
                                </span>
                            </div>

                            <div class="services__description" itemprop="description">
                                <?= $desc ?> <!-- WYSIWYG: geen esc_html -->
                            </div>

                            <button class="button button--simple services__button" aria-hidden="true">
                                <span class="button-label group-hover:text-primary">Meer informatie</span>
                                <span class="button-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-arrow-right group-hover:fill-primary" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8"/>
                                    </svg>
                                </span>
                            </button>
                        </article>
                    </a>
                <?php endforeach; ?>
            <?php endif; ?>
        <?php endforeach; ?>
    <?php endif; ?>
</div>
