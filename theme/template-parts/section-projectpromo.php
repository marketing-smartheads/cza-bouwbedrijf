<?php
$approach = get_field('approach');

if ($approach) :
  $image        = $approach['image'] ?? null;
  $figcaption   = $approach['figcaption'] ?? '';
  $title        = $approach['title'] ?? '';
  $approach_items = $approach['approach_items'] ?? [];
?>

<section class="project-promo" itemscope itemtype="https://schema.org/Service">
    <?php if ($image) : ?>
    <figure class="project-promo__image" data-animate="fade-in-up">
        <img src="<?= esc_url($image['url']); ?>" alt="<?= esc_attr($image['alt'] ?? 'Project visual'); ?>" itemprop="image" loading="lazy" />
        <?php if ($figcaption) : ?>
            <figcaption class="project-promo__caption" itemprop="provider" itemscope itemtype="https://schema.org/Organization" data-animate="fade-in-up" >
                <div class="text-overlay__bracket text-overlay__bracket--left absolute -top-8 -left-8 w-6 h-6">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect x="7" y="7" width="7" height="17" transform="rotate(-90 7 7)" fill="white"/>
                        <rect y="7" width="7" height="17" fill="white"/>
                    </svg>
                </div>
                <div class="text-overlay__bracket text-overlay__bracket--tr absolute -top-8 -right-3 w-6 h-6 rotate-90">
                    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect x="7" y="7" width="7" height="17" transform="rotate(-90 7 7)" fill="white"/>
                        <rect y="7" width="7" height="17" fill="white"/>
                    </svg>
                </div>
                <div class="text-overlay__bracket text-overlay__bracket--br absolute -bottom-8 -right-3 w-6 h-6 rotate-180">
                    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect x="7" y="7" width="7" height="17" transform="rotate(-90 7 7)" fill="white"/>
                        <rect y="7" width="7" height="17" fill="white"/>
                    </svg>
                </div>
                <div class="text-overlay__bracket text-overlay__bracket--bl absolute -bottom-8 -left-8 w-6 h-6 -rotate-90">
                    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect x="7" y="7" width="7" height="17" transform="rotate(-90 7 7)" fill="white"/>
                        <rect y="7" width="7" height="17" fill="white"/>
                    </svg>
                </div>
                <span itemprop="name"><?= esc_html($figcaption); ?></span>
            </figcaption>
        <?php endif; ?>
    </figure>
    <?php endif; ?>

    <div class="project-promo__approach" itemprop="hasOfferCatalog" itemscope itemtype="https://schema.org/OfferCatalog" data-animate="fade-in-up">
        <?php if ($title) : ?>
            <h2 class="project-promo__title" data-animate="fade-in-up" ><?= esc_html($title); ?></h2>
        <?php endif; ?>

       <?php if (!empty($approach_items)) : ?>
            <ol class="project-promo__steps">
                <?php 
                    $delay = 0;
                    foreach ($approach_items as $index => $item) :
                    $step_title = $item['title'] ?? '';
                    $step_desc  = $item['description'] ?? '';
                    if (!$step_title && !$step_desc) continue;

                    $step_number = str_pad($index + 1, 2, '0', STR_PAD_LEFT);
                    $delay_value = number_format($delay, 2);
                    $delay += 0.8;
                ?>
                <li class="project-promo__step" itemprop="itemListElement" itemscope itemtype="https://schema.org/Offer" data-animate="fade-in-up" data-delay="<?= esc_attr($delay_value) ?>">
                    <meta itemprop="position" content="<?= $index + 1; ?>">
                    <div class="project-promo__step-inner">
                        <span class="project-promo__step-number">
                            <?= $step_number; ?>
                        </span>

                        <div class="project-promo__step-content">
                            <?php if ($step_title) : ?>
                                <h3 class="project-promo__step-title"><?= wp_kses_post($step_title); ?></h3>
                            <?php endif; ?>

                            <?php if ($step_desc) : ?>
                                <p class="project-promo__step-description" itemprop="description"><?= esc_html($step_desc); ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                </li>
                <?php endforeach; ?>
            </ol>
        <?php endif; ?>

    </div>
</section>

<?php endif; ?>