<?php
// ACF Vars
$hero        = get_field('hero');
$video       = $hero['video'] ?? null;
$leading     = $hero['leading_title'] ?? '';
$terms       = $hero['terms'] ?? [];
$sub_title   = $hero['sub_title'] ?? '';
$link        = $hero['link'] ?? null;
$link_url    = is_array($link) ? ($link['url'] ?? '') : '';
$link_label  = is_array($link) ? ($link['title'] ?? '') : '';
$link_target = is_array($link) ? ($link['target'] ?? '_self') : '_self';

?>

<section class="hero" itemscope itemtype="https://schema.org/Organization">
    <?php     
    if ($video): ?>
        <div class="hero__video-wrapper">
            <div class="hero__video-loader"></div>
            <video class="hero__video" autoplay muted loop playsinline>
                <source src="<?= esc_url($video['url']) ?>" type="video/mp4">
            </video> 
        </div>
    <?php endif; ?>

    <div class="hero__container">
        <header class="hero__header">
            <?php if ($leading): ?>
                <h1 class="hero__title" itemprop="slogan">
                    <?= esc_html($leading) ?>
                    <?php if (!empty($terms)): ?>
                        <span class="hero__terms">
                            <?php foreach ($terms as $term): ?>
                                <?php if (!empty($term['term'])): ?>
                                    <span class="hero__term"><?= esc_html($term['term']) ?></span>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </span>
                    <?php endif; ?>
                </h1>
            <?php endif; ?>

            <?php if ($sub_title): ?>
                <p class="hero__subtitle"><?= esc_html($sub_title) ?></p>
            <?php endif; ?>

            <?php if ($link_url && $link_label): ?>
                <a href="<?= esc_url($link_url) ?>" target="<?= esc_attr($link_target) ?>" class="button button--primary hero--button" itemprop="url">
                    <span class="button-label"><?= esc_html($link_label) ?></span>
                    <span class="button-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-right" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708" />
                        </svg>
                    </span>
                </a>
            <?php endif; ?>
        </header>
    </div>
</section>