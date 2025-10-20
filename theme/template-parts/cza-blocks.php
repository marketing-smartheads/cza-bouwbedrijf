
<?php
    $cza = get_field('cza_blocks');
    if (!empty($cza['sections'])) :
?>
<section class="cza" itemscope itemtype="https://schema.org/WebPageElement">
    <div class="cza__container">

        <?php foreach ($cza['sections'] as $section): 
            $layout = $section['acf_fc_layout'] ?? '';
        ?>

            <?php if ($layout === 'intro'): 
                $title = $section['title'];
                $text  = $section['text'];
                $image = $section['image'];
            ?>
                <article class="cza__block cza__block--intro" data-animate="fade-in-up">
                    <header class="cza__header">
                        <?php if ($title): ?><h2 class="cza__lead-title"><?= wp_kses_post($title) ?></h2><?php endif; ?>
                        <?php if ($text): ?><div class="cza__text"><?= wp_kses_post($text) ?></div><?php endif; ?>
                    </header>

                    <?php if ($image): ?>
                        <figure class="cza__figure">
                            <img src="<?= esc_url($image['url']) ?>" alt="<?= esc_attr($image['alt']) ?>" loading="lazy" decoding="async" />
                        </figure>
                    <?php endif; ?>
                </article>
            <?php endif; ?>

            <?php if ($layout === 'experience'): 
                $title = $section['title'];
                $text  = $section['text'];
                $image = $section['image'];
            ?>
                <article class="cza__block cza__block--experience" data-animate="fade-in-up">
                    <?php if ($image): ?>
                        <figure class="cza__figure">
                            <img src="<?= esc_url($image['url']) ?>" alt="<?= esc_attr($image['alt']) ?>" loading="lazy" decoding="async" />
                        </figure>
                    <?php endif; ?>

                    <header class="cza__header">
                        <?php if ($title): ?><h2 class="cza__title"><?= wp_kses_post($title) ?></h2><?php endif; ?>
                        <?php if ($text): ?><div class="cza__text"><?= wp_kses_post($text) ?></div><?php endif; ?>
                    </header>
                </article>
            <?php endif; ?>

           <?php if ($layout === 'benefits'): 
                $title   = $section['title'] ?? '';
                $bullets = $section['bullets'] ?? [];
            ?>
                <?php if (!isset($split_started)): ?>
                    <div class="cza__row cza__row--split">
                        <?php $split_started = true; ?>
                <?php endif; ?>

                    <article class="cza__block cza__block--benefits" data-animate="fade-in-up">
                        
                        <header class="cza__header">
                            <?php if ($title): ?><h2 class="cza__title"><?= esc_html($title) ?></h2><?php endif; ?>
                        </header>
                        
                        <?php if (!empty($bullets)): ?>
                            <ul class="cza__list">
                                <?php foreach ($bullets as $bullet): 
                                    $bullet_title = $bullet['title'] ?? '';
                                ?>
                                <li class="cza__item">
                                    <span class="cza__item-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-check2-square" viewBox="0 0 16 16">
                                            <path d="M3 14.5A1.5 1.5 0 0 1 1.5 13V3A1.5 1.5 0 0 1 3 1.5h8a.5.5 0 0 1 0 1H3a.5.5 0 0 0-.5.5v10a.5.5 0 0 0 .5.5h10a.5.5 0 0 0 .5-.5V8a.5.5 0 0 1 1 0v5a1.5 1.5 0 0 1-1.5 1.5z"/>
                                            <path d="m8.354 10.354 7-7a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0"/>
                                        </svg>
                                    </span>
                                    <span class="cza__item-title"><?= esc_html($bullet_title) ?></span>
                                </li>
                                <?php endforeach; ?>
                            </ul>
                            <?php endif; ?>
                    </article>
                <?php endif; ?>

                <?php if ($layout === 'cta'): 
                    $title    = $section['title'];
                    $subtitle = $section['subtitle'];
                    $buttons = $section['buttons'] ?? [];
                ?>

                    <article class="cza__block cza__block--cta" role="region" aria-label="Call to action" data-animate="fade-in-up">
                        
                        <header class="cza__header">
                            <?php if ($title): ?><h2 class="cza__title"><?= esc_html($title) ?></h2><?php endif; ?>
                            <?php if ($subtitle): ?><span class="cza__subtitle"><?= esc_html($subtitle) ?></span><?php endif; ?>
                        </header>

                        <?php if (!empty($buttons)): ?>
                            <footer class="cza__footer">
                                <?php foreach ($buttons as $btn): 
                                    $link  = $btn['link'] ?? null;
                                    $style = $btn['style'] ?? 'primary';
                                ?>
                                    <?php if ($link): ?>
                                        <a href="<?= esc_url($link['url']) ?>" class="button button--<?= esc_attr($style) ?> cza__button" target="<?= esc_attr($link['target'] ?? '_self') ?>">
                                            <span class="button-label"><?= esc_html($link['title']) ?></span>
                                            <span class="button-icon">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-right" viewBox="0 0 16 16">
                                                    <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708" />
                                                </svg>
                                            </span>
                                        </a>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </footer>
                        <?php endif; ?>
            
                    </article>
                    <?php if (isset($split_started)): ?>
                        </div> 
                    <?php unset($split_started); ?>
                <?php endif; ?>
            <?php endif; ?>

        <?php endforeach; ?>

    </div>
</section>
<?php endif; ?>
