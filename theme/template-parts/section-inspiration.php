<?php
$acf = get_field('inspiration'); 

$query = new WP_Query([
  'post_type'      => 'page',
  'post_parent'    => 16,
  'post_status'    => 'publish',
  'orderby'        => 'menu_order',
  'order'          => 'ASC',
  'posts_per_page' => -1
]);

// Structured data opbouwen
$items = [];
if ($query->have_posts()) {
    while ($query->have_posts()) {
        $query->the_post();

        $items[] = [
            "@type"         => "CreativeWork",
            "name"          => get_the_title(),
            "url"           => get_permalink(),
            "image"         => get_the_post_thumbnail_url(get_the_ID(), 'large') ?: null,
            "headline"      => get_the_title(),
            "description"   => wp_strip_all_tags(get_the_excerpt()),
            "datePublished" => get_the_date('c'),
            "locationCreated" => get_field('location') ?: 'Onbekende locatie',
        ];
    }
    wp_reset_postdata();
}

$structuredData = [
    "@context" => "https://schema.org",
    "@type"    => "ItemList",
    "name"     => get_the_title(),
    "url"      => get_permalink(),
    "image"    => get_the_post_thumbnail_url(null, 'large'),
    "headline" => get_the_title(),
    "description" => wp_strip_all_tags(get_the_excerpt()),
    "datePublished" => get_the_date('c'),
    "locationCreated" => $acf['location'] ?? 'Onbekende locatie',
    "itemListElement" => $items
];
?>

<script type="application/ld+json">
<?= json_encode($structuredData, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) ?>
</script>


<section class="inspiration" aria-labelledby="inspiration-title">
    <div class="inspiration__container">

        <?php if ($acf): ?>
            <header class="inspiration__header">
                <div class="inspiration__heading">
                    <h2 id="inspiration-title" class="inspiration__title" data-animate="fade-in-up">
                        <?= esc_html($acf['title']) ?>
                    </h2>
                    <span class="inspiration__subtitle" data-animate="fade-in-up">
                        <?= esc_html($acf['subtitle']) ?>
                    </span>
                </div>
                <?php if (!empty($acf['button']['url'])): ?>
                <a href="<?= esc_url($acf['button']['url']) ?>" 
                   class="inspiration__view-all button button--tertiary" 
                   data-animate="fade-in-up">
                    <span class="button-label"><?= esc_html($acf['button']['title'] ?? 'Bekijk alles') ?></span>
                    <span class="button-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" 
                             fill="currentColor" class="bi bi-chevron-right" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" 
                                  d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 
                                  .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 
                                  4.646 2.354a.5.5 0 0 1 0-.708" />
                        </svg>
                    </span>
                </a>
                <?php endif; ?>
            </header>
        <?php endif; ?>
    
        <?php if ($query->have_posts()): ?>
            <div class="inspiration__grid-wrapper">
                <div class="inspiration__grid" id="carouselGrid" data-carousel data-nav>
                    <?php while ($query->have_posts()): $query->the_post(); ?>
                        <article class="inspiration__item project-card group" onclick="window.location='<?php the_permalink(); ?>';" itemscope itemtype="https://schema.org/CreativeWork" data-animate="fade-in-up">
                            <figure class="project-card__image-wrapper">
                                <?php if (has_post_thumbnail()): ?>
                                    <?php the_post_thumbnail('large', [
                                        'class' => 'project-card__image',
                                        'itemprop' => 'image'
                                    ]); ?>
                                <?php endif; ?>
                            </figure>
                            <div class="project-card__content">
                                <?php $inspiration = get_field('inspiration'); 
                                if (!empty($inspiration['location'])): ?>
                                    <span class="project-card__location" itemprop="locationCreated">
                                        <?= esc_html($inspiration['location']) ?>
                                    </span>
                                <?php endif; ?>

                                <?php $inspiration = get_field('inspiration'); ?>
                                <h3 class="project-card__title my-0<?php if (empty($inspiration['location'])): ?> mt-5<?php endif; ?>" itemprop="headline">
                                    <?php the_title(); ?>
                                </h3>

                                <a href="<?php the_permalink(); ?>" class="button project-card__button group-hover:text-primary" itemprop="url">
                                    <span class="button-label">Bekijk</span>
                                    <span class="button-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-right" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708"/>
                                        </svg>
                                    </span>
                                </a>
                            </div>
                        </article>
                    <?php endwhile; wp_reset_postdata(); ?>
                </div>
                 <nav class="inspiration__navigation" aria-label="Project navigatie">
                    <button class="nav__button nav__button-prev" aria-label="Vorige project" data-carousel-prev>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-left" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0"/>
                        </svg>
                    </button>
                    <button class="nav__button nav__button-next" aria-label="Volgende project" data-carousel-next>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-right" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708"/>
                        </svg>
                    </button>
                </nav>
            </div>
        <?php endif; ?>             
              
    </div>
</section>
