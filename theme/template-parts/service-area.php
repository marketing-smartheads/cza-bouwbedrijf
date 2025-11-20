
<?php
  $service = get_field('service', 'option');
  $section_title = $service['service_area_title'] ?? 'Werkzaam in heel Brabant';
  $section_description = $service['service_area_description'] ?? 'Onze professionals zijn actief in heel Noord-Brabant. We zijn regelmatig werkzaam in de volgende plaatsen:';
  $locations = $service['service_area_locations'] ?? [];
?>

<section class="service-area" itemscope itemtype="https://schema.org/LocalBusiness">
    <meta itemprop="name" content="<?php echo esc_attr(get_bloginfo('name')); ?>">
    <meta itemprop="description" content="<?php echo esc_attr(get_bloginfo('description')); ?>">
    <meta itemprop="areaServed" content="Noord-Brabant, Nederland">
    <meta itemprop="url" content="<?php echo esc_url(get_site_url()); ?>">
    <div class="service-area__container" data-animate="fade-in-up" data-delay="0">
        <h2 class="service-area__title"  data-animate="fade-in-up" data-delay="100"><?php echo esc_html($section_title); ?></h2>
        <div class="service-area__description" data-animate="fade-in-up" data-delay="200"><?php echo wp_kses_post($section_description); ?></div>

        <?php if (!empty($locations)) : ?>
        <ul class="service-area__list">
            <?php foreach ($locations as $index => $row) :
                $location = $row['location'] ?? '';
                $link = $row['link'] ?? null; //
                if ($location) : $delay = 300 + ($index * 100);
                
            ?>
            <li class="service-area__location"  data-animate="fade-in-up" data-delay="<?php echo $delay; ?>">
                <?php if (!empty($link)) : ?>
                    <a href="<?php echo esc_url($link); ?>" class="service-area__link">
                <?php endif; ?>

                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="service-area__icon" viewBox="0 0 16 16">
                        <path d="M3 14.5A1.5 1.5 0 0 1 1.5 13V3A1.5 1.5 0 0 1 3 1.5h8a.5.5 0 0 1 0 1H3a.5.5 0 0 0-.5.5v10a.5.5 0 0 0 .5.5h10a.5.5 0 0 0 .5-.5V8a.5.5 0 0 1 1 0v5a1.5 1.5 0 0 1-1.5 1.5z" />
                        <path d="m8.354 10.354 7-7a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0" />
                    </svg>

                    <span itemprop="areaServed"><?php echo esc_html($location); ?></span>

                <?php if (!empty($link)) : ?>
                    </a>
                <?php endif; ?>
            </li>
            <?php endif; endforeach; ?>
        </ul>
        <?php endif; ?>
    </div>
</section>