<section class="tips" aria-label="TikTok tips">
    <div class="tips__container">
        <h2 class="tips-section__title" data-animate="fade-in-up">Tips van CZA</h2>

        <?php if (have_rows('scroll', 'option')) : ?>
        <div class="swiper tips-swiper" data-autoplay="true">
            <div class="swiper-wrapper">
                <?php while (have_rows('scroll', 'option')) : the_row(); 
                $image = get_sub_field('image');
                $title = get_sub_field('title');
                $subtitle = get_sub_field('subtitle');
                $description = get_sub_field('omschrijving');
                $link = get_sub_field('link'); ?>

                <div class="swiper-slide">
                    <article class="tips-card card" itemscope itemtype="https://schema.org/VideoObject">
                        <?php if (!empty($image)) : ?>
                            <figure class="tips-card__image hidden">
                                <img src="<?= esc_url($image['url']); ?>" alt="<?= esc_attr($image['alt'] ?? $title); ?>" itemprop="thumbnailUrl" loading="lazy" />
                            </figure>

                            <figure class="tips-card__image group relative">
                                <a href="<?= esc_url($link['url']); ?>" target="<?= esc_attr($link['target'] ?: '_blank'); ?>" rel="noopener">
                                    <img src="<?= esc_url($image['url']); ?>" alt="<?= esc_attr($image['alt'] ?? $title); ?>" itemprop="thumbnailUrl" loading="lazy" />
                                    <div
                                        class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center rounded-tl-2xl rounded-tr-2xl">
                                        <svg class="w-12 h-12 text-white" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M8 5v14l11-7z" />
                                        </svg>
                                    </div>
                                </a>
                            </figure>
                        <?php endif; ?>

                        <?php if ($subtitle) : ?>
                            <h2 class="tips-card__title"><?= esc_html($subtitle); ?></h2>
                        <?php endif; ?>

                        <?php if ($description) : ?>
                            <div class="tips-card__description" itemprop="description">
                                <p><?= wp_kses_post($description); ?></p>
                            </div>
                        <?php endif; ?>

                        <?php if ($link && is_array($link)) : ?>
                        <a href="<?= esc_url($link['url']); ?>" target="<?= esc_attr($link['target'] ?: '_blank'); ?>" rel="noopener" class="button button--tertiary tips-card__link">
                            <span class="button-label"><?= esc_html($link['title'] ?: 'Bekijk video'); ?></span>
                            <span class="button-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-right" viewBox="0 0 16 16"> 
                                    <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708" />
                                </svg>
                            </span>
                        </a>
                        <?php endif; ?>
                    </article>
                </div>
                <?php endwhile; ?>
            </div>
        </div>
        <?php else : ?>
        <p class="scroll-section__empty">Geen TikTok-video’s beschikbaar.</p>
        <?php endif; ?>
    </div>
</section>