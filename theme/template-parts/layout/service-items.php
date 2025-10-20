<?php
$flex_elements = get_field('flex_elements');
$structured_blocks = [];

if ($flex_elements) :
    foreach ($flex_elements as $element) :
        if ($element['acf_fc_layout'] === 'image_columns') :
            $anchor = $element['anchor'] ?? '';
            ?>
            
            <section class="image-columns" <?php if ($anchor) : ?>id="<?= esc_attr($anchor) ?>"<?php endif; ?> itemscope itemtype="https://schema.org/CollectionPage">                     
                <?php
                foreach ($element as $key => $column) :
                    if (strpos($key, 'column_') === 0 && is_array($column)) :
                        $outer_style = '';
                        if (!empty($column['background']['sizes']['large'])) {
                            $outer_style = "background-image: url('" . esc_url($column['background']['sizes']['large']) . "')";
                        }
                        ?>
                        <div <?php if ($outer_style) : ?>style="<?= esc_attr($outer_style) ?>"<?php endif; ?>
                             itemscope itemtype="https://schema.org/Service">
                             
                            <?php
                            $delay = 0;

                            foreach ($column as $block_key => $block) :
                                if (strpos($block_key, 'block_') === 0 && is_array($block)) :
                                    $structured_blocks[] = $block;
                                    $type = !empty($block['type']) ? esc_attr($block['type']) : 'image';
                                    $class = $type;
                                    $inner_style = '';

                                    if ($type === 'image' && !empty($block['image']['sizes']['large'])) {
                                        $inner_style = "background-image: url('" . esc_url($block['image']['sizes']['large']) . "')";
                                    }

                                    $delay_value = number_format($delay, 2);
                                    $delay += 150;
                                    ?>
                                    <div class="<?= esc_attr($class) ?>"
                                         <?php if ($inner_style) : ?>style="<?= esc_attr($inner_style) ?>"<?php endif; ?>
                                         data-animate="fade-in-up"
                                         data-delay="<?= esc_attr($delay_value) ?>"
                                         itemprop="hasOfferCatalog"
                                         itemscope itemtype="https://schema.org/OfferCatalog">
                                         
                                        <?php if ($type !== 'image') : ?>
                                            <?php if (!empty($block['subtitle'])) : ?>
                                                <p itemprop="category"><?= esc_html($block['subtitle']) ?></p>
                                            <?php endif; ?>
                                            <?php if (!empty($block['title'])) : ?>
                                                <h2 itemprop="name"><?= esc_html($block['title']) ?></h2>
                                            <?php endif; ?>
                                            <?php if (!empty($block['text'])) : ?>
                                                <p itemprop="description"><?= esc_html($block['text']) ?></p>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    </div>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </section>

            <?php
                // Structured data JSON-LD
                $structured_data = [
                    "@context" => "https://schema.org",
                    "@type" => "CollectionPage",
                    "name" => "Wat we doen",
                    "hasPart" => []
                ];

                foreach ($structured_blocks as $block) {
                        $title = $block['title'] ?? '';
                        $text = $block['text'] ?? '';
                        $subtitle = $block['subtitle'] ?? '';

                        if ($title || $text || $subtitle) {
                            $service = [
                                "@type" => "Service",
                                "name" => $title,
                                "description" => $text,
                                "category" => $subtitle
                            ];

                            if (!empty($block['image']['sizes']['large'])) {
                                $service["image"] = $block['image']['sizes']['large'];
                            }

                            $structured_data['hasPart'][] = $service;
                        }
                    }
                ?>
                <script type="application/ld+json">
                    <?= json_encode($structured_data, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) ?>
                </script>
        <?php endif; ?>
    <?php endforeach; ?>
<?php endif; ?>
