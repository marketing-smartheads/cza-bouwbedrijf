<?php  
    // ACF Vars

    // Featured image
    $hero_image = has_post_thumbnail() ? get_the_post_thumbnail(null, 'full', ['class' => 'hero__image-media', 'alt' => get_the_title()]) : '';

    // Post title
    $hero_title = get_the_title();

    // ACF group 'hero'
    $hero_group = get_field('hero');
    $hero_description = $hero_group['description'] ?? '';
    $hero_button = $hero_group['button'] ?? null;

    // Button vars
    $button_url = $hero_button['url'] ?? '';
    $button_title = $hero_button['title'] ?? 'Lees meer';
    $button_target = $hero_button['target'] ?? '_self';
?>


<section class="hero" itemscope itemtype="https://schema.org/WebPageElement">
    <?php if ($hero_image) : ?>
		<figure class="hero__image" itemprop="image">
			<?php echo $hero_image; ?>
		</figure>
    <?php endif; ?>

    <div class="hero__content">
        <h1 class="hero__title" itemprop="headline">
            <?php echo esc_html($hero_title); ?>
        </h1>

        <?php if ($hero_description) : ?>
			<div class="hero__description hero__subtitle" itemprop="description">
				<?php echo $hero_description; ?>
			</div>
        <?php endif; ?>

        <?php if ($button_url) : ?>
			<a class="hero--button button button--primary" href="<?php echo esc_url($button_url); ?>" target="<?php echo esc_attr($button_target); ?>">
				<span class="button-label"><?php echo esc_html($button_title); ?></span>
				<span class="button-icon">
					<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-right" viewBox="0 0 16 16">
						<path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708"/>
					</svg>
				</span>
			</a>
        <?php endif; ?>
    </div>
</section>