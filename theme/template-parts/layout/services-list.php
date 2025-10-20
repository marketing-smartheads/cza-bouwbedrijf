<?php
    // Theme vars
    $parent = get_page_by_path('wat-wij-doen');

    $services = get_pages([
        'child_of' => $parent->ID,
        'sort_column' => 'menu_order',
        'sort_order' => 'ASC'
    ]);
?>
<div class="services__list">
    <?php foreach ($services as $service): ?>
        <?php
            $name = get_the_title($service->ID);
            $service_data = get_field('service', $service->ID);
            $desc = $service_data['description'] ?? '';
            $type = $service_data['type'] ?? $name;
            $icon = $service_data['icon'] ?? null;
            $link = get_permalink($service->ID);
        ?>
        <a href="<?= esc_url($link) ?>" class="services__item-link group" itemprop="url">
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
                <p class="services__description" itemprop="description"><?= esc_html($desc) ?></p>
                
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

</div>